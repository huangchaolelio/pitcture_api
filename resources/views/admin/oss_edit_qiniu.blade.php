<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统的HTML模板。">
<title>存储配置 - 后台管理</title>
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
              <button class="nav-link active" id="basic-sys" data-bs-toggle="tab" data-bs-target="#qiniu" type="button">七牛云存储</button>
            </li>
          </ul>
          
          <div name="oss-config">
            <div class="tab-content">              
            
              <div class="tab-pane fade show active" id="qiniu" aria-labelledby="basic-qiniu">
                <form action="{{url('admin/save_oss_edit')}}" method="post" name="edit-form" class="qiniu">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{$id}}" />
                <input type="hidden" name="mark" value="qiniu" />
                <div class="mb-3 col-md-12">
                  <label for="bucket" class="form-label">*存储空间名称(Bucket)</label>
                  <input type="text" class="form-control" id="qiniu_bucket" name="qiniu_bucket" value="{{$oss->bucket}}" placeholder="输入存储空间名称" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="domain" class="form-label">*绑定域名</label>
                  <input type="text" class="form-control" id="qiniu_domain" name="qiniu_domain" value="{{$oss->domain}}" placeholder="输入域名" />
                  <small class="form-text">例如：http://yourdomain.com/</code></small>
                </div>
                <div class="mb-3 col-md-12">
                  <label for="accesskey" class="form-label">*AccessKey(AK)</label>
                  <input type="text" class="form-control" id="qiniu_accesskey" name="qiniu_accesskey" value="{{$oss->accesskey}}" placeholder="输入AccessKey(AK)" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="secretkey" class="form-label">*SecretKey(SK)</label>
                  <input type="text" class="form-control" id="qiniu_secretkey" name="qiniu_secretkey" value="{{$oss->secretkey}}" placeholder="输入SecretKey(SK)" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="tag" class="form-label">*Tag</label>
                  <input type="text" class="form-control" id="qiniu_tag" name="qiniu_tag" value="{{$oss->tag}}" placeholder="输入tag" disabled/>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" name="qiniu_status"
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
  //七牛存储 
  $('.qiniu').on('submit', function(event) {
    var $bucket = $('#qiniu_bucket').val();
    var $domain = $('#qiniu_domain').val();
    var $accesskey = $('#qiniu_accesskey').val();
    var $secretkey = $('#qiniu_secretkey').val();
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