<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OssConfig;

class OssController extends Controller
{
    // 云存储设置列表
    public function OssList()
    {
        $ossList = OssConfig::orderByDesc('id')->paginate(15);

        return view('admin.oss_list', array(
            'osslists' => $ossList
        ));
    }

    // 云存储设置
    public function ossConfig()
    {
        return view('admin.oss_config');
    }

    // 添加云存储设置
    public function addOssConfig(Request $request)
    {
        $mark = $request->mark;

        // 添加本地服务器的目录
        if($mark == 'localhost')
        {
            $local = new OssConfig();

            $local->name = '本地服务器';
            $local->mark = $mark;
            $local->bucket = $request->local_bucket;
            $local->domain = $request->local_domain;
                
            if($request->local_status == 1)
            {
                $ids = OssConfig::get('id');
                OssConfig::whereIn('id', $ids)->update(['status'=> 0]);
                $local->status = 1;
            }

            $local->created_time = time();
            $local->updated_time = time();

            $local->save();
        }

        // 添加七牛云存储设置
        if($mark == 'qiniu')
        {
            $qiniu = new OssConfig();

            $qiniu->name = '七牛云存储';
            $qiniu->mark = $mark;
            $qiniu->bucket = $request->qiniu_bucket;
            $qiniu->domain = $request->qiniu_domain;
            $qiniu->accesskey = $request->qiniu_accesskey;
            $qiniu->secretkey = $request->qiniu_secretkey;
                
            if($request->qiniu_status == 1)
            {
                $ids = OssConfig::get('id');
                OssConfig::whereIn('id', $ids)->update(['status'=> 0]);
                $qiniu->status = 1;
            }

            $qiniu->created_time = time();
            $qiniu->updated_time = time();

            $qiniu->save();
        }

        // 添加阿里云oss设置
        if($mark == 'alioss')
        {
            $alioss = new OssConfig();

            $alioss->name = '阿里云OSS';
            $alioss->mark = $mark;
            $alioss->bucket = $request->alioss_bucket;
            $alioss->domain = $request->alioss_domain;
            $alioss->accesskey = $request->alioss_accesskey;
            $alioss->secretkey = $request->alioss_secretkey;
                
            if($request->alioss_status == 1)
            {
                $ids = OssConfig::get('id');
                OssConfig::whereIn('id', $ids)->update(['status'=> 0]);
                $alioss->status = 1;
            }

            $alioss->created_time = time();
            $alioss->updated_time = time();

            $alioss->save();
        }

        // 添加腾讯云COS设置
        if($mark == 'tencentcos')
        {
            $tencentcos = new OssConfig();

            $tencentcos->name = '腾讯云COS';
            $tencentcos->mark = $mark;
            $tencentcos->bucket = $request->tencentcos_bucket;
            // $tencentcos->diqu = $request->tencentcos_diqu;
            $tencentcos->domain = $request->tencentcos_domain;
            $tencentcos->accesskey = $request->tencentcos_accesskey;
            $tencentcos->secretkey = $request->tencentcos_secretkey;
                
            if($request->tencentcos_status == 1)
            {
                $ids = OssConfig::get('id');
                OssConfig::whereIn('id', $ids)->update(['status'=> 0]);
                $tencentcos->status = 1;
            }

            $tencentcos->created_time = time();
            $tencentcos->updated_time = time();

            $tencentcos->save();
        }

        // return '添加成功';
        return ['code' => 1, 'msg' => '添加成功'];

    }

    // 设置是否启用状态
    public function ossSetStatus(Request $request)
    {
        $id = $request->id;

        $ids = OssConfig::get('id');
        OssConfig::whereIn('id', $ids)->update(['status'=> 0]);
        
        $oss = OssConfig::find($id);
        $oss->status = 1;
        $oss->save();

        return redirect('admin/oss_list');
    }

    // 删除oss
    public function ossDel(Request $request)
    {
        $id = $request->id;

        $oss = OssConfig::find($id);
        $oss->delete();

        return ['code' => 1, 'msg' => '删除成功'];
    }

    // 编辑oss，localhost
    public function ossEditLocal(Request $request)
    {
        $id = $request->id;

        $oss = OssConfig::find($id);

        return view('admin/oss_edit_local', array(
            'oss' => $oss,
            'id' => $id
        ));
    }

    // 编辑oss，七牛云
    public function ossEditQiniu(Request $request)
    {
        $id = $request->id;

        $oss = OssConfig::find($id);

        return view('admin/oss_edit_qiniu', array(
            'oss' => $oss,
            'id' => $id
        ));
    }

    // 编辑oss，alioss
    public function ossEditAlioss(Request $request)
    {
        $id = $request->id;

        $oss = OssConfig::find($id);

        return view('admin/oss_edit_alioss', array(
            'oss' => $oss,
            'id' => $id
        ));
    }

    // 编辑oss，tencentcos
    public function ossEditTencentcos(Request $request)
    {
        $id = $request->id;

        $oss = OssConfig::find($id);

        return view('admin/oss_edit_tencentcos', array(
            'oss' => $oss,
            'id' => $id
        ));
    }

    // 保存oos编辑的内容
    public function saveOssEdit(Request $request)
    {
        $id = $request->id;
        $mark = $request->mark;        

        $oss = OssConfig::find($id);

        if($mark == 'localhost')
        {
            $oss->bucket = $request->local_bucket;
            $oss->domain = $request->local_domain;
            if($request->local_status == 1)
            {
                $ids = OssConfig::get('id');
                OssConfig::whereIn('id', $ids)->update(['status'=> 0]);
                $oss->status = 1;
            }
            $oss->save();
        }

        if($mark == 'qiniu')
        {
            $oss->bucket = $request->qiniu_bucket;
            $oss->domain = $request->qiniu_domain;
            $oss->accesskey = $request->qiniu_accesskey;
            $oss->secretkey = $request->qiniu_secretkey;
            if($request->qiniu_status == 1)
            {
                $ids = OssConfig::get('id');
                OssConfig::whereIn('id', $ids)->update(['status'=> 0]);
                $oss->status = 1;
            }
            $oss->save();
        }

        if($mark == 'alioss')
        {
            $oss->bucket = $request->alioss_bucket;
            $oss->domain = $request->alioss_domain;
            $oss->accesskey = $request->alioss_accesskey;
            $oss->secretkey = $request->alioss_secretkey;
            if($request->alioss_status == 1)
            {
                $ids = OssConfig::get('id');
                OssConfig::whereIn('id', $ids)->update(['status'=> 0]);
                $oss->status = 1;
            }
            $oss->save();
        }

        if($mark == 'tencentcos')
        {
            $oss->bucket = $request->tencentcos_bucket;
            // $oss->diqu = $request->diqu;
            $oss->domain = $request->tencentcos_domain;
            $oss->accesskey = $request->tencentcos_accesskey;
            $oss->secretkey = $request->tencentcos_secretkey;
            if($request->tencentcos_status == 1)
            {
                $ids = OssConfig::get('id');
                OssConfig::whereIn('id', $ids)->update(['status'=> 0]);
                $oss->status = 1;
            }
            $oss->save();
        }

        return ['code' => 1, 'msg' => '修改成功'];
    }

}
