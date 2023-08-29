<!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="keywords" content="后台模板,后台管理系统">
<meta name="description" content="基于Bootstrap v5.1.3的后台管理系统的HTML模板。">
<title>编辑文章|新增文章 - 后台管理</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/materialdesignicons.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/animate.min.css')}}">
<!--对话框插件css-->
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/js/jquery-confirm/jquery-confirm.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('lightyearadmin/css/style.min.css')}}">

<style>
.ck.ck-content:not(.ck-comment__input *) {
    height: 300px;
    overflow-y: auto;
}
[data-theme='dark'] .ck.ck-toolbar,
[data-theme|='translucent'] .ck.ck-toolbar,
[data-theme='dark'] .ck.ck-editor__main>.ck-editor__editable,
[data-theme|='translucent'] .ck.ck-editor__main>.ck-editor__editable,
[data-theme='dark'] .ck.ck-toolbar .ck.ck-toolbar__separator,
[data-theme|='translucent'] .ck.ck-toolbar .ck.ck-toolbar__separator {
    background-color: rgba(var(--bs-white-rgb), .2);
}
[data-theme='dark'] .ck.ck-toolbar,
[data-theme|='translucent'] .ck.ck-toolbar,
[data-theme='dark'] .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused),
[data-theme|='translucent'] .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
    border-color: rgba(var(--bs-white-rgb), .2);
}
[data-theme='dark'] .ck.ck-dropdown__panel,
[data-theme|='translucent'] .ck.ck-dropdown__panel {
    background-color: rgba(var(--bs-white-rgb), .2);
    border-color: rgba(var(--bs-white-rgb), .2);
    backdrop-filter: blur(10px);
}
[data-theme='dark'] .ck.ck-list,
[data-theme|='translucent'] .ck.ck-list {
    background-color: transparent;
}
</style>

</head>
  
<body>
<div class="container-fluid">
  
  <div class="row">
    
    <div class="col-lg-12">
      <div class="card">
        <header class="card-header"><div class="card-title">{{isset($article->id) ? '编辑文章' : '新增文章'}}</div></header>
        <div class="card-body">
          
          <form action="{{url('admin/save_article')}}" method="post" class="row add" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" value="{{isset($article->id) ? $article->id : ''}}" />
            <div class="mb-3 col-md-12">
              <label for="title" class="form-label">*标题</label>
              <input type="text" class="form-control" id="title" name="title" value="{{isset($article->title) ? $article->title : ''}}" placeholder="输入主标题" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="sort" class="form-label">文章内容</label>
                <textarea name="content" id="editor">{{isset($article->content) ? $article->content : ''}}</textarea>
              </div>
            <div class="mb-3 col-md-12">
              <label for="sort" class="form-label">显示顺序</label>
              <input type="text" class="form-control" id="orders" name="orders" value="{{isset($article->orders) ? $article->orders : 0}}" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="status" class="form-label">上架状态</label>
              <div class="clearfix">
                <div class="form-check form-check-inline">
      	          <input type="radio" id="is_show" name="is_show" value="1" class="form-check-input" @if((isset($article->is_show) ? $article->is_show : 1) == 1)checked @endif>
      	          <label class="form-check-label" for="shangjia">上架</label>
      	        </div>
      	        <div class="form-check form-check-inline">
      	          <input type="radio" id="is_show" name="is_show" value="0" class="form-check-input" @if((isset($article->is_show) ? $article->is_show : 1) == 0)checked @endif>
      	          <label class="form-check-label" for="xiajia">下架</label>
      	        </div>
              </div>
            </div>
            <div class="mb-3 col-md-12">
              <button type="submit" class="btn btn-sm btn-primary ajax-post" target-form="add-form">确 定</button>
              <button type="reset" class="btn btn-sm btn-default">重 置</button>
            </div>
          </form>
          
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
<script type="text/javascript" src="{{asset('lightyearadmin/js/ckeditor5/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('lightyearadmin/js/ckeditor5/script.js')}}"></script>

<script type="text/javascript">
  // 重点代码 适配器
  // class UploadAdapter {
  //   constructor(loader) {
  //       this.loader = loader;
  //   }
  //   upload() {
  //     return new Promise((resolve, reject) => {
  //       const data = new FormData();
  //       let file = [];
  //       //this.loader.file 这是一个Promise格式的本地文件流，一定要通过.then 进行获取，之前在各大博客查了很多文章都拿不到这个值，最后经过两个多小时的探索终于找到了是Promise问题。
  //       this.loader.file.then(res=>{
  //         file = res; //文件流 
  //         data.append('file', file); //传递给后端的参数，参数名按照后端需求进行填写
  //         data.append('type','ckeditor');
  //         $.ajax({
  //             url: 'data/upload.php', //后端的上传接口 
  //             type: 'POST',
  //             data: data,
  //             dataType: 'json',
  //             processData: false,
  //             contentType: false,
  //             success: function (data) {
  //               // 成功返回格式{"uploaded":1,"fileName":"图片名称","url":"图片访问路径"}
  //               // 失败返回格式{"uploaded":0,"message":"失败原因"}
  //               if (data) {
  //                   resolve({
  //                     default: '/data/' + data.url // 自己定义好自己的路径，这里演示用
  //                   });
  //               } else {
  //                 reject(data.msg);
  //               }        
  //             }
  //         });
  //       })
  //     });
  //   }
  //   abort() {}
  // }  
  // ClassicEditor
  //   .create( document.querySelector( '#editor' ), {
  //     // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
  //     placeholder: '请输入文章内容!',
  //     language: 'zh-cn'
  //   })
  //   .then( editor => {
  //     // 加载了适配器
  //     editor.plugins.get('FileRepository').createUploadAdapter = (loader)=>{
  //       return new UploadAdapter(loader);
  //     };
  //     window.editor = editor;
  //   })
  //   .catch( err => {
  //     console.error( err.stack );
  //   });


  $('.add').on('submit', function(event) {
    var $first_title = $('#first_title').val();
    var $second_title = $('#second_title').val();
    var $url = $('#url').val();
    var $orders = $('#orders').val();
    var fileInput = $('.ggy-upload-input').get(0).files[0];
    if($.trim($first_title) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '主标题不能为空',
      });
      return false;
    } else if($.trim($second_title) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '副标题不能为空',
      });
      return false;
    } else if($.trim($url) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '跳转地址不能为空',
      });
      return false;
    } else if($.trim($orders) == '') {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '显示顺序不能为空',
      });
      return false;
    } else if(!fileInput) {
      $.alert({
        title: '提示',
        icon: 'mdi mdi-alert',
        type: 'orange',
        content: '上传图片不能为空',
      });
      return false;
    } else {
      form.submit();
      return false;
    } 
  });


</script>
</body>
</html>