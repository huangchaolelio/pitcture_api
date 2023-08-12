<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Users;
use App\Models\WechatApp;

class UserController extends Controller
{
    //会员注册
    public function userlogin(Request $request)
    {
        // 小程序登录：https://developers.weixin.qq.com/miniprogram/dev/OpenApiDoc/user-login/code2Session.html

        // 获取授权临时票据（code）
        $code = $request->input('code');
        $userinfo = $request->input('userinfo');

        // 获得小程序的appid和secret设置
        $wechatapp = WechatApp::first();
        $appid = $wechatapp->AppId;
        $secret = $wechatapp->AppSecret;

        $client = new \GuzzleHttp\Client(); // curl模拟http进行get和post请求的类

        // 获取 access_token 和用户的 openid
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid . '&secret=' . $secret . '&js_code=' . $code . '&grant_type=authorization_code';
        // get请求 
        $res = $client->request('get', $url);

        // 返回请求的json数据
        $json = json_decode($res->getBody());

        $session_key = $json->session_key;
        $openid = $json->openid;

        $token = $session_key; // 用于前端判断是否会员登录状态

        $userinfo = json_encode($userinfo);
        $userinfo = json_decode($userinfo);
        // 查看变量类型
        // return gettype($userinfo);

        $user = Users::where('openid', $openid)->first();

        if($user)
        {
            return [
                'token' => $token,
                'expires_in' => 'Carbon::now()->addDays(30)',
                'user' => $user          
            ];

        } else {
            // 如果用户是第一次注册，保存用户信息
            $user = new Users();
            $user->openid = $openid; // 微信用户身份证明id
            $user->nickname = $userinfo->nickName;
            $user->gender = $userinfo->gender;
            $user->avatar_url = $userinfo->avatarUrl;
            $user->created_time = time();
            $user->updated_time = time();
            $user->save();
        }        

        return [
            'token' => $token,
            'expires_in' => 'Carbon::now()->addDays(30)',
            'user' => $user
        ];
    }

    // 非鉴权获取用户信息
    public function openAuthorInfo(Request $request)
    {
        $user_id = $request->user_id;
        $user = Users::find($user_id);
        return $user;
    }

    // 会员信息
    public function userInfo(Request $request)
    {
        $user_id = $request->user_id;
        $user = Users::find($user_id);
        return $user;
    }

}
