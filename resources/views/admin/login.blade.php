<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统的HTML模板。">
<meta name="author" content="yinq">
<title>登录 - 后台管理</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/materialdesignicons.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/style.min.css')}}">
<style>
.signin-form .has-feedback {
    position: relative;
}
.signin-form .has-feedback .form-control {
    padding-left: 36px;
}
.signin-form .has-feedback .mdi {
    position: absolute;
    top: 0;
    left: 0;
    right: auto;
    width: 36px;
    height: 36px;
    line-height: 36px;
    z-index: 4;
    color: #dcdcdc;
    display: block;
    text-align: center;
    pointer-events: none;
}
.signin-form .has-feedback.row .mdi {
    left: 15px;
}
</style>
</head>

<body class="center-vh" style="background-image: url({{url('lightyearadmin/images/login-bg-1.jpg')}}); background-size: cover;">
<div class="card card-shadowed p-5 mb-0 mr-2 ml-2">
  <div class="text-center mb-3">
    <h4>后台管理</h4>
  </div>

  <form action="{{url('admin/login')}}" method="post" class="signin-form needs-validation" novalidate>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="mb-3 has-feedback">
      <span class="mdi mdi-account" aria-hidden="true"></span>
      <input type="text" class="form-control" id="username" name="username" placeholder="用户名" required>
    </div>

    <div class="mb-3 has-feedback">
      <span class="mdi mdi-lock" aria-hidden="true"></span>
      <input type="password" class="form-control" id="password" name="password" placeholder="密码" required>
    </div>

    <div class="mb-3 has-feedback row">
      <div class="col-7">
        <span class="mdi mdi-check-all form-control-feedback" aria-hidden="true"></span>
        <input type="text" id="captcha_code" name="captcha_code" class="form-control" placeholder="验证码" required>
      </div>
      <div class="col-5 text-right">
        <img src="{{ captcha_src('flat') }}" id="captcha" name="captcha" class="pull-right" style="cursor: pointer;" title="点击图片重新获取验证码" alt="captcha">
      </div>
    </div>

    <div class="mb-3 d-grid">
      <button class="btn btn-primary" type="submit">立即登录</button>
    </div>
  </form>

  <p class="text-center text-muted mb-0">Copyright © 2024 <a target="_blank" href="https://funpic.fun/">爱看网</a>. All right reserved</p>
</div>

<script type="text/javascript" src="{{asset('lightyearadmin/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/main.min.js')}}"></script>

<script type="text/javascript" src="{{asset('lightyearadmin/js/lyear-loading.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/bootstrap-notify.min.js')}}"></script>
<script type="text/javascript">
    // 验证码刷新
    $('#captcha').click(function(){
        $(this).prop('src',"{{captcha_src('flat')}}" + Math.random(1000,9999));
    })

    var loader;
    $(document).ajaxStart(function(){
        $("button:submit").html('登录中...').attr("disabled", true);
        loader = $('button:submit').lyearloading({
            opacity: 0.2,
            spinnerSize: 'nm'
        });
    }).ajaxStop(function(){
        loader.destroy();
        $("button:submit").html('立即登录').attr("disabled", false);
    });

    $('.signin-form').on('submit', function(event) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            $(this).addClass('was-validated');
            return false;
        }

        var $data  = $(this).serialize();

        $.post($(this).attr('action'), $data, function(res) {
            if (res.code) {
            // 这里没有后端地址，就直接假设成功
                $.notify({
    	            message: '登录成功，页面即将跳转~',
    	        },{
    	            type: 'success',
    	            placement: {
    	            	from: 'top',
    	            	align: 'right'
    	            },
    	            z_index: 10800,
    	            delay: 1500,
                    animate: {
                        enter: 'animate__animated animate__fadeInUp',
                        exit: 'animate__animated animate__fadeOutDown'
                    }
    	        });
                setTimeout(function () {
                    location.href = '{{url('admin/index')}}';
                }, 1500);
            } else {
                $.notify({
    	            message: '登录失败，错误原因：' + res.msg,
    	        },{
    	            type: 'danger',
    	            placement: {
    	            	from: 'top',
    	            	align: 'right'
    	            },
    	            z_index: 10800,
    	            delay: 1500,
                    animate: {
                        enter: 'animate__animated animate__shakeX',
                        exit: 'animate__animated animate__fadeOutDown'
                    }
    	        });
    			$('#password').val('');
                $("#captcha").click();
            }
        }).fail(function () {
            $.notify({
    	        message: '服务器错误',
    	    },{
    	        type: 'danger',
    	        placement: {
    	        	from: 'top',
    	        	align: 'right'
    	        },
    	        z_index: 10800,
    	        delay: 1500,
                animate: {
                    enter: 'animate__animated animate__shakeX',
                    exit: 'animate__animated animate__fadeOutDown'
                }
    	    });
        });

        return false;
    });
</script>
</body>
</html>
