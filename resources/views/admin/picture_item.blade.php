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
                  <button type="submit" class="btn btn-primary me-1">搜索</button>
                  <button type="reset" class="btn btn-default">重置</button>
                </div>
              </div>
              
            </form>
          </div>
          <div class="card-btns mb-2-5">
            <a class="btn btn-primary me-1" href="#!"><i class="mdi mdi-plus"></i> 新增</a>
            <a class="btn btn-success me-1" href="#!"><i class="mdi mdi-check"></i> 启用</a>
            <a class="btn btn-warning me-1" href="#!"><i class="mdi mdi-block-helper"></i> 禁用</a>
            <a class="btn btn-danger" href="#!"><i class="mdi mdi-window-close"></i> 删除</a>
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
                  <th>图组名称</th>
                  <th>简介</th>
                  <th>下载需积分</th>
                  <th>平台</th>
                  <th>图片分类</th>
                  <th>图片数量</th>
                  <th>下载次数</th>
                  <th>收藏数量</th>
                  <th>是否上架</th>
                  <th>发布时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pictures as $picture)
                <tr>
                  <td>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input ids" name="ids[]" value="1" id="ids-1">
                      <label class="form-check-label" for="ids-1"></label>
                    </div>
                  </td>
                  <td>{{$picture->id}}</td>
                  <td>{{$picture->title}}</td>
                  <td>{{$picture->describe}}</td>
                  <td>{{$picture->score}}</td>
                  <td>{{$picture->dev_pic}}</td>
                  <td>{{$picture->category_id}}</td>
                  <td>{{$picture->item_count}}</td>
                  <td>{{$picture->collect}}</td>
                  <td>{{$picture->is_show}}</td>
                  <td>{{date('Y-m-d H:i', $picture->created_time)}}</td>
                  <td>{{date('Y-m-d H:i', $picture->updated_time)}}</td>
                  <td>
                    <div class="btn-group btn-group-sm">
                      <a class="btn btn-default" href="#!" data-bs-toggle="tooltip" title="编辑"><i class="mdi mdi-pencil"></i></a>
                      <a class="btn btn-default" href="#!" data-bs-toggle="tooltip" title="删除"><i class="mdi mdi-window-close"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{$pictures->links()}}      
          
        </div>
      </div>
    </div>
        
  </div>
  
</div>
<script type="text/javascript" src="{{asset('lightyearadmin/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/main.min.js')}}"></script>
</body>
</html>