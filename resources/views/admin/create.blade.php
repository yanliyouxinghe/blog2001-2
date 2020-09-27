@extends('layout.layout')
@section('title','管理员添加')
@section('content')

<span class="layui-breadcrumb">
<a href="/">首页</a>
<a href="/admin/list">管理员管理</a>
<a><cite>管理员添加</cite></a>
</span>
<center><h1>管理员添加</h1></center><hr/>


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="/static/admin/jquery.min.js"></script>
<script src="/static/admin/bootstrap.min.js"></script>
<form action="{{url('/admin/store')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

@if (session('msg'))
<div class="alert alert-success">
   {{ session('msg') }}
</div>
@endif
<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">管理员名称</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="firstname" name="admin_user"
               placeholder="请输入管理员名称"><span style="color: darkred;">
    </div><span class="span1"></span>
</div>

<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" class="admin_pwd" id="admin_pwd" name="admin_pwd"
               placeholder="密码"><span style="color: darkred;">
    </div><span class="span"></span>
</div>

<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">确认密码</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" id="admin_pwds" class="admin_pwds" name="admin_pwds"
               placeholder="确认密码"><span style="color: darkred;">
    </div><span class="span2"></span>
</div>

<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">手机号码</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="admin_plone" class="admin_plone" name="admin_plone"
               placeholder="请输入手机号码"><span style="color: darkred;">
    </div><span class="span3"></span>
</div>

<div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">角色</label>
    <div class="col-sm-8">
      @foreach($role as $k=>$v)
        <input type="checkbox" name="role[]" value="{{$v->role_id}}">{{$v->role_name}}
      @endforeach
        <span style="color: darkred;">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" id="create" class="btn btn-default">添加</button>
        <button type="reset" class="btn btn-default">重置</button>
        <a href="/admin/list" class="btn btn-default">前往列表</a>
    </div>
</div>
</form>
@endsection
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script>
        var page1 = false;
        $(document).on('blur','input[name="admin_user"]',function(){
            var _this = $(this);
              var admin_user = _this.val();
              if(admin_user==""){
                  $(".span1").css('color','red').html('管理员名称不能为空');
                  page1 = false;
              }else{
                  $(".span1").css('color','green').html('√');
                  page1 = true;
              }

        });
        var page2 = false;
        $(document).on('blur','#admin_pwd',function(){
            var _this = $(this);
              var admin_pwd = _this.val();
              if(admin_pwd==""){
                  $(".span").css('color','red').html('密码不能为空');
                page2 = false;
              }else{
                $(".span").css('color','green').html('√');
                page2 = true;
              }

        });

        var page3 = false;
        $(document).on('blur','#admin_pwds',function(){
            var _this = $(this);
              var admin_pwds = _this.val();
              var admin_pwd = $('input[name="admin_pwd"]').val();
              // console.log(admin_pwd);
              // console.log(admin_pwds);
              if(admin_pwds==""){
                  $(".span2").css('color','red').html('确认密码不能为空');
                page2 = false;
              }else if(admin_pwds !== admin_pwd){
                $(".span2").css('color','red').html('确认密码需和密码保持一致');
              page2 = false;
              }else{
                $(".span2").css('color','green').html('√');
              page2 = true;
              }

        });

        var page3 = false;
        $(document).on('blur','#admin_plone',function(){
            var _this = $(this);
              var admin_plone = _this.val();
              if(admin_plone==""){
                  $(".span3").css('color','red').html('手机号码不能为空');
                page3 = false;
              }else{
                $(".span3").css('color','green').html('√');
                page3 = true;
              }
        });

        $(document).on('click','#create',function(){
            if(page1===false || page2===false ||  page3===false){
                $(".span1").css('color','red').html('管理员名称不能为空');
                $(".span").css('color','red').html('密码不能为空');
                $(".span2").css('color','red').html('确认密码不能为空');
                $(".span3").css('color','red').html('手机号码不能为空');
                return false;
            }


        });
</script>
