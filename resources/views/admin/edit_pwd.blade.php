<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="一个基于Bootstrap v5.1.3的后台管理系统的HTML模板。">
<title>修改密码 - 后台管理</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/materialdesignicons.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/animate.min.css')}}">
<!--对话框插件css-->
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/js/jquery-confirm/jquery-confirm.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/style.min.css')}}">
</head>
  
<body>
<div class="container-fluid">
  
  <div class="row">
    
    <div class="col-lg-12">
      <div class="card">
        <header class="card-header"><div class="card-title">修改密码</div></header>
        <div class="card-body">
          
          <form action="{{url('admin/edit_pwd')}}" method="post" class="row sub_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-3 col-md-12">
              <label for="appid" class="form-label">*旧密码</label>
              <input type="password" class="form-control" id="oldpwd" name="oldpwd" value="" placeholder="请输入旧密码" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="secretkey" class="form-label">*新密码</label>
              <input type="text" class="form-control" id="newpwd" name="newpwd" value="" placeholder="请输入新密码" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="secretkey" class="form-label">*密码确认</label>
              <input type="password" class="form-control" id="isnewpwd" name="isnewpwd" value="" placeholder="再次输入新密码" />
            </div>
            <div class="mb-3 col-md-12">
              <button type="submit" class="btn btn-primary ajax-post" target-form="add-form">确 定</button>
              <button type="reset" class="btn btn-default">重 置</button>
            </div>
          </form>
          
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

<script type="text/javascript">

  $('.sub_form').on('submit', function(event) {
    var $oldpwd = $('#oldpwd').val();
    var $newpwd = $('#newpwd').val();
    var $isnewpwd = $('#isnewpwd').val();
    if($.trim($oldpwd) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '旧密码不能为空',
      });
      return false;
    } else if($.trim($newpwd) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '新密码不能为空',
      });
      return false;
    } else if($.trim($isnewpwd) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '确认密码不能为空',
      });
      return false;
    } else if($newpwd != $isnewpwd) {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '两次输入密码不一样，请确认。',
      });
      return false;
    } else {
      var $data  = $(this).serialize();    
      $.post($(this).attr('action'), $data, function(res) {
        if(res.code == 1) {        
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
            // 密码修改成功
            content: res.msg,
          });
        }
        if(res.code == 0) {        
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
            // 输入的旧密码错误
            content: res.msg,
          });
        }     
      });
      return false;
    }
  });

</script>
</body>
</html>