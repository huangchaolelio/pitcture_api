<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统的HTML模板。">
<title>编辑图片pictureItem - 后台管理</title>
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

          <form action="{{url('admin/save_picture_item')}}" method="post" class="row add" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" value="{{$picture_item->id}}" />
            <div class="mb-3 col-md-12">
              <label for="title" class="form-label">*图辑id</label>
              <input type="text" class="form-control" id="picture_id" name="picture_id" value="{{$picture_item->picture_id}}" placeholder="输入图辑id" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="sort" class="form-label">*url</label>
                <div><span><img src="{{$picture_item->url}}" style="width: 100px;"></span></div>
              <input type="text" class="form-control" id="url" name="url" value="{{$picture_item->url}}" placeholder="输入url" />
            </div>

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
    var $picture_id = $('#picture_id').val();
    var $url = $('#url').val();
    // var $picCategory = $('#picCategory').val();
    if($.trim($picture_id) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '图辑picture_id不能为空',
      });
      return false;
    } else if($.trim($url) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '图片url不能为空',
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
