<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WechatApp;

class WechatAppController extends Controller
{
    // 小程序设置
    public function wechat_app()
    {
        $wechatapp = WechatApp::first();

        if(!empty($wechatapp))
        {
            $appid = $wechatapp->AppId;
            $appsecret = $wechatapp->AppSecret;
        } else {
            $appid = '';
            $appsecret = '';
        }     

        return view('admin.wechat_app',array(
            'appid' => $appid,
            'appsecret' => $appsecret
        ));
    }

    // 保存小程序设置
    public function save_wechat_app(Request $request)
    {
        $appid = $request->input('appid');
        $appsecret = $request->input('appsecret');

        $wechatapp = WechatApp::first();
        if(!empty($wechatapp))
        {
            $wechatapp->AppId = $appid;
            $wechatapp->AppSecret = $appsecret;
            $wechatapp->save();
        } else {
            $wechatapp = new WechatApp();
            $wechatapp->AppId = $appid;
            $wechatapp->AppSecret = $appsecret;
            $wechatapp->save();
        }
        
        // return '设置成功'; 
        return ['code' => 1, 'msg' => '保存成功'];
    }   
}
