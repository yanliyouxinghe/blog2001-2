@extends('layout.layout')
@section('title','管理员列表')
@section('content')
    <span class="layui-breadcrumb">
  <a href="/">首页</a>
  <a href="/admin/list">管理员管理</a>
  <a><cite>管理员列表</cite></a>
</span>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员列表</title>
    <center><h1>管理员列表</h1><a href="/admin/create"><button type="button" class="btn btn-primary">前往添加</button></a></center><hr/>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<table class="table">
    <caption>管理员列表展示</caption>

    <thead>
    <tr>
        <th><input type="checkbox" name="checkbox1"></th>
        <th>ID</th>
        <th>管理员名称</th>
        <th>管理员手机号</th>
        <th>操作</th>


    </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
    <tr>
        <td><input type="checkbox" name="checkbox2" value="{{$v->admin_user_id}}"></td>
        <td>{{$v->admin_user_id}}</td>
        <td id="{{$v->admin_user}}"><span class="oldname weight_name">{{$v->admin_user}}</span></td>
        <td>{{$v->admin_plone}}</td>

        <td>
{{--            <a href="{{url('/admin/destroy/'.$v->role_id)}}">--}}
                <button type="button" class="btn btn-danger" admin_user_id="{{$v->admin_user_id}}">删除</button>
{{--            </a>--}}
            <a href="{{url('/admin/show/'.$v->brand_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
        </td>
    </tr>

    @endforeach
    <tr><td colspan="6">{{ $data->links('vendor.pagination.adminbrand') }}</td></tr>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="pil">批量删除</button>
    </tbody>

</table>
</body>
</html>
@endsection
<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
//     //即点即该
//     // var brand_name = $('.brand_name').text();
//     $(document).on('click','.brand_name',function (){
//                 brand_name = $(this).text();
//             var id = $(this).parent().attr('id');
//             $(this).parent().html('<input type="text" id="input_rem" class="brand_id input_name" value='+brand_name+'>');
//             $(".input_name"+id).val("").focus().val(brand_name);
//     });
//     $(document).on('blur',".brand_id",function (){
//         var newname = $(this).val();
//         var brand_id = $(this).parent().attr('id');
//         var _this = $(this);
//         if(!newname || !brand_id){
//             // $(this).remove();
//             _this.parent().html('<span class="brand_name">'+brand_name+'</span>');
//             return ;
//         }
//         if(newname == brand_name){
//             _this.parent().html('<span class="brand_name">'+brand_name+'</span>');
//             return ;
//         }
//
//         $.ajax({
//             url : '/brand/updated',
//             dataType : 'json',
//             type : 'post',
//             data : {'brand_id':brand_id,'brand_name':newname},
//             success:function ( res ){
//                 // console.log(res);
//                 if( res.code == 0 ){
//                     // location.reload();
//                     alert(res.msg)
//                     // $(".brand_id").remove();
//                     _this.parent().html('<span class="brand_name">'+newname+'</span>');
//                 }else{
//                     alert('操作繁忙，请稍后重试...');
//                     return false;
//                 }
//             }
//         });
//         return;
//     });
//
//
//全选
$(document).on('click','input[name="checkbox1"]',function (){
    var _this = $(this);
    if(_this.prop('checked') == true){
        $('input[name="checkbox2"]').prop('checked',true);
    }else{
        $('input[name="checkbox2"]').prop('checked',false);
    }

});
//
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
                url : '/admin/destroy',
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
           var id = _this.attr('admin_user_id');
           console.log(id);
            $.ajax({
                url : '/admin/destroy',
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
