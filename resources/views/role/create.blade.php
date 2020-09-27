@extends('layout.layout')
@section('title','角色添加')
@section('content')

<span class="layui-breadcrumb">
<a href="/">首页</a>
<a href="/brand/list">角色管理</a>
<a><cite>角色添加</cite></a>
</span>
<center><h1>角色添加</h1></center><hr/>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="/static/admin/jquery.min.js"></script>
<script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/role/store')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
<div class="alert alert-success">
   {{ session('msg') }}
</div>
@endif
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">角色名称</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="firstname" name="role_name"
               placeholder="请输入角色名称"><span style="color: darkred;">
    </div><span class="span1"></span>
</div>

<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">角色描述</label>
    <div class="col-sm-8">
  <textarea type="text" class="form-control" id="sole_desc" class="sole_desc" name="role_desc"
                  placeholder="请输入角色描述"></textarea>
    </div><span class="span"></span>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" id="create" class="btn btn-default">添加</button>
        <button type="reset" class="btn btn-default">重置</button>
        <a href="/role/list" class="btn btn-default">前往列表</a>
    </div>
</div>
</form>

@endsection

<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script>
        var page1 = false;
        $(document).on('blur','input[name="role_name"]',function(){
            var _this = $(this);
              var sole_name = _this.val();
              if(sole_name==""){
                  $(".span1").css('color','red').html('角色名称不能为空');
                  page1 = false;
              }else{
                  $(".span1").css('color','green').html('√');
                  page1 = true;
              }

        });
        var page2 = false;
        $(document).on('blur','#sole_desc',function(){
            var _this = $(this);
              var sole_desc = _this.val();
              if(sole_desc==""){
                  $(".span").css('color','red').html('角色描述不能为空');
                page2 = false;
              }else{
                $(".span").css('color','green').html('√');
                page2 = true;
              }

        });
        $(document).on('click','#create',function(){
            if(page1===false || page2===false){
              $(".span1").css('color','red').html('角色名称不能为空');
              $(".span").css('color','red').html('角色描述不能为空');

                return false;
            }

        });




</script>
