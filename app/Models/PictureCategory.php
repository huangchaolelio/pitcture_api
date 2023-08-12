<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PictureCategory extends Model
{
    // 图库分类
    
    protected $table = 'picture_category';

    protected $primaryKey = 'id';

    //关闭更新  'updated_at`, `created_at' 字段
    public $timestamps = false;
}
