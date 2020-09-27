@extends('layout.layout')
@section('title','属性添加')
@section('content')
<span class="layui-breadcrumb">
<a href="/">首页</a>
<a href="/goodstype/list">类型管理</a>
<a><cite>属性添加</cite></a>
</span>
<center><h1>属性添加</h1></center><hr/>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="/static/admin/jquery.min.js"></script>
<script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/goodstype/storeattr')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
<div class="alert alert-success">
   {{ session('msg') }}
</div>
@endif
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">属性名称：</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="firstname" name="attr_name"
               placeholder="请输入属性名称"><span style="color: darkred;">
    </div><span class="span1"></span>
</div>
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">所属商品类型：</label>
    <div class="col-sm-8">
       <select name="cat_id">
            @foreach($type as $k=>$v)
                <option value="{{$v->cat_id}}" @if($v->cat_id == $id)selected @endif> {{$v->cat_name}}</option>
            @endforeach
       </select>
    </div><span class="span"></span>
</div>
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">属性是否可选：</label>
    <div class="col-sm-8">
        <input type="radio" value="0" class="inputtype" name="attr_type" checked>属性
        <input type="radio" value="1" class="inputtype" name="attr_type"> 规格
    </div>
</div>

<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">录入方式 :</label>
    <div class="col-sm-8">
        <input type="radio" value="0"  class="inputtype" name="attr_input_type" checked>手工录入
        <input type="radio" value="1"  class="inputtype" name="attr_input_type"> 下拉选择
    </div>
</div>

<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">可选值列表： :</label>
    <div class="col-sm-8">
       <textarea name="attr_values" id="" cols="30" rows="5" disabled></textarea>
    </div>
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
        $(document).on('click','#create',function(){
            if(page1===false){
              $(".span1").css('color','red').html('类型名称不能为空');
                return false;
            }

        });
        $(document).on('click','.inputtype:gt(1)',function(){
            var type_id = $(this).val();
        
            if(type_id == 1){
                $('textarea').removeAttr('disabled');
            }else{
                $('textarea').attr('disabled','disabled')
            }
        });
</script>
