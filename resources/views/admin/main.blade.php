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

    <div class="col-md-6 col-xl-3">
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

  	<div class="col-md-6 col-xl-3">
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

  	<div class="col-md-6 col-xl-3">
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

  	<div class="col-md-6 col-xl-3">
  	  <div class="card bg-purple text-white">
  	    <div class="card-body">
  	      <div class="d-flex justify-content-between">
  	        <span class="avatar-md rounded-circle bg-white bg-opacity-25 avatar-box">
              <i class="mdi mdi-file-multiple fs-4"></i>
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
  	      <div class="card-title">项目信息</div>
  	    </header>
  		<div class="card-body">
  		  <div class="table-responsive">
  		    <table class="table table-hover">
  		      <thead>
  		        <tr>
  		          <th>#</th>
  		          <th>项目名称</th>
  		          <th>开始日期</th>
  		          <th>截止日期</th>
  		          <th>状态</th>
  		          <th>进度</th>
  		        </tr>
  		      </thead>
  			  <tbody>
  			    <tr>
  			      <td>1</td>
  			      <td>设计新主题</td>
  			      <td>10/02/2019</td>
  			      <td>12/05/2019</td>
  			      <td><span class="badge bg-warning">待定</span></td>
  			      <td>
  			        <div class="progress progress-xs">
  			          <div class="progress-bar progress-bar-striped bg-warning" style="width: 45%;"></div>
  			        </div>
  			      </td>
  			    </tr>
  			    <tr>
  			      <td>2</td>
  			      <td>网站重新设计</td>
  			      <td>01/03/2019</td>
  			      <td>12/04/2019</td>
  			      <td><span class="badge bg-success">进行中</span></td>
  			      <td>
  			        <div class="progress progress-xs">
  			          <div class="progress-bar progress-bar-striped bg-success" style="width: 30%;"></div>
  			        </div>
  			      </td>
  			    </tr>
  			    <tr>
  			      <td>3</td>
  			      <td>模型设计</td>
  			      <td>10/10/2019</td>
  			      <td>12/11/2019</td>
  			      <td><span class="badge bg-warning">待定</span></td>
  			      <td>
  			        <div class="progress progress-xs">
  			          <div class="progress-bar progress-bar-striped bg-warning" style="width: 25%;"></div>
  			        </div>
  			      </td>
  			    </tr>
  			    <tr>
  			      <td>4</td>
  			      <td>后台管理系统模板设计</td>
  			      <td>25/01/2019</td>
  			      <td>09/05/2019</td>
  			      <td><span class="badge bg-success">进行中</span></td>
  			      <td>
  			        <div class="progress progress-xs">
  			          <div class="progress-bar progress-bar-striped bg-success" style="width: 55%;"></div>
  			        </div>
  			      </td>
  			    </tr>
  			    <tr>
  			      <td>5</td>
  			      <td>前端设计</td>
  			      <td>10/10/2019</td>
  			      <td>12/12/2019</td>
  			      <td><span class="badge bg-danger">未开始</span></td>
  			      <td>
  			        <div class="progress progress-xs">
  			          <div class="progress-bar progress-bar-striped bg-danger" style="width: 0%;"></div>
  			        </div>
  			      </td>
  			    </tr>
  			    <tr>
  			      <td>6</td>
  			      <td>桌面软件测试</td>
  			      <td>10/01/2019</td>
  			      <td>29/03/2019</td>
  			      <td><span class="badge bg-success">进行中</span></td>
  			      <td>
  			        <div class="progress progress-xs">
  			          <div class="progress-bar progress-bar-striped bg-success" style="width: 75%;"></div>
  			        </div>
  			      </td>
  			    </tr>
  			    <tr>
  			      <td>7</td>
  			      <td>APP改版开发</td>
  			      <td>25/02/2019</td>
  			      <td>12/05/2019</td>
  			      <td><span class="badge bg-danger">暂停</span></td>
  			      <td>
  			        <div class="progress progress-xs">
  			          <div class="progress-bar progress-bar-striped bg-danger" style="width: 15%;"></div>
  			        </div>
  			      </td>
  			    </tr>
  			    <tr>
  			      <td>8</td>
  			      <td>Logo设计</td>
  			      <td>10/02/2019</td>
  			      <td>01/03/2019</td>
  			      <td><span class="badge bg-warning">完成</span></td>
  			      <td>
  			        <div class="progress progress-xs">
  			          <div class="progress-bar progress-bar-striped bg-success" style="width: 100%;"></div>
  			        </div>
  			      </td>
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