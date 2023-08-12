<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="LightYear,LightYearAdmin,光年,后台模板,后台管理系统,光年HTML模板">
<meta name="description" content="Light Year Admin V5是一个基于Bootstrap v5.1.3的后台管理系统的HTML模板。">
<title>编辑banner - 后台管理系统</title>
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
        <header class="card-header"><div class="card-title">编辑轮播图</div></header>
        <div class="card-body">
          
          <form action="{{url('admin/save_edit_banner')}}" method="post" class="row add" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" value="{{$banner->id}}" />
            <div class="mb-3 col-md-12">
              <label for="title" class="form-label">*主标题</label>
              <input type="text" class="form-control" id="first_title" name="first_title" value="{{$banner->first_title}}" placeholder="输入主标题" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="sort" class="form-label">副标题</label>
              <input type="text" class="form-control" id="second_title" name="second_title" value="{{$banner->second_title}}" placeholder="输入副标题" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="sort" class="form-label">跳转地址</label>
              <input type="text" class="form-control" id="url" name="url" value="{{$banner->url}}" placeholder="输入跳转地址" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="sort" class="form-label">显示顺序</label>
              <input type="text" class="form-control" id="orders" name="orders" value="{{$banner->orders}}" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="status" class="form-label">上架状态</label>
              <div class="clearfix">
                <div class="form-check form-check-inline">
      	          <input type="radio" id="is_show" name="is_show" value="1" class="form-check-input" @if($banner->is_show == 1) checked @endif>
      	          <label class="form-check-label" for="shangjia">上架</label>
      	        </div>
      	        <div class="form-check form-check-inline">
      	          <input type="radio" id="is_show" name="is_show" value="0" class="form-check-input" @if($banner->is_show == 0) checked @endif>
      	          <label class="form-check-label" for="xiajia">下架</label>
      	        </div>
              </div>
            </div>
            <div class="mb-3 col-md-12">
              <div class="upload-box clear">
                <p class="upload-tip">最多上传1张图片，每个图片不能超过1M.</p>
                <div class="image-box"></div>
              </div>
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
    var $first_title = $('#first_title').val();
    var $second_title = $('#second_title').val();
    var $url = $('#url').val();
    var $orders = $('#orders').val();
    var fileInput = $('.ggy-upload-input').get(0).files[0];
    if($.trim($first_title) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '主标题不能为空',
      });
      return false;
    } else if($.trim($second_title) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '副标题不能为空',
      });
      return false;
    } else if($.trim($url) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '跳转地址不能为空',
      });
      return false;
    } else if($.trim($orders) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '显示顺序不能为空',
      });
      return false;
    } else if(!fileInput) {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '上传图片不能为空',
      });
      return false;
    } else {
      form.submit();
      return false;
    } 
  });

  // 选择图片
  $(".image-box").ajaxImageUpload({
      fileInput : 'imagefile', //上传按钮名，即input[type=file]的name值
      postUrl : '{{url("admin/post_banner")}}', //post上传的服务器地址
      auto: false,
      uploadButton: false,
      width : 300,
      height : 160,
      imageUrl: ['{{url($banner->image)}}'], //已上传的图片连接
      postData : { _token:'{{csrf_token()}}'}, //额外携带的json数据
      maxNum: 1, //允许上传图片数量
      allowZoom : true, //是否允许放大
      allowType : ['gif', 'jpeg', 'jpg', 'bmp', 'png'], //允许上传图片的类型
      maxSize : 1, //允许上传图片的最大尺寸，单位M
      appendMethod : 'after', //图片追加方式，before/after        
      error : function (e) {
          alert(e.msg + '(' + e.code + ')'); //上传失败回调函数
      }
  });
</script>
</body>
</html>