<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OssConfig extends Model
{
    // 云存储设置
    
    protected $table = 'oss_config';

    protected $primaryKey = 'id';

    //关闭更新  'updated_at`, `created_at' 字段
    public $timestamps = false;
}
