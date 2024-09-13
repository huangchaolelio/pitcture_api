<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PictureCollect;
use App\Models\Picture;
use App\Models\PictureItem;
use Illuminate\Support\Facades\DB;

class PictureCollectController extends Controller
{
    // 收藏图片专辑
   public function pictureCollect(Request $request)
   {
        $picture_id = $request->image_id;
        $user_id = $request->user_id;

        $isCollect = PictureCollect::where('user_id', $user_id)->where('picture_id', $picture_id)->first();
        if($isCollect)
        {
           return ['msg' => "您已收藏"];
        }

        // 记录收藏图片的会员
        $pictureCollect = new PictureCollect();

        $pictureCollect->picture_id = $picture_id;
        $pictureCollect->user_id = $user_id;

        $pictureCollect->created_time = time();
        $pictureCollect->updated_time = time();

        $pictureCollect->save();

        return ['msg' => "收藏成功"];
   }

   // 查询我的收藏
    public function userCollect(Request $request)
    {
        $user_id = $request->user_id;
        $myCollect = DB::table('picture_collect')
            ->join('picture','picture_collect.picture_id', '=', 'picture.id')
            // ->join('picture_item', 'picture.id', '=', 'picture_item.picture_id')
            ->select('picture.*')
            ->where('picture_collect.user_id', '=', $user_id)
            ->where('picture.is_show', '=', 1)
          //  ->where('picture_item.is_show', '=', 1)
            ->get();
        return $myCollect;
    }

}
