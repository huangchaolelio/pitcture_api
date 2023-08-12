<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统。">
<title>图片分类列表 - 后台管理</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/materialdesignicons.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/bootstrap.min.css')}}">
<!--对话框插件css-->
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/js/jquery-confirm/jquery-confirm.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/style.min.css')}}">
</head>
  
<body>
<div class="container-fluid">
  
  <div class="row">
    
    <div class="col-lg-12">
      <div class="card">
        <header class="card-header"><div class="card-title">储存管理</div></header>
        <div class="card-body">
          <div class="card-search mb-2-5">
            <form class="search-form" method="get" action="#!" role="form">
              
              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <label class="col-sm-4 col-form-label"><span class="text-danger">*</span> 任务名称</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control pull-left" name="name" value="" placeholder="请输入任务名称" />
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-sm btn-primary me-1">搜索</button>
                  <button type="reset" class="btn btn-sm btn-default">重置</button>
                </div>
              </div>
              
            </form>
          </div>
          <div class="card-btns mb-2-5">
            <a class="btn btn-sm btn-primary me-1" href="{{url('admin/oss_config')}}"><i class="mdi mdi-plus"></i> 新增</a>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="check-all">
                      <label class="form-check-label" for="check-all"></label>
                    </div>
                  </th>
                  <th>编号</th>
                  <th>存储位置</th>
                  <th>标识</th>
                  <th>bucket(目录名)</th>
                  <th>tag(唯一)</th>
                  <th>域名</th>
                  <th>AccessKey</th>
                  <th>SecretKey</th>
                  <th>状态</th>
                  <th>更新时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach($osslists as $osslist)
                <tr>
                  <td>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input ids" name="ids[]" value="1" id="ids-1">
                      <label class="form-check-label" for="ids-1"></label>
                    </div>
                  </td>
                  <td>{{$osslist->id}}</td>
                  <td>{{$osslist->name}}</td>
                  <td>{{$osslist->mark}}</td>
                  <td>{{$osslist->bucket}}</td>
                  <td>{{$osslist->tag}}</td>
                  <td>{{$osslist->domain}}</td>
                  <td>{{$osslist->accesskey}}</td>
                  <td>{{$osslist->secretkey}}</td>
                  <td>
                    <a href="{{url('admin/oss_set_status?id=' . $osslist->id)}}"> 
                      @if($osslist->status == 1)
                        <span class="badge bg-success">使用中</span>
                      @endif
                      @if($osslist->status == 0)
                        <span class="badge bg-secondary">未启用</span>
                      @endif
                    </a>
                  </td>
                  <td>{{date('Y-m-d H:i', $osslist->updated_time)}}</td>
                  <td>
                    <div class="btn-group btn-group-sm">
                      @if($osslist->mark == 'localhost')
                        <a class="btn btn-default" href="{{url('admin/oss_edit_local?id=' . $osslist->id)}}" data-bs-toggle="tooltip" title="编辑"><i class="mdi mdi-pencil"></i></a>
                      @endif
                      @if($osslist->mark == 'qiniu')
                        <a class="btn btn-default" href="{{url('admin/oss_edit_qiniu?id=' . $osslist->id)}}" data-bs-toggle="tooltip" title="编辑"><i class="mdi mdi-pencil"></i></a>
                      @endif
                      @if($osslist->mark == 'alioss')
                        <a class="btn btn-default" href="{{url('admin/oss_edit_alioss?id=' . $osslist->id)}}" data-bs-toggle="tooltip" title="编辑"><i class="mdi mdi-pencil"></i></a>
                      @endif
                      @if($osslist->mark == 'tencentcos')
                        <a class="btn btn-default" href="{{url('admin/oss_edit_tencentcos?id=' . $osslist->id)}}" data-bs-toggle="tooltip" title="编辑"><i class="mdi mdi-pencil"></i></a>
                      @endif
                      <a class="btn btn-default" onclick="confirm_Id({{$osslist->id}})" data-bs-toggle="tooltip" title="删除"><i class="mdi mdi-window-close"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div> 
          {{$osslists->links()}}
          
        </div>
      </div>
    </div>
        
  </div>
  
</div>
<script type="text/javascript" src="{{asset('lightyearadmin/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/bootstrap.min.js')}}"></script>
<!--对话框插件js-->
<script type="text/javascript" src="{{asset('lightyearadmin/js/jquery-confirm/jquery-confirm.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/main.min.js')}}"></script>

<script type="text/javascript">
  function confirm_Id(id) {
    $.confirm({
        title: '是否确认删除',
        content: '删除这条设置记录！！<br/>是否继续。',
        icon: 'mdi mdi-comment-question',
        animation: 'scale',
        closeAnimation: 'scale',
        opacity: 0.5,
        buttons: {
            'confirm': {
                text: '继续',
                btnClass: 'btn-blue',
                action: function() {
                  iddel(id); // 删除指定id的图片
                }
            },
            '取消': function() {                          
            },
        }
    });

    // 删除指定id
    function iddel(id){
      $.ajax({
        url: "{{url('admin/oss_del')}}",
        type: 'post',
        dataType: 'json',
        data: {
          'id': id,
          '_token': '{{csrf_token()}}'
        },             
        success: function(res){
          // alert(res.msg);
          location.reload();
        },
        error: function(e) {
          alert(JSON.stringify(e)); 
        }
      });
    }
  }
</script>
</body>
</html>