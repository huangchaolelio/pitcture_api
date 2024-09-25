<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Library\Response;
use App\Models\WechatApp;

use App\Models\Picture;
use App\Models\PictureItem;
use App\Models\PictureDescribe;
use App\Models\OssConfig;

// 七牛上传
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class PublishPicController extends Controller
{

    /*后端获取token*/
    public function getWechatToken()
    {

        // 获得小程序的appid和secret设置
        $wechatapp = WechatApp::first();
        $appid = $wechatapp->AppId;
        $secret = $wechatapp->AppSecret;

        $client = new \GuzzleHttp\Client(); // curl模拟http进行get和post请求的类
        // 获取 access_token 和用户的 openid
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $secret;
        // get请求
        $res = $client->request('get', $url);
        // 返回请求的json数据
        $res = json_decode($res->getBody());
        $access_token = $res->access_token;
        return $access_token;

    }

    /*微信图片敏感内容检测*/
    public function imgSecCheck($filePath,$filename)
    {

        $token = $this->getWechatToken();
        $url = "https://api.weixin.qq.com/wxa/img_sec_check?access_token=$token";
        $client = new \GuzzleHttp\Client(); // curl模拟http进行get和post请求的类
        $file_resource = fopen($filePath, 'r');
        $multipart = [
            [
                'name'     => 'media',
                'contents' =>  $file_resource,
                'filename' => $filename,
            ]
        ];
        $res = $client->request('POST', $url, [
            'multipart' => $multipart,
            'headers' => [
                'Content-Type' => 'multipart/form-data'
            ]
        ]);
        return json_decode($res->getBody(),true);

    }

    /*微信文本敏感内容检测*/
    public function msgSecCheck($title,$content,$user_id)
    {
        $url = 'https://api.weixin.qq.com/wxa/msg_sec_check?access_token=' . $this->getWechatToken();
        $client = new \GuzzleHttp\Client(); // curl模拟http进行get和post请求的类
        $openid = Users::where('id', $user_id)->first()->openid;
        $res = $client->request('POST', $url,[
            'body' => json_encode([
                'content' => $content,
                'title'=>$title,
                'version' => 2,
                'openid' => $openid,
                'scene' => 2
            ], JSON_UNESCAPED_UNICODE),
        ]);
        return json_decode($res->getBody(),true);
    }

    // 前端用户发布图片<tn-image-upload>组件用到的上传路由
    public function picture_upload(Request $request)
    {
        // 上传文件参数为file
        $file = $request->file('file');

        // 获取缓存在服务器 tmp 目录下的文件名,（带后缀，如 php8933.tmp）
        $fileTempName = $file->getFilename();

        $fileSize = filesize($file);
        if($fileSize < 1024 * 1024) {//小于1M的图片才检测(微信接口支持1M的)，否则直接人工审核
             //图片安全检测
             $imgCheck = $this->imgSecCheck($file,$fileTempName);
             if($imgCheck['errmsg'] !='ok') {
                 return $imgCheck;
             }
        }
        // 获取上传文件的文件名全名（带扩展名，如 abc.png）
        $fileName = $file->getClientOriginalName();

        // 获取上传文件的扩展名（如 abc.png，获取到的为 png）
        $fileExtension = $file->getClientOriginalExtension();

        // 生成新的文件名
        $newFileName = md5($fileName . time() . rand()) . '.' . $fileExtension;

        // 新建目录
        $path = 'uploads_tmp';

        if(!file_exists($path)){       //判断保存目录是否存在
            mkdir($path,0777,true);    //建立保存目录
        }

        // 将缓存在 tmp 目录下的文件移到某个位置，返回的是这个文件移动过后的路径

        $movePath = $file->move($path, $newFileName);

//        return $this->imgSecCheck($movePath,$newFileName);
        // $movePath格式： uploads_tmp\fe88b153d4ab995e20ac59cffcb959a9.jpg
//        return $movePath;
        //array_push($imgCheck, array("file" => $movePath));
        return $movePath;
    }

    /**
     *
     * 前端用户发布的内容信息
     *
     * **/
    public function publish_pictures(Request $request)
    {
        $picture = new Picture();
        $picture->user_id = $request->input('userid'); // 用戶的id
        // $picture->item_count = $request->intpu('pic_count'); // 图片数量
        $picture->title = $request->input('pic_title'); // 标题
        $picture->describe = $request->input('pic_desc'); // 标题
        $result = $this->msgSecCheck($picture->title,$picture->describe,$picture->user_id);
        //内容检测成功
        if(isset($result['errcode']) && $result['errcode'] == 0 && $result['result']['suggest']=='pass') {

            $picture->device_type = $request->input('pic_device'); // 图片可以使用的平台类别
            $picture->item_count = $request->input('pic_count'); // 上传图片数量
            $picture->score = $request->input('pic_score');  // 积分
            $picture->pic_category_id = $request->input('pic_categoryid'); // 图片分类
            $picture->is_show = 0; // 默认为不显示图片专辑
            $picture->created_time = time();
            $picture->updated_time = time();
            $picture->save();

            $desc = $request->input('pic_desc');
            if ($desc != '') {
                $pictureDescribe = new PictureDescribe();
                $pictureDescribe->picture_id = $picture->id;
                $pictureDescribe->describe = $desc; // 描述
                $pictureDescribe->created_time = time();
                $pictureDescribe->save();
            }

            // 图片存储位置
            $oss = OssConfig::where('status', 1)->first();
            $mark = $oss->mark;
            $oss_tag = $oss->tag;

            $files = json_decode($request->input('pic_list'));  // 取得全部上传的图片文件

            // 依次保存图片路径到数据库中
            foreach ($files as $file) {
                if ($mark == 'localhost') {
                    // 上传到本地服务器
                    //                $this->local();//报错没有local()方法

                    //                $bucket = $oss->bucket; // 目录,上传路径
                    //                move_uploaded_file($file,$bucket);
                    // 上传文件名
//                    $newFileName = basename($file);
                    $domain = $oss->domain;

                    $filePath = $domain . $file;

                }

                if ($mark == 'qiniu') {
                    // 上传到七牛云服务器
                    // $this->qiniu();

                    // 用于签名的公钥和私钥
                    $accessKey = $oss->accesskey;
                    $secretKey = $oss->secretkey;
                    $bucket = $oss->bucket; // 目录
                    $qiniu_url = $oss->domain; // 七牛的外链域名

                    // 初始化签权对象
                    $auth = new Auth($accessKey, $secretKey);

                    // 生成上传Token
                    $token = $auth->uploadToken($bucket);

                    // 构建 UploadManager 对象
                    $uploadManager = new UploadManager();

                    // 上传文件名
                    $newFileName = basename($file);

                    // 文件上传
                    list($ret, $err) = $uploadManager->putFile($token, $newFileName, $file);

                    // $ret 返回格式 [{"hash":"FitYPv-Q2uGG51NXQj0F4IN6tfHb","key":"624bb15ed8930f5add49f90b88e969d8.jpg"}]

                    $filePath = $qiniu_url . $ret['key'] . '?token=' . $token;

                    // 删除目录下的文件 uploads_tmp
                    unlink($file);
                }

                $pictureitem = new PictureItem();
                $pictureitem->picture_id = $picture->id;
                $pictureitem->url = $filePath;
                $pictureitem->is_show = 1; // 0为不显示，1为显示
                $pictureitem->oss_tag = $oss_tag;
                $pictureitem->created_time = time();
                $pictureitem->updated_time = time();

                $pictureitem->save();
            }

            // 上传成功
            return ['code' => 0, 'msg' => '上传成功，等待审核。'];
        } elseif (isset($result['errcode']) && $result['errcode'] == 0 && $result['result']['suggest']!='pass'){
            return ['code' => -1, 'msg' => '标题或描述存在风险，请修改。'];
        } else {
            return ['code' => -1, 'msg' => $result['errmsg']];
        }
    }
}
