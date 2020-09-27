@extends('layout.layout')
@section('title','菜单添加')
@section('content')

<span class="layui-breadcrumb">
<a href="/">首页</a>
<a href="/weight/list">菜单管理</a>
<a><cite>菜单添加</cite></a>
</span>
<center><h1>菜单添加</h1></center><hr/>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="/static/admin/jquery.min.js"></script>
<script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/weight/store')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
<div class="alert alert-success">
   {{ session('msg') }}
</div>
@endif
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">菜单名称</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="firstname" name="weight_name"
               placeholder="请输入菜单名称"><span style="color: darkred;">
    </div><span class="span1"></span>
</div>

<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">url</label>
    <div class="col-sm-8">
  <input type="text" class="form-control" id="url" class="url" name="url"
                  placeholder="请输入url">
    </div><span class="span"></span>
</div>
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">路由别名</label>
    <div class="col-sm-8">
  <input type="text" class="form-control" id="routename" class="routename" name="routename"
                  placeholder="请输入路由别名">
    </div><span class="span3"></span>
</div>

<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">父极分类</label>
    <div class="col-sm-8">
        <select name="p_id">
              <option value="">请选择</option>
              @foreach($weight_list as $k=>$v)
                <option value="{{$v->weight_id}}">{{str_repeat('|--',$v->level)}}{{$v->weight_name}}</option>
              @endforeach
        </select>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" id="create" class="btn btn-default">添加</button>
        <button type="reset" class="btn btn-default">重置</button>
        <a href="/weight/list" class="btn btn-default">前往列表</a>
    </div>
</div>
</form>


<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script>
        var page1 = false;
        $(document).on('blur','input[name="weight_name"]',function(){
            var _this = $(this);
              var weight_name = _this.val();
              if(weight_name==""){
                  $(".span1").css('color','red').html('菜单名称不能为空');
                  page1 = false;
              }else{
                  $(".span1").css('color','green').html('√');
                  page1 = true;
              }

        });
        var page2 = false;
        $(document).on('blur','#url',function(){
            var _this = $(this);
              var url = _this.val();
              if(url==""){
                  $(".span").css('color','red').html('菜单url不能为空');
                page2 = false;
              }else{
                $(".span").css('color','green').html('√');
                page2 = true;
              }

        });

        var page3 = false;
        $(document).on('blur','#routename',function(){
            var _this = $(this);
              var routename = _this.val();
              if(routename==""){
                  $(".span3").css('color','red').html('路由别名不能为空');
                page2 = false;
              }else{
                $(".span3").css('color','green').html('√');
                page2 = true;
              }

        });
        $(document).on('click','#create',function(){
            if(page1===false || page2===false){
              $(".span1").css('color','red').html('菜单名称不能为空');
              $(".span").css('color','red').html('菜单url不能为空');
              $(".span3").css('color','red').html('路由别名不能为空');
                return false;
            }

        });
</script>

@endsection