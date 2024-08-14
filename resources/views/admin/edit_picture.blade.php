<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统的HTML模板。">
<title>编辑picture - 后台管理</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/materialdesignicons.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/animate.min.css')}}">
<!--对话框插件css-->
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/js/jquery-confirm/jquery-confirm.min.css')}}">
<!-- 上传图片插件css -->
<link rel="stylesheet" type="text/css" href="{{asset('ajaximageupload/css/jquery.upload.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/style.min.css')}}">

</head>

<body>
<div class="container-fluid">

  <div class="row">

    <div class="col-lg-12">
      <div class="card">
        <header class="card-header"><div class="card-title">编辑图辑</div></header>
        <div class="card-body">

          <form action="{{url('admin/save_picture')}}" method="post" class="row add" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" value="{{$picture->id}}" />
            <div class="mb-3 col-md-12">
              <label for="title" class="form-label">*图集名称</label>
              <input type="text" class="form-control" id="title" name="title" value="{{$picture->title}}" placeholder="输入图集名称" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="sort" class="form-label">简介</label>
              <input type="text" class="form-control" id="describe" name="describe" value="{{$picture->describe}}" placeholder="输入简介" />
            </div>
<!--            <div class="mb-3 col-md-12">-->
<!--              <label for="sort" class="form-label">图片分类</label>-->
<!--              <input type="text" class="form-control" id="picCategory" name="picCategory" value="{{$picture->picCategoryId}}" />-->
<!--            </div>-->

            <div class="mb-3 col-md-12">
              <button type="submit" class="btn btn-sm btn-primary ajax-post" target-form="add-form">保 存</button>
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
<!-- 上传图片插件js -->
<script src="{{asset('ajaximageupload/js/jquery.upload.js')}}"></script>
<script>
  $('.add').on('submit', function(event) {
    var $title = $('#title').val();
    var $describe = $('#describe').val();
    // var $picCategory = $('#picCategory').val();
    if($.trim($title) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '图辑不能为空',
      });
      return false;
    } else if($.trim($describe) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '图片描述不能为空',
      });
      return false;
    }  else {
      form.submit();
      return false;
    }
  });

</script>
</body>
</html>
