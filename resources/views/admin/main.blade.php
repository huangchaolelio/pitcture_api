<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统的HTML模板。">
<title>首页 - 后台管理</title>
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

  <div class="row">

    <div class="col-md-6 col-xl-3" style="width:20%;">
      <div class="card bg-primary text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <span class="avatar-md rounded-circle bg-white bg-opacity-25 avatar-box">
              <i class="mdi mdi-currency-cny fs-4"></i>
            </span>
            <span class="fs-4">0</span>
          </div>
          <div class="text-end">今日收入</div>
        </div>
      </div>
    </div>

  	<div class="col-md-6 col-xl-3" style="width:20%;">
  	  <div class="card bg-danger text-white">
  	    <div class="card-body">
  	      <div class="d-flex justify-content-between">
  	        <span class="avatar-md rounded-circle bg-white bg-opacity-25 avatar-box">
              <i class="mdi mdi-account fs-4"></i>
            </span>
  	        <span class="fs-4">{{$userCount}}</span>
  	      </div>
  	      <div class="text-end">用户总数</div>
  	    </div>
  	  </div>
  	</div>

  	<div class="col-md-6 col-xl-3" style="width:20%;">
  	  <div class="card bg-success text-white">
  	    <div class="card-body">
  	      <div class="d-flex justify-content-between">
  	        <span class="avatar-md rounded-circle bg-white bg-opacity-25 avatar-box">
              <i class="mdi mdi-arrow-down-bold fs-4"></i>
            </span>
  	        <span class="fs-4">{{$downloads}}</span>
  	      </div>
  	      <div class="text-end">下载总量</div>
  	    </div>
  	  </div>
  	</div>

    <div class="col-md-6 col-xl-3" style="width:20%;">
      <div class="card bg-info text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <span class="avatar-md rounded-circle bg-white bg-opacity-25 avatar-box">
              <i class="mdi mdi-file-multiple fs-4"></i>
            </span>
            <span class="fs-4">{{$pictureCount}}</span>
          </div>
          <div class="text-end">图辑数量</div>
        </div>
      </div>
    </div>

  	<div class="col-md-6 col-xl-3" style="width:20%;">
  	  <div class="card bg-purple text-white">
  	    <div class="card-body">
  	      <div class="d-flex justify-content-between">
  	        <span class="avatar-md rounded-circle bg-white bg-opacity-25 avatar-box">
              <i class="mdi mdi-panorama-outline fs-4"></i>
            </span>
  	        <span class="fs-4">{{$pictureItemsCount}}</span>
  	      </div>
  	      <div class="text-end">图片数量</div>
  	    </div>
  	  </div>
  	</div>

  </div>

  <div class="row">

  	<div class="col-md-6">
  	  <div class="card">
  	    <div class="card-header">
  	      <div class="card-title">每周用户</div>
  	    </div>
  	    <div class="card-body">
  	      <canvas class="js-chartjs-bars"></canvas>
  	    </div>
  	  </div>
  	</div>

  	<div class="col-md-6">
  	  <div class="card">
  	    <div class="card-header">
          <div class="card-title">交易历史记录</div>
  	    </div>
  	    <div class="card-body">
  	      <canvas class="js-chartjs-lines"></canvas>
  	    </div>
  	  </div>
  	</div>

  </div>

  <div class="row">

  	<div class="col-lg-12">
  	  <div class="card">
  	    <header class="card-header">
  	      <div class="card-title">系统信息</div>
  	    </header>
    		<div class="card-body">
    		  <div class="table-responsive">
    		    <table class="table table-bordered table-hover" style="table-layout:fixed;word-break:break-all;">
      			  <tbody>
      			    <tr>
      			      <td width="180px">服务器IP地址：</td>
                  <td>{{$server_addr}}</td>
      			      <td width="180px">服务器域名：</td>
                  <td>{{$server_name}}</td>
      			    </tr>
                <tr>
                  <td>服务器端口：</td>
                  <td>{{$server_port}}</td>
                  <td>服务器版本：</td>
                  <td>{{$server_version}}</td>
                </tr>
                <tr>
                  <td>服务器操作系统：</td>
                  <td>{{$system}}</td>
                  <td>PHP版本：</td>
                  <td>{{$php_version}}</td>
                </tr>
                <tr>
                  <td>获取PHP安装路径：</td>
                  <td>{{$default_include_path}}</td>
                  <td>获取Zend版本：</td>
                  <td>{{$zend_version}}</td>
                </tr>
                <tr>
                  <td>Laravel版本：</td>
                  <td>{{$laravel_version}}</td>
                  <td>PHP运行方式：</td>
                  <td>{{$php_sapi_name}}</td>
                </tr>
                <tr>
                  <td>服务器当前时间：</td>
                  <td>{{$now_time}}</td>
                  <td>最大上传限制：</td>
                  <td>{{$upload_max_filesize}}</td>
                </tr>
                <tr>
                  <td>最大执行时间：</td>
                  <td>{{$max_execution_time}}</td>
                  <td>脚本运行占用最大内存：</td>
                  <td>{{$memory_limit}}</td>
                </tr>
                <tr>
                  <td>服务器解译引擎：</td>
                  <td>{{$server_software}}</td>
                  <td>服务器系统目录：</td>
                  <td>{{$systemroot}}</td>
                </tr>
                <tr>
                  <td>通信协议的名称和版本：</td>
                  <td>{{$server_protcol}}</td>
                  <td>服务器语言：</td>
                  <td>{{$http_accept_language}}</td>
                </tr>
      			  </tbody>
            </table>
    	     </div>
  	    </div>
  	  </div>
    </div>

  </div>

</div>

<script type="text/javascript" src="{{asset('lightyearadmin/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/chart.min.js')}}"></script>
<!--引入chart插件js-->
<script type="text/javascript" src="{{asset('lightyearadmin/js/main.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	var $dashChartBarsCnt = jQuery('.js-chartjs-bars')[0].getContext('2d'),
		$dashChartLinesCnt = jQuery('.js-chartjs-lines')[0].getContext('2d');

	var $dashChartBarsData = {
		labels: ['周一', '周二', '周三', '周四', '周五', '周六', '周日'],
		datasets: [{
			label: '注册用户',
			borderWidth: 1,
			borderColor: 'rgba(0, 0, 0, 0)',
			backgroundColor: 'rgba(0, 123, 255,0.5)',
			hoverBackgroundColor: "rgba(0, 123, 255, 0.7)",
			hoverBorderColor: "rgba(0, 0, 0, 0)",
			data: [2500, 1500, 1200, 3200, 4800, 3500, 1500]
		}]
	};
	var $dashChartLinesData = {
		labels: ['2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013',
			'2014'
		],
		datasets: [{
			label: '交易资金',
			data: [20, 25, 40, 30, 45, 40, 55, 40, 48, 40, 42, 50],
			borderColor: '#007bff',
			backgroundColor: 'rgba(0, 123, 255, 0.175)',
			borderWidth: 1,
			fill: false,
			lineTension: 0.5
		}]
	};

	new Chart($dashChartBarsCnt, {
		type: 'bar',
		data: $dashChartBarsData
	});

	var myLineChart = new Chart($dashChartLinesCnt, {
		type: 'line',
		data: $dashChartLinesData,
	});
});
</script>
</body>
</html>