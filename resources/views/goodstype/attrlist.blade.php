@extends('layout.layout')
@section('title','属性列表')
@section('content')
<span class="layui-breadcrumb">
  <a href="/">首页</a>
  <a href="/goodstype/proplist">属性管理</a>
  <a><cite>属性列表</cite></a>
</span>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>属性列表</title>
    <center><h1>属性列表</h1></center><hr/>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<table class="table">
    <caption>属性列表展示</caption>
    <thead>
    <tr>
        <th><input type="checkbox" name="checkbox1"></th>
        <th>ID</th>
        <th>属性名称</th>
        <th>商品类型</th>
        <th>录入方式</th>
        <th>可选值列表</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Attrlist as $v)
    <tr>
        <td><input type="checkbox" name="checkbox2" value="{{$v->attr_id}}"></td>
        <td>{{$v->attr_id}}</td>
        <td id="{{$v->attr_name}}"><span class="oldname role_name">{{$v->attr_name}}</span></td>
        <td>{{$v->cat_name}}</td>
        <td>
            @if($v->attr_input_type == '0')
                手工录入
            @else
                下拉选择
            @endif
    </td>
        <td style="width:20%">{{$v->attr_values}}</td>
        <td>

                <button type="button" class="btn btn-default">编辑</button>
                <button type="button" class="btn btn-danger" attr_id="{{$v->attr_id}}">删除</button>

        </td>
    </tr>
    @endforeach
    <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="pil">批量删除</button>
    </tbody>
</table>
</body>
</html>
<a href="{{url('/goodstype/addattr/'.$cat_id)}}"><button type="button" class="btn btn-primary">添加属性</button></a>
@endsection
<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
//全选
$(document).on('click','input[name="checkbox1"]',function (){

    var _this = $(this);
    if(_this.prop('checked') == true){
        $('input[name="checkbox2"]').prop('checked',true);
    }else{
        $('input[name="checkbox2"]').prop('checked',false);
    }

});
//批量删除
$(document).on('click',".layui-btn-xs",function(){
        var ids = new Array();

   $('input[name="checkbox2"]:checked').each(function (i,k){
       ids.push($(this).val());
   });
   if (ids.length == 0){
       alert('请选择要删除的数据');
       return;
   }
       var isdel = confirm("确定要删除所选的数据吗？");
        if(isdel == true){
            $.ajax({
                url : '/goodstype/delattr',
                dataType : 'json',
                type : 'get',
                data : {'ids':ids},
                success:function ( res ){
                    console.log(res);
                    if( res.code == 0 ){
                        location.reload();
                    }else{
                        alert('操作繁忙，请稍后重试...');
                        return false;
                    }
                }
            });
        }
        return false;
});
//删除
    $(document).on("click",".btn-danger",function (){
        //这个对象
        var _this = $(this);
        //判断用户是否确认删除
       var ifdel = confirm("您确定删除吗？");
       if(ifdel == true){
           var id = _this.attr('attr_id');
           console.log(id);
            $.ajax({
                url : '/goodstype/delattr',
                dataType : 'json',
                type : 'get',
                data : {'id':id},
                success:function ( res ){
                    if( res.code == 0 ){
                        location.reload();
                    }else{
                        alert('操作繁忙，请稍后重试...');
                        return false;
                    }
                    console.log(res);
                  }
            });
       }
       return false;
    });
// 分页
    $(document).on('click','#layui-laypage-1 a',function(){
        // alert(111);
        var url = $(this).attr('href');
        $.get(url,function(result){
            $('tbody').html(result);
        });
        return false;
    });
</script>
