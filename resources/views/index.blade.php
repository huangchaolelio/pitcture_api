<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="搞笑图片，手机壁纸，搞笑，影视，体育，美女，新闻，音乐，美食，宠物，旅游，游戏">
<meta name="description" content="海量高清手机壁纸、苹果安卓壁纸、手机主题，动态壁纸；免费一键去水印，高清无痕。">
<title>爱看图 - 搞笑图片，手机壁纸</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/bootstrap.min.css')}}">
<!--让IE使用最新的渲染模式，支持CSS3-->
<meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1">
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?4e833a8e2d006a1f7cdc1eb60321e467";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<!--如果IE版本低于IE9，使浏览器支持HTML5和CSS3-->
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
    body{
        font-family:"微软雅黑";
        --img-width:264px;
        --img-gap:5px;
    }
    #container>div{
        width:var(--img-width);
        /* margin: 0 0 70px 0; */
        height:100%;
        overflow: auto;
    }
    .thumbnail>a>img{
        width:100%;
    }
    #container{
        column-width:var(--img-width);
        -webkit-column-width:var(--img-width);
        -moz-column-width:var(--img-width);
        -o-column-width:var(--img-width);
        -ms-column-width:var(--img-width);
        column-gap:var(--img-gap);
        -webkit-column-gap:var(--img-gap);
        -moz-column-gap:var(--img-gap);
        -o-column-gap:var(--img-gap);
        -ms-column-gap:var(--img-gap);
    }
</style>
</head>

<body>
    <div class="container-xxl">
        <div class="row justify-content-center text-center" style="padding:20px 0;">
            <img src="{{url('images/miniLogo.jpg')}}" style="width:260px;height:auto;" class="rounded d-block" alt="爱看图">
            <h8><b>扫码访问小程序</b></h8>
        </div>
    </div>

    <div class="container-xxl">
        <div class="row align-items-start justify-content-center">
            <div class="col-md-10 col-md-offset-1" id="container">
                <!--图片开始-->
                @foreach($pictureItems as $pictureItem)
                <div class="col-md-4">
                    <div class="thumbnail">
                        <a href="javascript:void(0);">
                            <img src="{{$pictureItem->url}}" class="img-responsive img-rounded">
                        </a>
                        <div class="caption text-center">
                            <!-- <h8>爱看图</h8> -->
                            <p>
                                <small>{{$pictureItem->picture->title}}</small>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
                <!--图片结束-->
            </div>
        </div>
    </div>

    <div class="container-xxl">
        <div class="row justify-content-center text-center" style="padding:20px 0;">
            <p style="font-size: 12px;">天天爱看网提供技术支持 <a href="https://funpic.fun/" target="_blank">www.funpic.fun</a></p>
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="{{asset('lightyearadmin/js/jquery.min.js')}}"></script>
<script>
    $(".img-responsive.img-rounded").click(function() {
        var modal = $("<div></div>").css({
            "position": "fixed",
            "top": "0",
            "left": "0",
            "width": "100%",
            "height": "100%",
            "background-color": "rgba(0,0,0,0.5)",
            "display": "flex",
            "justify-content": "center",
            "align-items": "center"

        });
        $("body").append(modal);  var modalImg = $("<img>").attr("src", this.src).css({
            "display": "block",
            "margin": "auto",
            "max-width": "60%",
            "max-height": "60%"
        });
        modal.append(modalImg);  modal.click(function() {
            $(this).remove();
        });
    });

</script>
