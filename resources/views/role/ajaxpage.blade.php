@foreach($data as $k=>$v)
<tr>
    <td><input type="checkbox" name="checkbox2" value="{{$v->role_id}}"></td>
    <td>{{$v->role_id}}</td>
    <td id="{{$v->role_name}}"><span class="oldname role_name">{{$v->role_name}}</span></td>
    <td>{{$v->role_desc}}</td>
    <td>
{{--            <a href="{{url('/role/destroy/'.$v->role_id)}}">--}}
            <button type="button" class="btn btn-danger" role_id="{{$v->role_id}}">删除</button>
{{--            </a>--}}
        <a href="{{url('/weight/addpriv/'.$v->role_id)}}"><button type="button" class="btn btn-info">添加权限</button></a>

        <a href="{{url('/brand/show/'.$v->brand_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
    </td>
</tr>

@endforeach
<tr><td colspan="6">{{ $data->links('vendor.pagination.adminbrand') }}</td></tr>
<button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="pil">批量删除</button>
