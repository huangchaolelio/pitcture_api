<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Picture;
use App\Models\PictureItem;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

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

        // $item_url = PictureItem::find($pic_item_id)->url;
        $pic_item = PictureItem::find($pic_item_id);

        // 记录图片下载次数
        $pic_item->download = $pic_item->download + 1;
        $pic_item->save();

        // 记录图辑下载次数
        $picture = Picture::find($pic_item->picture_id);
        $picture->download = $picture->download + 1;
        $picture->save();

        // 图片地址
        $item_url = $pic_item->url;

//        return  $item_url;
        /**
        * 由于小程序下载必须是https地址，七牛云https收费，使用了http不能直接下载，
        * 因此先把图片下载到服务器上再在小程中下载。功能图下。
        */
        // $file = '1.jpg';
        // $client = new \GuzzleHttp\Client(['verify' => false]);  //忽略SSL错误
        // $response = $client->get('https://www.yedushu.com/uploads/yds2/yds1691939621m.jpg', ['save_to' => $file]);  //保存远程url到文件

        // 新建下载文件用的临时目录
        $path = 'downloads_tmp';
        //判断保存目录是否存在，如果不存在则建立目录
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }

        // 获取url字符串截取路径文件名
        preg_match('/\/([^\/]+\.[a-z]+)[^\/]*$/', $item_url, $match);
        if(sizeof($match)==0) {
            $fileName = $pic_item_id . '_itemid.gif';
        } else {
            $fileName = $match[1];
        }

        $url = $item_url; // 远程图片的URL地址
        $image = file_get_contents($url); // 通过URL获取图片内容
//        $filePath = $path . '/' . mt_rand(1, 500) . $fileName; // 保存图片的本地路径
        $filePath = $path . '/' . $fileName; // 保存图片的本地路径
        if(!file_exists($filePath)) {
            file_put_contents($filePath, $image); // 将图片内容保存为本地文件
        }
        // 返回图片下载地址
//        return 'https://picture-api.mdoo.cn/' . $filePath;
        return 'https://funpic.fun/' . $filePath;
//        return $item_url;

    }

    // 图片列表
    public function itemlist()
    {
//        $itemlists = PictureItem::inRandomOrder()->take(50)->get();
//
//        foreach($itemlists as $itemlist)
//        {
//            $itemlist['image'] = $itemlist->url;
//        }
        $res = DB::table('picture_item')
            ->join('picture','picture_item.picture_id', '=', 'picture.id')
            ->select('picture_item.*',DB::raw('picture_item.url as image'))
            ->where('picture.is_show', '=', 1)
            ->where('picture_item.is_show', '=', 1)
            ->whereIn('picture.pic_category_id', ['16','21'])
            ->inRandomOrder()->take(20)->get();
        $itemlists = json_decode(json_encode($res), true);
        return $itemlists;
    }

}
