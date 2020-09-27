@foreach($data as $k=>$v)
    <tr>
        <td><input type="checkbox" name="checkbox2" value="{{$v->cat_id}}"></td>
        <td>{{$v->cat_id}}</td>
        <td id="{{$v->cat_name}}"><span class="oldname role_name">{{$v->cat_name}}</span></td>
        <td>
                <button type="button" class="btn btn-default">编辑</button>
                <button type="button" class="btn btn-danger" cat_id="{{$v->cat_id}}">删除</button>

            <a href="{{url('/goodstype/proplist/'.$v->cat_id)}}"><button type="button" class="btn btn-info">属性列表</button></a>



        </td>
    </tr>

    @endforeach
    <tr><td colspan="6">{{ $data->links('vendor.pagination.adminbrand') }}</td></tr>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="pil">批量删除</button>