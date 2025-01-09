<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统。">
<title>图片审核 - 后台管理</title>
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
        <header class="card-header"><div class="card-title">图辑列表</div></header>
        <div class="card-body">
          <div class="card-search mb-2-5">
            <form class="search-form" method="post" action="#!" role="form">

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
        <form id="piclist" method="post" action="">
          <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
          <div class="card-btns mb-2-5">
<!--            <a class="btn btn-sm btn-primary me-1" href="#!"><i class="mdi mdi-plus"></i> 新增</a>-->
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
                  <th>图辑名称</th>
                  <th>简介</th>
                  <th>会员</th>
                  <th>下载需积分</th>
                  <th>平台</th>
                  <th>图片分类</th>
                  <th>图片item</th>
                  <th>图片数量</th>
                  <th>下载次数</th>
                  <th>收藏数量</th>
                  <th>显示状态</th>
                  <th>发布时间</th>
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
                  <td>
                    <a href="#!" data-bs-toggle="modal" data-bs-target="#myModal" data-picid="{{$picture->id}}">{{$picture->title}}</a>
                  </td>
                  <td>
                    @if($picture->describe == null)
                      --
                    @else
                      {{$picture->describe->describe}}
                    @endif
                  </td>
                  <td>{{isset($picture->user->nickname)? $picture->user->nickname : ''}}</td>
                  <td>{{$picture->score}}</td>
                  <td>{{$picture->device_type}}</td>
                  <td>{{isset($picture->picCategory->title)? $picture->picCategory->title : ''}}</td>
                  <td><img src="{{$picture->item !=null ? $picture->item->url : '#'}}" style="width: 100px;"></td>
                  <td>{{$picture->item_count}}</td>
                  <td>{{$picture->download}}</td>
                  <td>{{$picture->collect}}</td>
                  <td>
                    <a href="{{url('admin/picture_show?picid=' . $picture->id)}}">
                      @if($picture->is_show == 1)
                        <span class="badge bg-success">上架</span>
                      @endif
                      @if($picture->is_show == 0)
                        <span class="badge bg-secondary">待审核</span>
                      @endif
                    </a>
                  </td>
                  <td>{{date('Y-m-d H:i', $picture->updated_time)}}</td>
                  <td>
                    <div class="btn-group btn-group-sm">
<!--                      <a class="btn btn-default" href="#!" data-bs-toggle="tooltip" title="编辑" data-url="{{url('admin/edit_picture?id=' . $picture->id)}}" ><i class="mdi mdi-pencil"></i></a>-->
                        <a href="#!" class="btn btn-default js-create-tab" data-bs-toggle="tooltip" title="编辑图辑" data-title="编辑" data-url="{{url('admin/edit_picture?id=' . $picture->id)}}"><i class="mdi mdi-pencil"></i></a>
                      <a class="btn btn-default" data-bs-toggle="tooltip" title="删除" onclick="confirm_Id([{{$picture->id}}])"><i class="mdi mdi-window-close"></i></a>
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

<!--images Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="myModalLabel">图辑</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <form id="sub_form">
                <div class="card-body">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" id="data_id" name="data_id" value="" />
                    <div class="mb-3 col-md-12">
                        <label for="title" class="form-label">*图辑名称</label>
                        <input type="text" class="form-control" id="title" name="title" value="" placeholder="输入图辑名称" />
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="describe" class="form-label">简介</label>
                        <input type="text" class="form-control" id="describe" name="describe" value="" />
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="user_id" class="form-label">会员id</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" value="1" />
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="device_type" class="form-label">平台id（暂无具体含义）</label>
                        <input type="text" class="form-control" id="device_type" name="device_type" value="1" />
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="pic_category_id" class="form-label">图片分类id</label>
                        <input type="number" class="form-control" id="pic_category_id" name="pic_category_id" value="" />
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="item_count" class="form-label">图片数量</label>
                        <input type="number" class="form-control" id="item_count" name="item_count" value="1" />
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
<!-- image modal end -->

<script type="text/javascript" src="{{asset('lightyearadmin/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/bootstrap.min.js')}}"></script>
<!--对话框插件js-->
<script type="text/javascript" src="{{asset('lightyearadmin/js/jquery-confirm/jquery-confirm.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/main.min.js')}}"></script>

<script type="text/javascript">
    // 新增 modal
    function addInfo()
    {
        $('.modal-title').text("新增图辑");
        //重置表单
        $('#sub_form')[0].reset();
        // 设置data_id 为空
        $('#myModal #data_id').val('');
    }
    // 新增/修改后提交
    function add_or_update()
    {
        let data_id = $('#data_id').val();
        // console.log(data_id);
        let title = $('#title').val();
        // let describe = $('#describe').val();
        // let user_id = $('#user_id').val();
        // let device_type = $('#device_type').val();
        let pic_category_id = $('#pic_category_id').val();
        let item_count = $('#item_count').val();
        if ($.trim(title) == '') {
            $.alert({
                title: '提示',
                icon: 'mdi mdi-alert',
                type: 'orange',
                content: '图辑名称不能为空',
            });
            return false;
        }
        else if ($.trim(pic_category_id) == '' || $.trim(item_count) == '') {
            $.alert({
                title: '提示',
                icon: 'mdi mdi-alert',
                type: 'orange',
                content: '图辑分类/数量不能为空',
            });
            return false;
        }

        if(data_id !== '') {
            // console.log('修改');
            $.ajax({
                type: "POST",
                url: "{{url('admin/update_picture')}}",
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
                url: "{{url('admin/add_picture')}}",
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

  function qiyong(){
    $isbool = $("input[id='ids-1']").is(":checked");
    if(!$isbool) {
      $.alert('请选中要操作的记录');
      return;
    }

    let formdata = $('#piclist').serialize();
    $.ajax({
      url: "{{url('admin/picture_show_ids')}}",
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

    let formdata = $('#piclist').serialize();
    $.ajax({
      url: "{{url('admin/picture_hiden_ids')}}",
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

  // 批量删除图辑
  function idsdel(){
    let formdata = $('#piclist').serialize();
    $.ajax({
      url: "{{url('admin/picture_del_ids')}}",
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

  // 删除指定id的图辑
  function iddel(id){
    $.ajax({
      url: "{{url('admin/picture_del_ids')}}",
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
        content: '删除图辑，将删除图辑下的所有图片！！<br/>是否继续。',
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
        content: '批量删除选中的图辑，将删除图辑下的所有图片！！<br/>是否继续。',
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

  // Bootstrap模态对话框中显示动态内容
  const myModalEl = document.getElementById('myModal')
  myModalEl.addEventListener('show.bs.modal', event => {
    // 获取触发模态的按钮
    var button = $(event.relatedTarget);
    // 从自定义data-* 属性中提取值
    var picId = button.data("picid");
    var frameSrc = "{{url('admin/pic_item_id?picture_id=')}}" + picId;
    $("#iframe").attr("src", frameSrc);
  })

  // 模态框关闭后清除模态框的数据
  $("#myModal").on("hidden.bs.modal", function() {
    // $(this).removeData("bs.modal");
    $("#iframe").attr("src", '');
  });

</script>
</body>
</html>
