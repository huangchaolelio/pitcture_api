<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Users;

class UsersController extends Controller
{
    // 审核用户是否可以正常登录
    public function userVerify(Request $request)
    {
        $userid = $request->id;

        $user = Users::find($userid);

        $disable = $user->disable;

        if($disable == 0) {
            $user->disable = 1;
        }

        if($disable == 1) {
            $user->disable = 0;
        }

        $user->save();

        return redirect('admin/users_list');
    }

    // 会员批量审核通过
    public function userEnabledIds(Request $request)
    {
        $ids = $request->ids;
        $users = Users::whereIn('id', $ids)->update(['disable'=> 1]);
        return ['code' => 1, 'msg' => '会员审核通过正常'];
    }

    // 会员批量审核禁止登录
    public function userDisableIds(Request $request)
    {
        $ids = $request->ids;        
        $users = Users::whereIn('id', $ids)->update(['disable'=> 0]);
        return ['code' => 1, 'msg' => '会员审核禁止登录'];
    }
}
