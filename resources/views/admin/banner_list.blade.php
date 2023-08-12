<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统。">
<title>图片分类列表 - 后台管理</title>
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
        <header class="card-header"><div class="card-title">轮播图管理</div></header>
        <div class="card-body">
          <div class="card-search mb-2-5">
            <form class="search-form" method="get" action="#!" role="form">
              
              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <label class="col-sm-4 col-form-label"><span class="text-danger">*</span> 任务名称</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control pull-left" name="name" value="" placeholder="请输入任务名称" />
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-sm btn-primary me-1">搜索</button>
                  <button type="reset" class="btn btn-sm btn-default">重置</button>
                </div>
              </div>              
            </form>
          </div>
          <form id="bannerlist" method="post" action="">
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
            <div class="card-btns mb-2-5">
              <a class="btn btn-sm btn-primary me-1" href="{{url('admin/add_banner')}}"><i class="mdi mdi-plus"></i> 新增</a>
              <a class="btn btn-sm btn-success me-1" onclick="qiyong();"><i class="mdi mdi-check"></i> 启用</a>
              <a class="btn btn-sm btn-warning me-1" onclick="jinyong();"><i class="mdi mdi-block-helper"></i> 禁用</a>
              <a class="btn btn-sm btn-danger" onclick="confirm_Ids();"><i class="mdi mdi-window-close"></i> 删除</a>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check-all">
                        <label class="form-check-label" for="check-all"></label>
                      </div>
                    </th>
                    <th>编号</th>
                    <th>主标题</th>
                    <th>副标题</th>
                    <th>图片</th>
                    <th>跳转地址</th>
                    <th>显示顺序</th>
                    <th>状态</th>
                    <th>更新时间</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($banners as $banner)
                  <tr>
                    <td>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input ids" name="ids[]" value="{{$banner->id}}" id="ids-1">
                        <label class="form-check-label" for="ids-1"></label>
                      </div>
                    </td>
                    <td>{{$banner->id}}</td>
                    <td>{{$banner->first_title}}</td>
                    <td>{{$banner->second_title}}</td>
                    <td><img src="{{url($banner->image)}}" style="width:200px; height:50px;"></td>
                    <td>{{$banner->url}}</td>
                    <td>{{$banner->orders}}</td>
                    <td>
                      <a href="{{url('admin/banner_status?id=' . $banner->id)}}"> 
                        @if($banner->is_show == 1)
                          <span class="badge bg-success">展示</span>
                        @endif
                        @if($banner->is_show == 0)
                          <span class="badge bg-secondary">不展示</span>
                        @endif
                      </a>
                    </td>
                    <td>{{date('Y-m-d H:i', $banner->updated_time)}}</td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a class="btn btn-default" href="{{url('admin/edit_banner?id=' . $banner->id)}}" data-bs-toggle="tooltip" title="编辑"><i class="mdi mdi-pencil"></i></a>
                        <a class="btn btn-default" data-bs-toggle="tooltip" title="删除" onclick="confirm_Id([{{$banner->id}}])"><i class="mdi mdi-window-close"></i></a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </form>
          {{$banners->links()}}
          
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
  function qiyong(){
    $isbool = $("input[id='ids-1']").is(":checked");
    if(!$isbool) {
      $.alert('请选中要操作的记录');
      return;
    }

    let formdata = $('#bannerlist').serialize();
    $.ajax({
      url: "{{url('admin/banner_show_ids')}}",
      type: 'post',
      dataType: 'json',
      data: formdata,
      // headers: { 
      //     "Authorization":"Bearer " + $("#_token").val(),
      //     'Content-Type': 'application/x-www-form-urlencoded'
      // },                
      success: function(res){
        // alert(res.msg);
        location.reload();
      },
      error: function(e) {
        alert(JSON.stringify(e)); 
      }
    });
  }

  function jinyong(){
    $isbool = $("input[id='ids-1']").is(":checked");
    if(!$isbool) {
      $.alert('请选中要操作的记录');
      return;
    }

    let formdata = $('#bannerlist').serialize();
    $.ajax({
      url: "{{url('admin/banner_hiden_ids')}}",
      type: 'post',
      dataType: 'json',
      data: formdata,
      // headers: { 
      //     "Authorization":"Bearer " + $("#_token").val(),
      //     'Content-Type': 'application/x-www-form-urlencoded'
      // },                
      success: function(res){
        // alert(res.msg);
        location.reload();
      },
      error: function(e) {
        alert(JSON.stringify(e)); 
      }
    });
  }

  // 批量删除图片
  function idsdel(){
    let formdata = $('#bannerlist').serialize();
    $.ajax({
      url: "{{url('admin/banner_del_ids')}}",
      type: 'post',
      dataType: 'json',
      data: formdata,
      // headers: { 
      //     "Authorization":"Bearer " + $("#_token").val(),
      //     'Content-Type': 'application/x-www-form-urlencoded'
      // },                
      success: function(res){
        // alert(res.msg);
        location.reload();
      },
      error: function(e) {
        alert(JSON.stringify(e)); 
      }
    });
  }

  // 删除指定id的图片
  function iddel(id){
    $.ajax({
      url: "{{url('admin/banner_del_ids')}}",
      type: 'post',
      dataType: 'json',
      data: {
        'ids': id,
        '_token': '{{csrf_token()}}'
      },             
      success: function(res){
        // alert(res.msg);
        location.reload();
      },
      error: function(e) {
        alert(JSON.stringify(e)); 
      }
    });
  }

  function confirm_Id(id) {
    $.confirm({
        title: '是否确认删除',
        content: '删除记录，并删除记录下的图片！！<br/>是否继续。',
        icon: 'mdi mdi-comment-question',
        animation: 'scale',
        closeAnimation: 'scale',
        opacity: 0.5,
        buttons: {
            'confirm': {
                text: '继续',
                btnClass: 'btn-blue',
                action: function() {
                  iddel(id); // 删除指定id的图辑
                }
            },
            '取消': function() {                          
            },
        }
    });
  }

  function confirm_Ids() {
    $isbool = $("input[id='ids-1']").is(":checked");
    if(!$isbool) {
      $.alert('请选中要操作的记录');
      return;
    }
    
    $.confirm({
        title: '是否确认删除',
        content: '删除记录，并删除记录下的图片！！<br/>是否继续。',
        icon: 'mdi mdi-comment-question',
        animation: 'scale',
        closeAnimation: 'scale',
        opacity: 0.5,
        buttons: {
            'confirm': {
                text: '继续',
                btnClass: 'btn-blue',
                action: function() {
                  idsdel(); // 批量删除图辑
                }
            },
            '取消': function() {                          
            },
        }
    });
  }
</script>
</body>
</html>