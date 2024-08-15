<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Admin\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

// 网站首页
Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);

// 后台登录页面
Route::get('admin/login', [App\Http\Controllers\Admin\AdminController::class, 'login']);

// 后台页面登录验证
Route::post('admin/login', [App\Http\Controllers\Admin\AdminController::class, 'postLogin']);

/**
* 登录成功后可以访问的页面
**/
Route::group(['prefix' => 'admin', 'middleware' =>'adminLogin'], function () {

    // 管理后台控制台
    Route::get('index', [App\Http\Controllers\Admin\AdminController::class, 'index']);

    // 后台首页
    Route::get('main', [App\Http\Controllers\Admin\AdminController::class, 'main']);

    // 新增图片分类
    Route::post('add_picture_category', [App\Http\Controllers\Admin\PictureCategoryController::class, 'add_picture_category']);

    // 编辑更新图片分类
    Route::post('update_picture_category', [App\Http\Controllers\Admin\PictureCategoryController::class, 'update_picture_category']);

    // 图片分类列表
    Route::get('picture_category_list', [App\Http\Controllers\Admin\PictureCategoryController::class, 'picture_category_list']);

    // 轮播图列表
    Route::get('banner_list', [App\Http\Controllers\Admin\BannerController::class, 'banner_list']);

    // 新增加轮播图
    Route::get('add_banner', [App\Http\Controllers\Admin\BannerController::class, 'add_banner']);

    // 轮播图片上传
    Route::post('post_banner', [App\Http\Controllers\Admin\BannerController::class, 'post_banner']);

    // 保存轮播图数据
    Route::post('save_banner', [App\Http\Controllers\Admin\BannerController::class, 'save_banner']);

    // 编辑banner
    Route::get('edit_banner', [App\Http\Controllers\Admin\BannerController::class, 'editBanner']);

    // 保存编辑banner
    Route::post('save_edit_banner', [App\Http\Controllers\Admin\BannerController::class, 'saveEditBanner']);

    // banner批量审核通过
    Route::post('banner_show_ids', [App\Http\Controllers\Admin\BannerController::class, 'bannerShowIds']);

    // banner批量审核隐藏
    Route::post('banner_hiden_ids', [App\Http\Controllers\Admin\BannerController::class, 'bannerHidenIds']);

    // banner批量删除
    Route::post('banner_del_ids', [App\Http\Controllers\Admin\BannerController::class, 'bannerDelIds']);

    // 设置是否启用状态
    Route::get('banner_status', [App\Http\Controllers\Admin\BannerController::class, 'bannerStatus']);

    // 云存储设置列表
    Route::get('oss_list', [App\Http\Controllers\Admin\OssController::class, 'ossList']);

    // 云存储设置
    Route::get('oss_config', [App\Http\Controllers\Admin\OssController::class, 'ossConfig']);

    // 保存云存储设置
    Route::post('oss_config', [App\Http\Controllers\Admin\OssController::class, 'postOssConfig']);

    // 添加云存储设置
    Route::post('add_oss_config', [App\Http\Controllers\Admin\OssController::class, 'addOssConfig']);

    // 设置是否启用状态
    Route::get('oss_set_status', [App\Http\Controllers\Admin\OssController::class, 'ossSetStatus']);

    // 删除oss
    Route::post('oss_del', [App\Http\Controllers\Admin\OssController::class, 'ossDel']);

    // 编辑oss，localhost
    Route::get('oss_edit_local', [App\Http\Controllers\Admin\OssController::class, 'ossEditLocal']);

    // 编辑oss，七牛云
    Route::get('oss_edit_qiniu', [App\Http\Controllers\Admin\OssController::class, 'ossEditQiniu']);

    // 编辑oss，阿里云
    Route::get('oss_edit_alioss', [App\Http\Controllers\Admin\OssController::class, 'ossEditAlioss']);

    // 编辑oss，tencentcos
    Route::get('oss_edit_tencentcos', [App\Http\Controllers\Admin\OssController::class, 'ossEditTencentcos']);

    // 保存oos编辑的内容
    Route::post('save_oss_edit', [App\Http\Controllers\Admin\OssController::class, 'saveOssEdit']);

    // 小程序设置
    Route::get('wechat_app', [App\Http\Controllers\Admin\WechatAppController::class, 'wechat_app']);

    // 保存小程序设置
    Route::post('wechat_app', [App\Http\Controllers\Admin\WechatAppController::class, 'save_wechat_app']);

    // 新增图辑分类
    Route::post('add_picture', [App\Http\Controllers\Admin\PictureController::class, 'add_picture']);

    // 编辑更新图辑
    Route::post('update_picture', [App\Http\Controllers\Admin\PictureController::class, 'update_picture']);

    // 图辑列表
    Route::get('picture_list', [App\Http\Controllers\Admin\PictureController::class, 'picture_list']);

    // 编辑图辑
    Route::get('edit_picture', [App\Http\Controllers\Admin\PictureController::class, 'editPicture']);

    // 保存图辑
    Route::post('save_picture', [App\Http\Controllers\Admin\PictureController::class, 'savePicture']);

    // 图片列表
    Route::get('picture_item_list', [App\Http\Controllers\Admin\PictureItemController::class, 'picture_item_list']);

    // 会员列表
    Route::get('users_list', [App\Http\Controllers\Admin\UsersController::class, 'usersList']);

    // 图辑审核是否显示
    Route::get('picture_show', [App\Http\Controllers\Admin\PictureController::class, 'pictureShow']);

    // 图辑批量审核通过
    Route::post('picture_show_ids', [App\Http\Controllers\Admin\PictureController::class, 'pictureShowIds']);

    // 图辑批量审核隐藏
    Route::post('picture_hiden_ids', [App\Http\Controllers\Admin\PictureController::class, 'pictureHidenIds']);

    // 图辑批量删除
    Route::post('picture_del_ids', [App\Http\Controllers\Admin\PictureController::class, 'pictureDelIds']);

    // 图片分类审核是否显示
    Route::get('picture_category_show', [App\Http\Controllers\Admin\PictureCategoryController::class, 'pictureCategoryShow']);

    // 图片分类批量审核通过
    Route::post('category_show_ids', [App\Http\Controllers\Admin\PictureCategoryController::class, 'categoryShowIds']);

    // 图片分类批量审核隐藏
    Route::post('category_hiden_ids', [App\Http\Controllers\Admin\PictureCategoryController::class, 'categoryHidenIds']);

    // 图片分类批量删除
    Route::post('category_del_ids', [App\Http\Controllers\Admin\PictureCategoryController::class, 'categoryDelIds']);

    // 图片审核是否显示
    Route::get('picitem_show', [App\Http\Controllers\Admin\PictureItemController::class, 'picItemShow']);

    // 图片批量审核通过
    Route::post('picitem_show_ids', [App\Http\Controllers\Admin\PictureItemController::class, 'picitemShowIds']);

    // 图片批量审核隐藏
    Route::post('picitem_hiden_ids', [App\Http\Controllers\Admin\PictureItemController::class, 'pictureHidenIds']);

    // 图片批量删除
    Route::post('picitem_del_ids', [App\Http\Controllers\Admin\PictureItemController::class, 'picItemDelIds']);

    // 显示对应图辑里的图片列表
    Route::get('pic_item_id', [App\Http\Controllers\Admin\PictureItemController::class, 'picItemId']);

    // 编辑图辑的图片
    Route::get('edit_picture_item', [App\Http\Controllers\Admin\PictureItemController::class, 'editPictureItem']);

    // 保存图辑的图片
    Route::post('save_picture_item', [App\Http\Controllers\Admin\PictureItemController::class, 'savePictureItem']);

    // 审核用户是否可以正常登录
    Route::get('user_verify', [App\Http\Controllers\Admin\UsersController::class, 'userVerify']);

    // 会员批量审核通过
    Route::post('user_enabled_ids', [App\Http\Controllers\Admin\UsersController::class, 'userEnabledIds']);

    // 会员批量审核禁止登录
    Route::post('user_disable_ids', [App\Http\Controllers\Admin\UsersController::class, 'userDisableIds']);

    // 退出登录
    Route::get('logout', [App\Http\Controllers\Admin\AdminController::class, 'logout']);

    // 修改密码
    Route::get('edit_pwd', [App\Http\Controllers\Admin\AdminController::class, 'editPwd']);

    // 保存修改的密码
    Route::post('edit_pwd', [App\Http\Controllers\Admin\AdminController::class, 'saveEditPwd']);

    // 文章列表
    Route::get('article', [App\Http\Controllers\Admin\ArticleController::class, 'article']);

    // 添加|编辑文章
    Route::get('post_article', [App\Http\Controllers\Admin\ArticleController::class, 'postArticle']);

    // 保存添加的文章内容
    Route::post('save_article', [App\Http\Controllers\Admin\ArticleController::class, 'saveArticle']);

    // 文章批量审核通过
    Route::post('article_show_ids', [App\Http\Controllers\Admin\ArticleController::class, 'articleShowIds']);

    // 文章批量隐藏
    Route::post('article_hiden_ids', [App\Http\Controllers\Admin\ArticleController::class, 'articleHidenIds']);

    // 文章批量删除
    Route::post('article_del_ids', [App\Http\Controllers\Admin\ArticleController::class, 'articleDelIds']);

    // 文章设置是否启用状态
    Route::get('article_status', [App\Http\Controllers\Admin\ArticleController::class, 'articleStatus']);
});
