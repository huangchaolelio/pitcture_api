<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use App\Models\Picture;
use App\Models\PictureItem;
use App\Models\OssConfig;
use App\Models\Users;

class PictureItemController extends Controller
{
    // 图片列表
    public function picture_item_list()
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

        return view('admin.picture_item_list',array(
            'pictureitems' => $pictureitems
        ));
    }

    // 审核是否显示图片（显示或隐藏）
    public function picItemShow(Request $request)
    {
        $itemid = $request->itemid;

        $pictureItem = PictureItem::find($itemid);

        $is_show = $pictureItem->is_show;

        if($is_show == 0) {
            $pictureItem->is_show = 1;
        }

        if($is_show == 1) {
            $pictureItem->is_show = 0;
        }

        $pictureItem->save();

        return redirect('admin/picture_item_list');
    }

    // 编辑图片图片（picture_id/url）
    public function editPictureItem(Request $request)
    {
        $itemid = $request->itemid;

        $pictureItem = PictureItem::find($itemid);

        return view('admin/edit_picture_item', ['picture_item' => $pictureItem]);
    }

    // 保存图片图片（picture_id/url）
    public function savePictureItem(Request $request)
    {
        $id = $request->id;

        $picture_item = PictureItem::find($id);

        $picture_item->picture_id = $request->picture_id;
        $picture_item->url = $request->url;
        $picture_item->updated_time = time();

        $picture_item->save();
//         return ['code' => 1, 'msg' =>'保存成功'];
        return redirect('admin/picture_list');
    }

    // 图片批量审核通过
    public function picItemShowIds(Request $request)
    {
        $ids = $request->ids;
        $picture = PictureItem::whereIn('id', $ids)->update(['is_show'=> 1]);
        return ['code' => 1, 'msg' => '图片审核通过显示'];
    }

    // 图片批量审核隐藏
    public function pictureHidenIds(Request $request)
    {
        $ids = $request->ids;
        $picture = PictureItem::whereIn('id', $ids)->update(['is_show'=> 0]);
        return ['code' => 1, 'msg' => '图片审核隐藏显示'];
    }

    // 图片批量删除
    public function picItemDelIds(Request $request)
    {
        $ids = $request->ids;

        foreach($ids as $id)
        {
            // $key = "88b84eb42af67b252c3f9903920f33ed.jpg";

            // 获得图辑下的所有图片
            $picitems = PictureItem::where('id', $id)->get();

            // 删除对应图片
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

        return ['code' => 1, 'msg' => '图片删除成功'];
    }

    // 显示对应图辑里的图片列表
    public function picItemId(Request $request)
    {
        $picture_id = $request->picture_id;

        $pictureItem = PictureItem::where('picture_id',$picture_id)->get();
        // return $pictureItem;

        return view('admin/pic_item_id', array('pictureItem' => $pictureItem));
    }
}
