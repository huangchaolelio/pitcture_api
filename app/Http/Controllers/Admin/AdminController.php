<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\PictureCategory;
use App\Models\Banner;
use App\Models\OssConfig;
use App\Models\WechatApp;
use App\Models\Picture;
use App\Models\PictureItem;
use App\Models\Users;
use App\Models\AdminUsers;
use App\Models\PictureDescribe;

class AdminController extends Controller
{
    // 后台登录页面
    public function login()
    {
        return view('admin.login');
    }

    // 后台页面登录验证
    public function postLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        // 获得输入的验证码
        $captcha_code = $request->captcha_code; 

        $adminuser = AdminUsers::where('username', $username)->first();

        if(!$adminuser)
        {
            return ['code' => 0, 'msg' => '用户名不存在'];
        }

        // 验证密码是否正确
        if (!Hash::check($password, $adminuser->password))
        {
            return ['code' => 0, 'msg' => '密码错误'];
        }

        // 判断验证码是否正确
        if(!captcha_check($captcha_code)){
           return ['code' => 0, 'msg' => '验证码错误'];;
        } else {
            // 登录成功
            Session::put('username', $username);
            // 跳转到后台首页
            // return redirect('admin/index');
            return ['code' => 1, 'msg' => '登录成功'];
        }
    }

    // 管理后台
    public function index()
    {
        return view('admin.index');
    }

    // 后台首页
    public function main()
    {
        $users = Users::get();
        $userCount = count($users);

        $downloads = Picture::get()->sum('download');

        $pictureItems = PictureItem::get();
        $pictureItemsCount = count($pictureItems);

        return view('admin.main',array(
            'userCount' => $userCount,
            'downloads' => $downloads,
            'pictureItemsCount' => $pictureItemsCount
        ));
    }    

    // 轮播图列表
    public function banner_list()
    {
        $banner_list = Banner::orderByDesc('orders')->paginate(15);
        Paginator::useBootstrapFive();

        return view('admin.banner_list',array(
            'banners' => $banner_list
        ));
    }

    // 新增加轮播图
    public function add_banner()
    {
        return view('admin.add_banner');

    }

    // 轮播图片上传
    public function post_banner()
    {
        $file = $_FILES["imagefile"];
        if(!isset($file['tmp_name']) || !$file['tmp_name']) {
            echo json_encode(array('code' => 401, 'msg' => '没有文件上传'));
            return false;
        }
        if($file["error"] > 0) {
            echo json_encode(array('code' => 402, 'msg' => $file["error"]));
            return false;
        }

        // public_path函数返回public目录的绝对路径
        $path = public_path();
        // $upload_path = $path . "/uploads/" . date('Ymd/');
        $upload_path = $path . "/uploads/";
        $file_path   = "/uploads/";

        if(!is_dir($upload_path) && !mkdir($upload_path, 0777, true)){
            echo json_encode(array('code' => 403, 'msg' => '上传目录创建失败，请确认是否有权限'));
            return false;
        };

        // 获得文件扩展名
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        // 重新命名文件名字
        $newname = md5(time()) . '.'. $ext; // 新文件名md5改名

        if(move_uploaded_file($file["tmp_name"], $upload_path.$newname)){
            echo json_encode(array('code' => 200, 'src' => $file_path.$newname));
            return false;
        }else{
            echo json_encode(array('code' => 404, 'msg' => '上传失败'));
            return false;
        }
    }

    // 保存轮播图数据
    public function save_banner(Request $request)
    {
        $banner = new Banner();
        // return $_POST['imagefile'];
        // return $request->input('imagefile')[0];

        $banner->first_title = $request->input('first_title');
        $banner->second_title = $request->input('second_title');
        $banner->url = $request->input('url');
        $banner->is_show = $request->input('is_show');
        $banner->orders = $request->input('orders');
        $banner->image = $request->input('imagefile')[0];
        $banner->created_time = time();
        $banner->updated_time = time();
        $banner->save();
        return '保存成功';
    }    

    // 小程序设置
    public function wechat_app()
    {
        $wechatapp = WechatApp::first();

        if(!empty($wechatapp))
        {
            $appid = $wechatapp->AppId;
            $appsecret = $wechatapp->AppSecret;
        } else {
            $appid = '';
            $appsecret = '';
        }     

        return view('admin.wechat_app',array(
            'appid' => $appid,
            'appsecret' => $appsecret
        ));
    }

    // 保存小程序设置
    public function save_wechat_app(Request $request)
    {
        $appid = $request->input('appid');
        $appsecret = $request->input('appsecret');

        $config = WechatApp::find(1);
        $config->AppId = $appid;
        $config->AppSecret = $appsecret;
        $config->save();
        // return '设置成功'; 
        return ['code' => 1, 'msg' => '保存成功'];
    }

    // 图辑列表
    public function picture_audit()
    {
        $pictures = Picture::orderBy('created_time', 'desc')->paginate(15);
        Paginator::useBootstrapFive();

        foreach($pictures as $picture)
        {
            // 对应分类
            $picture['picCategory'] = PictureCategory::where('id', $picture->pic_category_id)->first();

            // 对应的描述
            $picture['describe'] = PictureDescribe::where('picture_id', $picture->id)->first();

            // 对应用户
            $picture['user'] = Users::where('id', $picture->user_id)->first();
        }

        return view('admin.picture_audit', array(
            'pictures' => $pictures
        ));
    }

    // 图片列表
    public function picture_list()
    {
        $pictureitems = PictureItem::orderByDesc('created_time')->paginate(15);
        Paginator::useBootstrapFive();
        // Paginator::useBootstrapFour();

        foreach($pictureitems as $pictureitem)
        {
            // 获得图辑的信息
            $pictureitem['picture'] =Picture::where('id', $pictureitem->picture_id)->first();

            // 获得会员的信息
            $pictureitem['user'] = Users::find($pictureitem->picture->user_id);
        }

        return view('admin.picture_list',array(
            'pictureitems' => $pictureitems
        ));
    }

    // 会员列表
    public function usersList()
    {
        $users = Users::orderByDesc('created_time')->paginate(15);
        Paginator::useBootstrapFive();

        return view('admin.users_list',array(
            'users' => $users
        ));
    }

    // 退出登录
    public function logout()
    {
        Session::put('username', '');
        return redirect('admin/login');
    }

    // 修改密码
    public function editPwd()
    {
        return view('admin/edit_pwd');
    }

    // 保存修改的密码
    public function saveEditPwd(Request $request)
    {
        $oldpwd = $request->oldpwd;
        $newpwd = $request->newpwd;

        $admin = AdminUsers::where('username', Session::get('username'))->first();

        // 确认旧密码是否正确
        if (!Hash::check($oldpwd, $admin->password))
        {
            return ['code' => 0, 'msg' => '旧密码错误'];
        }

        // 保存新密码
        $admin->password = Hash::make($newpwd);
        $admin->save();

        return ['code' => 1, 'msg' => '密码修改成功'];

    }
}
