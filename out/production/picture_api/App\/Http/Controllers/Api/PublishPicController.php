<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Response;

use App\Models\PictureCategory;
use App\Models\Users;
use App\Models\Picture;
use App\Models\PictureItem;
use App\Models\PictureDescribe;
use App\Models\OssConfig;

// 七牛上传
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class PublishPicController extends Controller
{   
    // 前端用户发布图片<tn-image-upload>组件用到的上传路由
    public function picture_upload(Request $request)
    {
        // 上传文件参数为file
        $file = $request->file('file');

        // 获取缓存在服务器 tmp 目录下的文件名,（带后缀，如 php8933.tmp）
        $fileTempName = $file->getFilename();

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

        // $movePath格式： uploads_tmp\fe88b153d4ab995e20ac59cffcb959a9.jpg
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
        $picture->device_type = $request->input('pic_device'); // 图片可以使用的平台类别
        $picture->item_count = $request->input('pic_count'); // 上传图片数量
        $picture->score = $request->input('pic_score');  // 积分
        $picture->pic_category_id = $request->input('pic_categoryid'); // 图片分类
        $picture->is_show = 0; // 默认为不显示图片专辑
        $picture->created_time = time();
        $picture->updated_time = time();
        $picture->save();

        $desc = $request->input('pic_desc');
        if($desc != '')
        {
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
        foreach($files as $file)
        {
            if($mark == 'localhost') {
                // 上传到本地服务器
                $this->local();
            }

            if($mark == 'qiniu') {
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
    }
}
