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
