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
<!--tags插件css-->
<link type="text/css" rel="stylesheet" href="{{asset('lightyearadmin/js/jquery-tagsinput/jquery.tagsinput.min.css')}}">
<!--上传插件css-->
<link type="text/css" rel="stylesheet" href="{{asset('lightyearadmin/js/webuploader/webuploader.css')}}">
<!--灯箱效果插件css-->
<link type="text/css" rel="stylesheet" href="{{asset('lightyearadmin/js/magnific-popup/magnific-popup.min.css')}}">
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
        <header class="card-header"><div class="card-title">新增图片分类</div></header>
        <div class="card-body">
          
          <form action="{{url('admin/save_picture_category')}}" method="post" class="row sub_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-3 col-md-12">
              <label for="title" class="form-label">*分类名称</label>
              <input type="text" class="form-control" id="title" name="title" value="" placeholder="输入分类名称" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="sort" class="form-label">显示顺序</label>
              <input type="text" class="form-control" id="orders" name="orders" value="0" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="status" class="form-label">上架状态</label>
              <div class="clearfix">
                <div class="form-check form-check-inline">
      	          <input type="radio" id="isshow" name="isshow" value="1" class="form-check-input" checked>
      	          <label class="form-check-label" for="shangjia">上架</label>
      	        </div>
      	        <div class="form-check form-check-inline">
      	          <input type="radio" id="isshow" name="isshow" value="0" class="form-check-input">
      	          <label class="form-check-label" for="xiajia">下架</label>
      	        </div>
              </div>
            </div>
            <div class="mb-3 col-md-12">
              <button type="submit" class="btn btn-sm btn-primary ajax-post sub_type" target-form="add-form">确 定</button>
              <button type="reset" class="btn btn-sm btn-default">重 置</button>
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
    var $title = $('#title').val();
    if($.trim($title) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '分类名称不能为空',
      });
      return false;
    }else {
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
      });
      return false;
    }
  });
  
</script>
</body>
</html>