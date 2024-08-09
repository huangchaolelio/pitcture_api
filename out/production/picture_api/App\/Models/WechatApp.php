<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WechatApp extends Model
{
    // 微信小程序设置保存
    
    protected $table = 'wechat_app';

    protected $primaryKey = 'id';

    //关闭更新  'updated_at`, `created_at' 字段
    public $timestamps = false;
}
