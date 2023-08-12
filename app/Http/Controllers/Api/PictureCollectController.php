<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PictureCollect;

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

        $pictureCollect = new PictureCollect();

        $pictureCollect->picture_id = $picture_id;
        $pictureCollect->user_id = $user_id;

        $pictureCollect->created_time = time();
        $pictureCollect->updated_time = time();

        $pictureCollect->save();

        return ['msg' => "收藏成功"];    
   }
    
}
