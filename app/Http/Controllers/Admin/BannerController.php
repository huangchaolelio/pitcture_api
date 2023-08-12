<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Banner;

class BannerController extends Controller
{
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

    // 轮播图片上传,有文件选择即开始上传的地址
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
        $upload_path = $path . "/banner/";
        $file_path   = "banner/";

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
        $auto = false;
        if(!$auto)
        {            
            $file = $_FILES["imagefile_tmp"];

            if(!isset($file['tmp_name']) || !$file['tmp_name']) {
                echo json_encode(array('code' => 401, 'msg' => '没有文件上传'));
                return false;
            }

            // return $file;

            // public_path函数返回public目录的绝对路径
            $path = public_path();
            // $upload_path = $path . "/uploads/" . date('Ymd/');
            $upload_path = $path . "/banner/";
            $file_path   = "banner/";

            if(!is_dir($upload_path) && !mkdir($upload_path, 0777, true)){
                echo json_encode(array('code' => 403, 'msg' => '上传目录创建失败，请确认是否有权限'));
                return false;
            };

            // 获得文件扩展名
            $ext = pathinfo($file['name'][0], PATHINFO_EXTENSION);

            // 重新命名文件名字
            $newname = md5(time()) . '.'. $ext; // 新文件名md5改名

            if(move_uploaded_file($file["tmp_name"][0], $upload_path.$newname)){
                // echo json_encode(array('code' => 200, 'src' => $file_path.$newname));
                // return false;
                $filePath = $file_path.$newname;
            }else{
                echo json_encode(array('code' => 404, 'msg' => '上传失败'));
                return false;
            }
        }

        $banner = new Banner();
        // return $_POST['imagefile'];
        // return $request->input('imagefile')[0];

        $banner->first_title = $request->input('first_title');
        $banner->second_title = $request->input('second_title');
        $banner->url = $request->input('url');
        $banner->is_show = $request->input('is_show');
        $banner->orders = $request->input('orders');
        $banner->image = $filePath;
        // $banner->image = $request->input('imagefile')[0];
        $banner->created_time = time();
        $banner->updated_time = time();
        $banner->save();
        // return ['code' => 1, 'msg' =>'保存成功'];
        return redirect('admin/banner_list');
    }

    // 编辑banner
    public function editBanner(Request $request)
    {
        $banner = Banner::find($request->id);

        return view('admin/edit_banner', ['banner' => $banner]);
    }

    // 保存编辑banner
    public function saveEditBanner(Request $request)
    {
        $id = $request->id;

        $banner = Banner::find($id);

        $banner->first_title = $request->first_title;
        $banner->second_title = $request->second_title;
        $banner->url = $request->url;
        $banner->is_show = $request->is_show;
        $banner->orders = $request->orders;
        $banner->updated_time = time();

        $auto = false;
        if(!$auto)
        {            
            $file = $_FILES["imagefile_tmp"];

            if(!isset($file['tmp_name']) || !$file['tmp_name']) {
                echo json_encode(array('code' => 401, 'msg' => '没有文件上传'));
                return false;
            }

            // return $file;

            // public_path函数返回public目录的绝对路径
            $path = public_path();
            // $upload_path = $path . "/uploads/" . date('Ymd/');
            $upload_path = $path . "/banner/";
            $file_path   = "banner/";

            if(!is_dir($upload_path) && !mkdir($upload_path, 0777, true)){
                echo json_encode(array('code' => 403, 'msg' => '上传目录创建失败，请确认是否有权限'));
                return false;
            };

            // 获得文件扩展名
            $ext = pathinfo($file['name'][0], PATHINFO_EXTENSION);

            // 重新命名文件名字
            $newname = md5(time()) . '.'. $ext; // 新文件名md5改名

            if(move_uploaded_file($file["tmp_name"][0], $upload_path.$newname)){
                // echo json_encode(array('code' => 200, 'src' => $file_path.$newname));
                // return false;
                $filePath = $file_path.$newname;
            }else{
                echo json_encode(array('code' => 404, 'msg' => '上传失败'));
                return false;
            }
        }

        // 删除原有图片
        File::delete($banner->image);

        $banner->image = $filePath;

        $banner->save();
        // return ['code' => 1, 'msg' =>'保存成功'];
        return redirect('admin/banner_list');
    }

    // banner批量审核通过
    public function bannerShowIds(Request $request)
    {
        $ids = $request->ids;
        $banner = Banner::whereIn('id', $ids)->update(['is_show'=> 1]);
        return ['code' => 1, 'msg' => 'banner审核通过显示'];
    }

    // banner批量审核隐藏
    public function bannerHidenIds(Request $request)
    {
        $ids = $request->ids;
        $banner = Banner::whereIn('id', $ids)->update(['is_show'=> 0]);
        return ['code' => 1, 'msg' => 'banner审核隐藏'];
    }

    // 设置是否启用状态
    public function bannerStatus(Request $request)
    {
        $id = $request->id;
    
        $banner = Banner::find($id);

        if($banner->is_show == 1)
        {
            $banner->is_show = 0;
        } else {
            $banner->is_show = 1;
        }
        
        $banner->save();

        return redirect('admin/banner_list');
    }

    // banner批量删除
    public function bannerDelIds(Request $request)
    {
        $ids = $request->ids;

        foreach($ids as $id)
        {
            // 获得图片路径
            $banner = Banner::where('id', $id)->first();

            $image = $banner->image;
            
            // 删除图片 
            File::delete($image);

            // 删除数据表记录
            $banner->delete();
        }

        return ['code' => 1, 'msg' => 'banner批量删除成功'];
    }
}
