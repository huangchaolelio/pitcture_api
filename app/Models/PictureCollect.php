<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PictureCollect extends Model
{
    // 图片专辑收藏
    
    protected $table = 'picture_collect';

    protected $primaryKey = 'id';

    //关闭更新  'updated_at`, `created_at' 字段
    public $timestamps = false;
}
