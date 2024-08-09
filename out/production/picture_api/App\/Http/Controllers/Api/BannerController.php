<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banner;

class BannerController extends Controller
{
   public function banner_list()
   {
        // 获得banner
        $bannerlist = Banner::where('is_show', 1)->take(3)->get();
        return $bannerlist;
   }
}
