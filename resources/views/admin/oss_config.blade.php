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

        <header class="card-header"><div class="card-title">添加存储设置</div></header> 
        <div class="card-body">
          
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <button class="nav-link active" id="basic-config" data-bs-toggle="tab" data-bs-target="#local" type="button" >本地服务器</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="basic-sys" data-bs-toggle="tab" data-bs-target="#qiniu" type="button">七牛云存储</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="basic-upload" data-bs-toggle="tab" data-bs-target="#alioss" type="button">阿里云OSS</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="basic-upload" data-bs-toggle="tab" data-bs-target="#tencentcos" type="button">腾讯云COS</button>
            </li>
          </ul>
          
          <div name="oss-config">
            <div class="tab-content">

              <div class="tab-pane fade show active" id="local" aria-labelledby="basic-localhost">
                <form action="{{url('admin/add_oss_config')}}" method="post" name="edit-form" class="localhost">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="mark" value="localhost" />
                  <div class="mb-3 col-md-12">
                    <label for="bucket" class="form-label">*存储目录名称</label>
                    <input type="text" class="form-control" id="local_bucket" name="local_bucket" value="" placeholder="输入存储目录名称" />
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="domain" class="form-label">*绑定域名</label>
                    <input type="text" class="form-control" id="local_domain" name="local_domain" value="" placeholder="输入域名" />
                    <small class="form-text">例如：http://yourdomain.com/</code></small>
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="tag" class="form-label">*Tag</label>
                    <input type="number" class="form-control" id="local_tag" name="local_tag" value="" placeholder="输入大于0的数字"/ step="1"  min="0" onkeyup="this.value= this.value.match(/\d+(\.\d{0,2})?/) ? this.value.match(/\d+(\.\d{0,2})?/)[0] : ''">
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="local_status">
                    <label class="form-check-label" for="flexCheckDefault">启用</label>
                  </div>
                  <div class="mb-3 col-md-12">
                    <button type="submit" class="btn btn-primary ajax-post" target-form="add-form">添 加</button>
                    <button type="reset" class="btn btn-default">重 置</button>
                  </div>
                </form>          
              </div>
            
              <div class="tab-pane fade" id="qiniu" aria-labelledby="basic-qiniu">
                <form action="{{url('admin/add_oss_config')}}" method="post" name="edit-form" class="qiniu">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="mark" value="qiniu" />
                <div class="mb-3 col-md-12">
                  <label for="bucket" class="form-label">*存储空间名称(Bucket)</label>
                  <input type="text" class="form-control" id="qiniu_bucket" name="qiniu_bucket" value="" placeholder="输入存储空间名称" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="domain" class="form-label">*绑定域名</label>
                  <input type="text" class="form-control" id="qiniu_domain" name="qiniu_domain" value="" placeholder="输入域名" />
                  <small class="form-text">例如：http://yourdomain.com/</code></small>
                </div>
                <div class="mb-3 col-md-12">
                  <label for="accesskey" class="form-label">*AccessKey(AK)</label>
                  <input type="text" class="form-control" id="qiniu_accesskey" name="qiniu_accesskey" value="" placeholder="输入AccessKey(AK)" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="secretkey" class="form-label">*SecretKey(SK)</label>
                  <input type="text" class="form-control" id="qiniu_secretkey" name="qiniu_secretkey" value="" placeholder="输入SecretKey(SK)" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="tag" class="form-label">*Tag</label>
                  <input type="number" class="form-control" id="qiniu_tag" name="qiniu_tag" value="" placeholder="输入大于0的数字"/ step="1"  min="0" onkeyup="this.value= this.value.match(/\d+(\.\d{0,2})?/) ? this.value.match(/\d+(\.\d{0,2})?/)[0] : ''">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" name="qiniu_status">
                  <label class="form-check-label" for="flexCheckDefault">启用</label>
                </div>
                <div class="mb-3 col-md-12">
                  <button type="submit" class="btn btn-primary ajax-post" target-form="add-form">添 加</button>
                  <button type="reset" class="btn btn-default">重 置</button>
                </div>
                </form>
              </div>            

              <div class="tab-pane fade" id="alioss" aria-labelledby="basic-ali">
                <form action="{{url('admin/add_oss_config')}}" method="post" name="edit-form" class="alioss">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="mark" value="alioss" />
                <div class="mb-3 col-md-12">
                  <label for="bucket" class="form-label">*存储空间名称(Bucket)</label>
                  <input type="text" class="form-control" id="alioss_bucket" name="alioss_bucket" value="" placeholder="输入存储空间名称" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="domain" class="form-label">*绑定域名</label>
                  <input type="text" class="form-control" id="alioss_domain" name="alioss_domain" value="" placeholder="输入域名" />
                  <small class="form-text">例如：http://yourdomain.com/</code></small>
                </div>
                <div class="mb-3 col-md-12">
                  <label for="accesskey" class="form-label">*AccessKey(AK)</label>
                  <input type="text" class="form-control" id="alioss_accesskey" name="alioss_accesskey" value="" placeholder="输入AccessKey(AK)" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="secretkey" class="form-label">*SecretKey(SK)</label>
                  <input type="text" class="form-control" id="alioss_secretkey" name="alioss_secretkey" value="" placeholder="输入SecretKey(SK)" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="tag" class="form-label">*Tag</label>
                  <input type="number" class="form-control" id="alioss_tag" name="alioss_tag" value="" placeholder="输入大于0的数字"/ step="1"  min="0" onkeyup="this.value= this.value.match(/\d+(\.\d{0,2})?/) ? this.value.match(/\d+(\.\d{0,2})?/)[0] : ''">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" name="alioss_status">
                  <label class="form-check-label" for="flexCheckDefault">启用</label>
                </div>
                <div class="mb-3 col-md-12">
                  <button type="submit" class="btn btn-primary ajax-post" target-form="add-form">添 加</button>
                  <button type="reset" class="btn btn-default">重 置</button>
                </div>
                </form>
              </div>

              <div class="tab-pane fade" id="tencentcos" aria-labelledby="basic-tencent">
                <form action="{{url('admin/add_oss_config')}}" method="post" name="edit-form" class="tencentcos">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="mark" value="tencentcos" />
                <div class="mb-3 col-md-12">
                  <label for="bucket" class="form-label">*存储空间名称(Bucket)</label>
                  <input type="text" class="form-control" id="tencentcos_bucket" name="tencentcos_bucket" value="" placeholder="输入存储空间名称" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="domain" class="form-label">*所属地域</label>
                  <input type="text" class="form-control" id="tencentcos_diqu" name="tencentcos_diqu" value="" placeholder="输入所属地域" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="domain" class="form-label">*绑定域名</label>
                  <input type="text" class="form-control" id="tencentcos_domain" name="tencentcos_domain" value="" placeholder="输入域名" />
                  <small class="form-text">例如：http://yourdomain.com/</code></small>
                </div>
                <div class="mb-3 col-md-12">
                  <label for="accesskey" class="form-label">*AccessKey(AK)</label>
                  <input type="text" class="form-control" id="tencentcos_accesskey" name="tencentcos_accesskey" value="" placeholder="输入AccessKey(AK)" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="secretkey" class="form-label">*SecretKey(SK)</label>
                  <input type="text" class="form-control" id="tencentcos_secretkey" name="tencentcos_secretkey" value="" placeholder="输入SecretKey(SK)" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="tag" class="form-label">*Tag</label>
                  <input type="number" class="form-control" id="tencentcos_tag" name="tencentcos_tag" value="" placeholder="输入大于0的数字"/ step="1"  min="0" onkeyup="this.value= this.value.match(/\d+(\.\d{0,2})?/) ? this.value.match(/\d+(\.\d{0,2})?/)[0] : ''">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" name="tencentcos_status">
                  <label class="form-check-label" for="flexCheckDefault">启用</label>
                </div>
                <div class="mb-3 col-md-12">
                  <button type="submit" class="btn btn-primary ajax-post" target-form="add-form">添 加</button>
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
    var $tag = $('#local_tag').val();
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
    } else if($.trim($tag) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'Tag不能为空',
      });
      return false;
    } else {
      var $data  = $(this).serialize();
      $.post($(this).attr('action'), $data, function(res) {
        if(res.code == 0) {        
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
            content: res.msg,
          });
          return false; 
        } 
        if(res.code == 1) {        
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
            content: res.msg,
          });
          window.location.href = "{{url('admin/oss_list')}}";   
        }          
      });
      return false;
    } 
  });

  //七牛存储 
  $('.qiniu').on('submit', function(event) {
    var $bucket = $('#qiniu_bucket').val();
    var $domain = $('#qiniu_domain').val();
    var $accesskey = $('#qiniu_accesskey').val();
    var $secretkey = $('#qiniu_secretkey').val();
    var $tag = $('#qiniu_tag').val();
    if($.trim($bucket) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '存储空间名称(Bucket)不能为空',
      });
      return false;
    }else if($.trim($domain) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '绑定域名不能为空',
      });
      return false;
    } else if($.trim($accesskey) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'accesskey不能为空',
      });
      return false;
    } else if($.trim($secretkey) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'secretkey不能为空',
      });
      return false;
    } else if($.trim($tag) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'Tag不能为空',
      });
      return false;
    } else {
      var $data  = $(this).serialize();
      $.post($(this).attr('action'), $data, function(res) {
        if(res.code == 0) {        
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
            content: res.msg,
          });
          return false; 
        } 
        if(res.code == 1) {
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
            content: res.msg,
          });
          window.location.href = "{{url('admin/oss_list')}}";   
        }           
      });
      return false;      
    }
  });

  // 阿里云oss 
  $('.alioss').on('submit', function(event) {
    var $bucket = $('#alioss_bucket').val();
    var $domain = $('#alioss_domain').val();
    var $accesskey = $('#alioss_accesskey').val();
    var $secretkey = $('#alioss_secretkey').val();
    var $tag = $('#alioss_tag').val();
    if($.trim($bucket) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '存储空间名称(Bucket)不能为空',
      });
      return false;
    }else if($.trim($domain) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '绑定域名不能为空',
      });
      return false;
    } else if($.trim($accesskey) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'accesskey不能为空',
      });
      return false;
    } else if($.trim($secretkey) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'secretkey不能为空',
      });
      return false;
    } else if($.trim($tag) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'Tag不能为空',
      });
      return false;
    } else {
      var $data  = $(this).serialize();
      $.post($(this).attr('action'), $data, function(res) {
        if(res.code == 0) {        
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
            content: res.msg,
          });
          return false; 
        } 
        if(res.code == 1) {
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

  // 腾讯云COS设置 
  $('.tencentcos').on('submit', function(event) {
    var $bucket = $('#tencentcos_bucket').val();    
    var $diqu = $('#tencentcos_diqu').val();
    var $domain = $('#tencentcos_domain').val();
    var $accesskey = $('#tencentcos_accesskey').val();
    var $secretkey = $('#tencentcos_secretkey').val();
    var $tag = $('#tencentcos_tag').val();
    if($.trim($bucket) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '存储空间名称(Bucket)不能为空',
      });
      return false;
    }else if($.trim($diqu) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '所属区域不能为空',
      });
      return false;
    }else if($.trim($domain) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '绑定域名不能为空',
      });
      return false;
    } else if($.trim($accesskey) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'accesskey不能为空',
      });
      return false;
    } else if($.trim($secretkey) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'secretkey不能为空',
      });
      return false;
    } else if($.trim($tag) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: 'Tag不能为空',
      });
      return false;
    } else {
      var $data  = $(this).serialize();
      $.post($(this).attr('action'), $data, function(res) {
        if(res.code == 0) {        
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
            content: res.msg,
          });
          return false; 
        } 
        if(res.code == 1) {
          $.alert({
            title: '提示',
            icon: 'mdi mdi-alert',
            type: 'orange',
            content: res.msg,
          });
        window.location.href = "{{url('admin/oss_list')}}";  
        }    
      });
      return false;      
    }
  });
  
</script>
</body>
</html>