@extends('layout.layout')
@section('title','类型添加')
@section('content')

<span class="layui-breadcrumb">
<a href="/">首页</a>
<a href="/goodstype/list">类型管理</a>
<a><cite>类型添加</cite></a>
</span>
<center><h1>类型添加</h1></center><hr/>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="/static/admin/jquery.min.js"></script>
<script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/goodstype/addpropdo')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
<div class="alert alert-success">
   {{ session('msg') }}
</div>
@endif
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">属性名称</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="firstname" name="attr_name"
               placeholder="请输入类型名称"><span style="color: darkred;">
    </div><span class="span1"></span>
</div>
  <input type="hidden" name="cat_id" value="{{$id}}">
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">属性简介</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="firstname" name="attr_values"
               placeholder="请输入类型简介"><span style="color: darkred;">
    </div><span class="span2"></span>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" id="create" class="btn btn-default">添加</button>
        <button type="reset" class="btn btn-default">重置</button>
        <a href="/goodstype/list" class="btn btn-default">前往列表</a>
    </div>
</div>
</form>

@endsection

<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script>
        var page1 = false;
        $(document).on('blur','input[name="attr_name"]',function(){
            var _this = $(this);
              var attr_name = _this.val();
              if(attr_name==""){
                  $(".span1").css('color','red').html('属性名称不能为空');
                  page1 = false;
              }else{
                  $(".span1").css('color','green').html('√');
                  page1 = true;
              }

        });

        var page2 = false;
        $(document).on('blur','input[name="attr_values"]',function(){
            var _this = $(this);
              var attr_values = _this.val();
              if(attr_values==""){
                  $(".span2").css('color','red').html('属性简介不能为空');
                  page1 = false;
              }else{
                  $(".span2").css('color','green').html('√');
                  page1 = true;
              }

        });

        $(document).on('click','#create',function(){
            if(page1===false){
              $(".span1").css('color','red').html('属性名称不能为空');
                $(".span2").css('color','red').html('属性名称不能为空');
                return false;
            }


        });




</script>
