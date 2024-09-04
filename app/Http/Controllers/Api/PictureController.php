<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Picture;
use App\Models\PictureItem;
use App\Models\Users;

class PictureController extends Controller
{
    // 获得图辑列表
    public function main_picture_list(Request $request)
    {
//        $picturelists = Picture::where('is_show',1)->orderByDesc('created_time')->paginate(20);
        $picture_scope = $request->input('type');
        if($picture_scope == 1) {// 最新
            $timestamp = strtotime("-90 days");
            $picturelists = Picture::where('is_show',1)->where('created_time', '>',$timestamp)->orderByDesc('created_time')->paginate(20);
        } else { //推荐
            $picturelists = Picture::where('is_show',1)->inRandomOrder()->paginate(20);
        }

        foreach($picturelists as $picturelist)
        {
            $picturelist['user'] = Users::find($picturelist->user_id);
        }

        foreach($picturelists as $picturelist) {
            $picturelist['picitem'] = PictureItem::where('picture_id', $picturelist->id)->first();
        }
        return $picturelists;
    }

    // 获得分类的图辑列表
    public function picture_list(Request $request)
    {
        $picture_category_id = $request->input('picture_category_id');

        if($picture_category_id == 0)
        {
            // 获得推荐数据，随机推荐
            $pictures = Picture::where('is_show', 1)->inRandomOrder()->paginate(20);

            foreach($pictures as $picture)
            {
                $picture['image'] = PictureItem::where('picture_id', $picture->id)->first()->url;
            }

            return $pictures;

        }

        // 获得对应的分类的数据
        $pictures = Picture::where('is_show', 1)->where('pic_category_id', $picture_category_id)->orderByDesc('created_time')->paginate(20);

        // return $pictures;

        foreach($pictures as $picture)
        {
            $picture['image'] = PictureItem::where('picture_id', $picture->id)->first()->url;
        }

        return $pictures;
    }

    // 用户的图专列表
    public function user_picture_list(Request $request)
    {
        // 获取用户的id
        $user_id = $request->user_id;

        $picturelists = Picture::where('user_id', $user_id)->orderByDesc('created_time')->paginate(20);

        // 获得专辑的第一张图片
        foreach($picturelists as $picturelist)
        {
            $picturelist['url'] = PictureItem::where('picture_id', $picturelist->id)->first()->url;
        }

        return $picturelists;
    }

    // 获得分享的标题内容
    public function pictureShare(Request $request)
    {
        $pictureId = $request->image_id;
        $title = Picture::find($pictureId)->title;
        return $title;
    }
}
