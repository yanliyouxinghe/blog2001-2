@foreach($data as $k=>$v)
<tr>
    <td><input type="checkbox" name="checkbox2" value="{{$v->weight_id}}"></td>
    <td>{{$v->weight_id}}</td>
    <td id="{{$v->weight_name}}"><span class="oldname weight_name">{{$v->weight_name}}</span></td>
    <td>{{$v->url}}</td>
    <td>{{$v->routename}}</td>

    <td>
{{--            <a href="{{url('/role/destroy/'.$v->role_id)}}">--}}
            <button type="button" class="btn btn-danger" weight_id="{{$v->weight_id}}">删除</button>
{{--            </a>--}}
        <a href="{{url('/brand/show/'.$v->brand_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
    </td>
</tr>

@endforeach
<tr><td colspan="6">{{ $data->links('vendor.pagination.adminbrand') }}</td></tr>
<button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="pil">批量删除</button>
