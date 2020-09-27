@extends('layout.layout')
@section('title','添加菜单')
@section('content')
    <span class="layui-breadcrumb">
  <a href="/">首页</a>
  <a href="/role/addpriv">添加菜单</a>
  <a><cite>添加菜单</cite></a>
</span>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加菜单</title>
    <center><h1>添加菜单</h1>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<table class="table">
    <caption>添加菜单</caption>
    <thead>
    <tr>
        <!-- <th>ID</th> -->
        <th>菜单名称</th>
        <!-- <th>菜单url</th>
        <th>菜单别名</th> -->
        <th><input type="checkbox" name="checkbox1"></th>
        <input type="hidden" name="role_id" value="{{$role_id}}">
    </tr>
    </thead>
    <tbody>
    @foreach($weight_list as $k=>$v)
    <tr>
        <!-- <td>{{$v->weight_id}}</td> -->
        <td id="{{$v->weight_id}}" ><span class="oldname weight_name">{{str_repeat('|--',$v->level)}}{{$v->weight_name}}</span></td>
        <td><input type="checkbox" name="checkbox2" class="check2" weight_id="{{$v->weight_id}}" p_id="{{$v->p_id}}"></td>
    </tr>
    @endforeach
    </tbody>

</table>
<button type="button" id="success" class="btn btn-success">添加权限</button>
</body>
</html>

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
  $(document).on('click','.check2',function (){
        var _this = $(this);
        var weight_id = _this.attr('weight_id');

        if(_this.prop('checked') == true){
            $("input[p_id="+weight_id+"]").prop('checked',true);
        }else{
          $("input[p_id="+weight_id+"]").prop('checked',false);
        }


        var p_id = _this.attr('p_id');
        if(_this.prop('checked') == true){
            $("input[weight_id="+p_id+"]").prop('checked',true);
        }else{
            $("input[weight_id="+p_id+"]").prop('checked',false);
        }
  });

  $(document).on('click','#success',function(){
  var arr = [];
  $("input[name='checkbox2']:checked").each(function(){
      var weight_id = $(this).attr('weight_id');
      arr.push(weight_id);
  })
  var role_id = $("input[name='role_id']").val();
  // console.log(role_id);
  if(arr.length == 0){
      alert('请选择要添加的权限');
      return false;
  }
    $.ajax({
      url : '/weight/addweight',
      dataType : 'json',
      type : 'get',
      data : {'role_id':role_id,'arr':arr},
      success:function(res){
        if(res.code==0){
            location.href="/role/list";
            console.log(res.msg);
        }else{
          alert(res.msg);return ;
        }
      }
    });
    return false;
  });
</script>
