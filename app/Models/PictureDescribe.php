<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PictureDescribe extends Model
{
    // 图辑介绍
    
    protected $table = 'picture_describe';

    protected $primaryKey = 'id';

    //关闭更新  'updated_at`, `created_at' 字段
    public $timestamps = false;
}
