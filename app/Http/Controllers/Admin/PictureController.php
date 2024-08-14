<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use App\Models\Picture;
use App\Models\PictureItem;
use App\Models\OssConfig;
use App\Models\PictureCategory;
use App\Models\PictureDescribe;
use App\Models\Users;

class PictureController extends Controller
{
    // 图辑列表
    public function picture_list()
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

        return view('admin.picture_list', array(
            'pictures' => $pictures
        ));
    }

    // 审核是否显示图辑（显示或隐藏）
    public function pictureShow(Request $request)
    {
        $picid = $request->picid;

        $picture = Picture::find($picid);

        $is_show = $picture->is_show;

        if($is_show == 0) {
            $picture->is_show = 1;
        }

        if($is_show == 1) {
            $picture->is_show = 0;
        }

        $picture->save();

        return redirect('admin/picture_list');
    }

    // 图辑批量审核通过
    public function pictureShowIds(Request $request)
    {
        $ids = $request->ids;
        $picture = Picture::whereIn('id', $ids)->update(['is_show'=> 1]);
        return ['code' => 1, 'msg' => '图辑审核通过显示'];
    }

    // 编辑banner
    public function editPicture(Request $request)
    {
        $picture = Picture::find($request->id);

        return view('admin/edit_picture', ['picture' => $picture]);
    }


    // 保存编辑Picture
    public function savePicture(Request $request)
    {
        $id = $request->id;

        $picture = Picture::find($id);

        $picture->title = $request->title;
        $picture->describe = $request->describe;
        $picture->updated_time = time();

        $picture->save();
        // return ['code' => 1, 'msg' =>'保存成功'];
        return redirect('admin/picture_list');
    }

    // 图辑批量审核隐藏
    public function pictureHidenIds(Request $request)
    {
        $ids = $request->ids;
        $picture = Picture::whereIn('id', $ids)->update(['is_show'=> 0]);
        return ['code' => 1, 'msg' => '图辑审核隐藏显示'];
    }

    // 图辑批量删除
    public function pictureDelIds(Request $request)
    {
        $ids = $request->ids;

        foreach($ids as $id)
        {
            // $key = "88b84eb42af67b252c3f9903920f33ed.jpg";

            // 获得图辑下的所有图片
            $picitems = PictureItem::where('picture_id', $id)->get();

            // 删除图辑下的全部图片
            foreach($picitems as $picitem)
            {
                // 判断文件存放位置
                $oss = OssConfig::where('tag',$picitem->oss_tag)->first();
                $mark = $oss->mark;

                // 图片从七牛存储中删除
                if($mark == 'qiniu')
                {
                    $accessKey = $oss->accesskey;
                    $secretKey = $oss->secretkey;
                    $bucket = $oss->bucket;

                    $auth = new \Qiniu\Auth($accessKey, $secretKey);
                    $config = new \Qiniu\Config();
                    $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);

                    // 获取url字符串截取路径文件名
                    preg_match('/\/([^\/]+\.[a-z]+)[^\/]*$/', $picitem->url, $match);
                    $key = $match[1];

                    $err = $bucketManager->delete($bucket, $key);

                    // if ($err) {
                    //     // print_r($err);
                    //     return ['code' => 0, 'msg' => $err];
                    // }

                    // 删除图片数据表记录
                     $picitem->delete();
                 }
            }
        }

        // 删除图辑
        $pictures = Picture::whereIn('id', $ids)->delete();

        return ['code' => 1, 'msg' => '图辑删除成功'];
    }
}
