<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{
    // 管理员数据库
    
    protected $table = 'admin_users';

    protected $primaryKey = 'id';

    //关闭更新  'updated_at`, `created_at' 字段
    public $timestamps = false;
}
