<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// 图片分类列表
Route::get('picture_category_list', [App\Http\Controllers\Api\PictureCategoryController::class, 'picture_category_list']);

// 用户注册
Route::post('user/login', [App\Http\Controllers\Api\UserController::class, 'userlogin']);



// 前端用户发布图片
Route::post('author/publish_pictures', [App\Http\Controllers\Api\PublishPicController::class, 'publish_pictures']);

// 前端用户发布图片<tn-image-upload>组件用到的上传路由
Route::post('picture/upload', [App\Http\Controllers\Api\PublishPicController::class, 'picture_upload']);

// 获得分类的图辑列表
Route::get('picture_list', [App\Http\Controllers\Api\PictureController::class, 'picture_list']);

// 获得图辑列表
Route::get('main_picture_list', [App\Http\Controllers\Api\PictureController::class, 'main_picture_list']);

// 获得banner
Route::get('banner_list', [App\Http\Controllers\Api\BannerController::class, 'banner_list']);

// details.vue 对应专辑中的图片列表
Route::get('img/item', [App\Http\Controllers\Api\PictureItemController::class, 'pic_item_list']);

// 收藏图片专辑
Route::post('img/collect', [App\Http\Controllers\Api\PictureCollectController::class, 'pictureCollect']);

// 下载图片
Route::post('img/download', [App\Http\Controllers\Api\PictureItemController::class, 'pic_item_download']);

// 用户的图辑列表
Route::get('user_picture_list', [App\Http\Controllers\Api\PictureController::class, 'user_picture_list']);

// 非鉴权获取用户信息
Route::get('open/author/info', [App\Http\Controllers\Api\UserController::class, 'openAuthorInfo']);

// 图片列表
Route::get('item/list', [App\Http\Controllers\Api\PictureItemController::class, 'itemlist']);

// 获取会员信息
Route::get('user/info', [App\Http\Controllers\Api\UserController::class, 'userInfo']);

// 获得分享的标题内容
Route::post('picture/share', [App\Http\Controllers\Api\PictureController::class, 'pictureShare']);