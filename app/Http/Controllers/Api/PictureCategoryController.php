<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PictureCategory;

class PictureCategoryController extends Controller
{
    //图片分类
    public function picture_category_list(Request $request)
    {
        $picturecategorys = PictureCategory::where('is_show', 1)->orderBy('orders', 'asc')->get();

        return $picturecategorys;       
    }
}
