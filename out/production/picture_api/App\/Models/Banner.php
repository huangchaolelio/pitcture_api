<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    // 轮播图片
    
    protected $table = 'banner';

    protected $primaryKey = 'id';

    //关闭更新  'updated_at`, `created_at' 字段
    public $timestamps = false;
}
