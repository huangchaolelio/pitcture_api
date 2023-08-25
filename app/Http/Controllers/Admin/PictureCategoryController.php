<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use App\Models\Picture;
use App\Models\PictureItem;
use App\Models\PictureCategory;

class PictureCategoryController extends Controller
{
    // 审核是否显示图片分类（显示或隐藏）
    public function pictureCategoryShow(Request $request)
    {
        $id = $request->id;

        $category = PictureCategory::find($id);

        $is_show = $category->is_show;

        if($is_show == 0) {
            $category->is_show = 1;
        }

        if($is_show == 1) {
            $category->is_show = 0;
        }

        $category->save();

        return redirect('admin/picture_category_list');
    }

    // 图片分类批量审核通过
    public function categoryShowIds(Request $request)
    {
        $ids = $request->ids;
        $category = PictureCategory::whereIn('id', $ids)->update(['is_show'=> 1]);
        return ['code' => 1, 'msg' => '图片分类审核通过显示'];
    }

    // 图片批量审核隐藏
    public function categoryHidenIds(Request $request)
    {
        $ids = $request->ids;
        $picture = PictureCategory::whereIn('id', $ids)->update(['is_show'=> 0]);
        return ['code' => 1, 'msg' => '图片分类审核隐藏显示'];
    }

    // 图片分类批量删除
    public function categoryDelIds(Request $request)
    {
        $ids = $request->ids;

        foreach($ids as $id)
        {
            $pictures = Picture::where('pic_category_id', $id)->get();

            foreach($pictures as $picture)
            {
                $pictureItems = PictureItem::where('picture_id', $picture->id)->get();

                // 删除图辑下的全部图片
                foreach($pictureItems as $pictureItem)
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
                        preg_match('/\/([^\/]+\.[a-z]+)[^\/]*$/', $pictureItem->url, $match); 
                        $key = $match[1]; 

                        $err = $bucketManager->delete($bucket, $key);

                        // if ($err) {
                        //     // print_r($err);
                        //     return ['code' => 0, 'msg' => $err];
                        // }
                    }                    
                }

                // 删除图片记录
                $pictureItems = PictureItem::where('picture_id', $picture->id)->delete();
            }

            // 删除图辑记录
            $pictures = Picture::where('pic_category_id', $id)->delete();
        }

        // 删除分类 
        $picture = PictureCategory::whereIn('id', $ids)->delete();
        return ['code' => 1, 'msg' => '图片分类删除成功'];
    }

    // 添加图片分类
    public function add_picture_category(Request $request)
    {
        $picturecategory = new PictureCategory();

        $picturecategory->title = $request->input('title');
        $picturecategory->orders = $request->input('orders');
        $picturecategory->is_show = $request->input('isshow');
        $picturecategory->created_time = time();
        $picturecategory->updated_time = time();
        $picturecategory->save();

        // return "保存分类成功";
        return ['code' => 1, 'msg' => '保存分类成功'];
    }

    // 编辑更新图片分类
    public function update_picture_category(Request $request)
    {
        $picturecategory = PictureCategory::find($request->input('data_id'));
        $picturecategory->title = $request->input('title');
        $picturecategory->orders = $request->input('orders');
        $picturecategory->is_show = $request->input('isshow');
        $picturecategory->updated_time = time();
        $picturecategory->save();

        // return "修改分类成功";
        return ['code' => 1, 'msg' => '修改分类成功'];
    }

    // 图片分类列表
    public function picture_category_list()
    {
        $picture_list = PictureCategory::orderBy('orders', 'asc')->paginate(15);
        Paginator::useBootstrapFive();

        return view('admin.picture_category_list', array(
            'pictures' => $picture_list
        ));
    }
}
