<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Picture;
use App\Models\PictureItem;
use App\Models\Users;

class PictureItemController extends Controller
{
    // details.vue 对应专辑中的图片列表
    public function pic_item_list(Request $request)
    {
        // 图片专辑的id
        $picture_id = $request->image_id;

        $picitemlists = PictureItem::where('picture_id', $picture_id)->get();

        // 图片所属会员
        foreach($picitemlists as $pictureitemlist)
        {
            $picture = Picture::where('id', $pictureitemlist->picture_id)->first();
            $user_id = $picture->user_id;
            $pictureitemlist['userinfo'] = Users::where('id', $user_id)->first();
        }

        return $picitemlists;
    }

    // 下载图片
    public function pic_item_download(Request $request)
    {
        // 图片的id
        $pic_item_id = $request->image_id;

        $item_url = PictureItem::find($pic_item_id)->url;

        // // 下载图片的地址
        return $item_url;
    }

    // 图片列表
    public function itemlist()
    {
        $itemlists = PictureItem::inRandomOrder()->take(300)->get();

        foreach($itemlists as $itemlist)
        {
            $itemlist['image'] = $itemlist->url;
        }
        return $itemlists;
    }
    
}
