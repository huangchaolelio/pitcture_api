<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        }

        return view('index',array('pictureItems' => $pictureItems));
    }
}
