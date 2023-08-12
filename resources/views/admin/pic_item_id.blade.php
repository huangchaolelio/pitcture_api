<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统。">
<title>标题- 后台管理</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/materialdesignicons.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/style.min.css')}}">
</head>
  
<body>
<div class="container-fluid">  
        
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      @foreach($pictureItem as $item)
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$loop->index}}" @if($loop->index == 0) class="active" aria-current="true" @endif aria-label="Slide {{$loop->iteration}}"></button>
      @endforeach
    </div>
    <div class="carousel-inner">
      @foreach($pictureItem as $item)
      <div class="carousel-item @if($loop->index == 1) active @endif">
        <img src="{{$item->url}}" class="d-block w-100" alt="...">
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">前</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">后</span>
    </button>
  </div>

</div>
<script type="text/javascript" src="{{asset('lightyearadmin/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/main.min.js')}}"></script>
</body>
</html>