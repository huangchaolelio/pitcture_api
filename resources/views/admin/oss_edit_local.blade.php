<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统。">
<title>存储配置 - 后台管理系统</title>
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

        <header class="card-header"><div class="card-title">编辑存储设置</div></header> 
        <div class="card-body">
          
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <button class="nav-link active" id="basic-config" data-bs-toggle="tab" data-bs-target="#local" type="button" >本地服务器</button>
            </li>
          </ul>
          
          <div name="oss-config">
            <div class="tab-content">

              <div class="tab-pane fade show active" id="local" aria-labelledby="basic-localhost">
                <form action="{{url('admin/save_oss_edit')}}" method="post" name="edit-form" class="localhost">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="id" value="{{$id}}" />
                  <input type="hidden" name="mark" value="localhost" />
                  <div class="mb-3 col-md-12">
                    <label for="bucket" class="form-label">*存储目录名称</label>
                    <input type="text" class="form-control" id="local_bucket" name="local_bucket" value="{{$oss->bucket}}" placeholder="输入存储目录名称" />
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="domain" class="form-label">*绑定域名</label>
                    <input type="text" class="form-control" id="local_domain" name="local_domain" value="{{$oss->domain}}" placeholder="输入域名" />
                    <small class="form-text">例如：http://yourdomain.com/</code></small>
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="tag" class="form-label">*Tag</label>
                    <input type="text" class="form-control" id="local_tag" name="local_tag" value="{{$oss->tag}}" placeholder="输入tag" disabled/>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="local_status"
                    @if($oss->status == 1)
                      checked=true
                    @endif
                    >
                    <label class="form-check-label" for="flexCheckDefault">启用</label>
                  </div>
                  <div class="mb-3 col-md-12">
                    <button type="submit" class="btn btn-primary ajax-post" target-form="add-form">保 存</button>
                    <button type="reset" class="btn btn-default">重 置</button>
                  </div>
                  </form>          
              </div>

              </div>
            </div>
          </div>
          
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
  // 存储到本地目录 
  $('.localhost').on('submit', function(event) {
    var $bucket = $('#local_bucket').val();
    var $domain = $('#local_domain').val();
    if($.trim($bucket) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '存储目录名称不能为空',
      });
      return false;
    } else if($.trim($domain) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '绑定域名不能为空',
      });
      return false;
    } else {
      var $data  = $(this).serialize();
      $.post($(this).attr('action'), $data, function(res) {
        if(res.code) {        
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
            content: res.msg,
          });
        }
        window.location.href = "{{url('admin/oss_list')}}";     
      });
      return false;
    } 
  }); 
  
</script>
</body>
</html>