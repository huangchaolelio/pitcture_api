<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="LightYear,LightYearAdmin,光年,后台模板,后台管理系统,光年HTML模板">
<meta name="description" content="Light Year Admin V5是一个基于Bootstrap v5.1.3的后台管理系统的HTML模板。">
<title>新增文档 - 光年(Light Year Admin V5)后台管理系统模板</title>
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
        <header class="card-header"><div class="card-title">小程序设置</div></header>
        <div class="card-body">
          
          <form action="{{url('admin/wechat_app')}}" method="post" class="row sub_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-3 col-md-12">
              <label for="appid" class="form-label">*AppId</label>
              <input type="text" class="form-control" id="appid" name="appid" value="{{$appid}}" placeholder="请输入AppId" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="secretkey" class="form-label">*AppSecret</label>
              <input type="text" class="form-control" id="appsecret" name="appsecret" value="{{$appsecret}}" placeholder="请输入AppSecret" />
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
    var $appid = $('#appid').val();
    var $appsecret = $('#appsecret').val();
    if($.trim($appid) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'AppId不能为空',
      });
      return false;
    } else if($.trim($appsecret) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'appsecret不能为空',
      });
      return false;
    } else {
      var $data  = $(this).serialize();    
      $.post($(this).attr('action'), $data, function(res) {
        if(1) {        
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
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