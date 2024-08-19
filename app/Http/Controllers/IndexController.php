<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Http\Request;

use App\Models\PictureItem;

class IndexController extends Controller
{
    // 网站首页
    public function index()
    {
        $pictureItems = PictureItem::inRandomOrder()->take(20)->get();

        foreach($pictureItems as $pictureItem)
        {
            $pictureItem['image'] = $pictureItem->url;
            $pictureItem['picture'] = Picture::where('id',$pictureItem->picture_id)->first();
        }

        return view('index',array('pictureItems' => $pictureItems));
    }
}
