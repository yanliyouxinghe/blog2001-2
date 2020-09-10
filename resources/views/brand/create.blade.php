@extends('layout.layout')
@section('title','品牌添加')
@section('content')
    <span class="layui-breadcrumb">
  <a href="/">首页</a>
  <a href="/brand/list">品牌管理</a>
  <a><cite>品牌添加</cite></a>
</span>
<center><h1>商品品牌添加</h1></center><hr/>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="/static/admin/jquery.min.js"></script>
	<script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/brand/store')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
    <div class="alert alert-success">
       {{ session('msg') }}
    </div>
@endif
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="brand_name"
                   placeholder="请输入品牌名称">
        </div>   <span style="color: darkred;">（必填）</span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="brand_url"
                   placeholder="请输入品牌网址">
        </div><span style="color: darkred;">（必填）</span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌LOGO</label>
        <div class="layui-upload-drag" id="test10">
            <input type="hidden" id="fileview" name="brand_logo" value="">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView">
                <hr>
                <img src="" alt="上传成功后渲染" style="max-width: 196px">
            </div>
        </div>
        <span style="color: darkred;">（必选）</span>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="brand_desc"
                      placeholder="请输入品牌描述"></textarea>
        </div><span style="color:green">（非必填）</span>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
            <button type="reset" class="btn btn-default">重置</button>
            <a href="/brand/list" class="btn btn-default">前往列表</a>
        </div>
    </div>
</form>


@endsection
