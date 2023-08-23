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
        <header class="card-header"><div class="card-title">图片分类列表</div></header>
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
          <form id="category" method="post" action="">
          <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
          <div class="card-btns mb-2-5">
            <a class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#myModal" onclick="addInfo();"><i class="mdi mdi-plus"></i> 新增</a>
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
                  <th>分类名称</th>
                  <th>显示顺序</th>
                  <th>上架状态</th>
                  <th>创建时间</th>
                  <th>更新时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pictures as $picture)
                <tr>
                  <td>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input ids" name="ids[]" value="{{$picture->id}}" id="ids-1">
                      <label class="form-check-label" for="ids-1"></label>
                    </div>
                  </td>
                  <td>{{$picture->id}}</td>
                  <td>{{$picture->title}}</td>
                  <td>{{$picture->orders}}</td>
                  <td>
                    <a href="{{url('admin/picture_category_show?id=' . $picture->id)}}"> 
                      @if($picture->is_show == 1)
                        <span class="badge bg-success">上架</span>
                      @endif
                      @if($picture->is_show == 0)
                        <span class="badge bg-secondary">待审核</span>
                      @endif
                    </a>
                  </td>
                  <td>{{date('Y-m-d H:i', $picture->created_time)}}</td>
                  <td>{{date('Y-m-d H:i', $picture->updated_time)}}</td>
                  <td>
                    <div class="btn-group btn-group-sm">
                      <a class="btn btn-default" href="#!" data-bs-toggle="modal" data-bs-target="#myModal" title="编辑" onclick="editInfo({{$loop->iteration}});"><i class="mdi mdi-pencil"></i></a>
                      <a class="btn btn-default" data-bs-toggle="tooltip" title="删除" onclick="confirm_Id([{{$picture->id}}]);"><i class="mdi mdi-window-close"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </form>
          {{$pictures->links()}}
          
        </div>
      </div>
    </div>
        
  </div>
  
</div>

<!--myModal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">      
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addModalLabel">新增图片分类</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="sub_form">
        <div class="card-body">
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
            <input type="hidden" id="data_id" name="data_id" value="" />
            <div class="mb-3 col-md-12">
              <label for="title" class="form-label">*分类名称</label>
              <input type="text" class="form-control" id="title" name="title" value="" placeholder="输入分类名称" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="sort" class="form-label">显示顺序</label>
              <input type="text" class="form-control" id="orders" name="orders" value="0" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="status" class="form-label">上架状态</label>
              <div class="clearfix">
                <div class="form-check form-check-inline">
                  <input type="radio" id="isshow" name="isshow" value="1" class="form-check-input" checked>
                  <label class="form-check-label" for="shangjia">上架</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" id="isshow" name="isshow" value="0" class="form-check-input">
                  <label class="form-check-label" for="xiajia">下架</label>
                </div>
              </div>
            </div>         
        </div>
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary ajax-post sub_type" target-form="add-form" onclick="add_or_update()">提 交</button>
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!-- myModal end -->

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

    let formdata = $('#category').serialize();
    $.ajax({
      url: "{{url('admin/category_show_ids')}}",
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

    let formdata = $('#category').serialize();
    $.ajax({
      url: "{{url('admin/category_hiden_ids')}}",
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

  // 批量删除分类
  function idsdel(){
    let formdata = $('#category').serialize();
    $.ajax({
      url: "{{url('admin/category_del_ids')}}",
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

  // 删除指定id的分类
  function iddel(id){
    $.ajax({
      url: "{{url('admin/category_del_ids')}}",
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
        content: '<b>删除分类，将删除分类下的所有图辑和图片！！</b><br/>是否继续。',
        icon: 'mdi mdi-comment-question',
        animation: 'scale',
        closeAnimation: 'scale',
        opacity: 0.5,
        buttons: {
            'confirm': {
                text: '继续',
                btnClass: 'btn-blue',
                action: function() {
                  iddel(id); // 删除指定id的分类
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
        content: '<b>删除分类，将删除分类下的所有图辑和图片！！</b><br/>是否继续。',
        icon: 'mdi mdi-comment-question',
        animation: 'scale',
        closeAnimation: 'scale',
        opacity: 0.5,
        buttons: {
            'confirm': {
                text: '继续',
                btnClass: 'btn-blue',
                action: function() {
                  idsdel(); // 批量删除分类
                }
            },
            '取消': function() {                          
            },
        }
    });
  }

  // 新增 modal
  function addInfo()
  {
    $('.modal-title').text("新增图片分类");
    //重置表单
    $('#sub_form')[0].reset();
    // 设置data_id 为空
    $('#myModal #data_id').val('');
  }

  // 修改 modal
  function editInfo(index)
  {
    $('.modal-title').text('编辑图片分类');
    let data_id = $('.table')[0].rows[index].cells[1].innerText;
    let title = $('.table')[0].rows[index].cells[2].innerText;
    let orders = $('.table')[0].rows[index].cells[3].innerText;
    let isshow = $('.table')[0].rows[index].cells[4].innerText;
    // console.log(isshow);
    $('#myModal #data_id').val(data_id);
    $('#myModal #title').val(title);
    $('#myModal #orders').val(orders);
    if(isshow == "上架")
    {
      $("input[name='isshow'][value='1']").attr("checked", true);
    }
    if(isshow == "待审核")
    {
      $("input[name='isshow'][value='0']").attr("checked", true);
    }
  }

  // 新增/修改后提交
  function add_or_update()
  {
    let data_id = $('#data_id').val();
    // console.log(data_id);
    let title = $('#title').val();
    let orders = $('#orders').val();
    if ($.trim(title) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '分类名称不能为空',
      });
      return false;
    } 
    else if ($.trim(orders) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '显示顺序不能为空',
      });
      return false;
    }

    if(data_id !== '') {
      // console.log('修改');
      $.ajax({
        type: "POST",
        url: "{{url('admin/update_picture_category')}}",
        dataType: "json",
        data: $('#sub_form').serialize(),
        success: function (res) {
          // console.log(res);
          // 关闭模态框并清除框内数据，否则下次打开还是上次的数据
          $("#sub_form")[0].reset();
          $('#myModal').modal('hide');
          location.reload();
        }
      })
    } else {
      // console.log('增加');
      $.ajax({
        type: "POST",
        url: "{{url('admin/add_picture_category')}}",
        dataType: "json",
        data: $('#sub_form').serialize(),
        success: function (res) {
          // console.log(res);
          // 关闭模态框并清除框内数据，否则下次打开还是上次的数据
          $("#sub_form")[0].reset();
          $('#myModal').modal('hide');
          location.reload();
        }
      })
    }
  }
</script>
</body>
</html>