@foreach($data as $k=>$v)
    <tr>
        <td><input type="checkbox" name="checkbox2" value="{{$v->brand_id}}"></td>
        <td>{{$v->brand_id}}</td>
        <td id="{{$v->brand_id}}"><span class="oldname brand_name">{{$v->brand_name}}</span></td>
        <td>{{$v->brand_url}}</td>
        <td>
            @if($v->brand_logo)
                <img src="{{$v->brand_logo}}" width="50px" height="50px">
            @endif

        </td>
        <td>{{$v->brand_desc}}</td>
        <td>{{$v->created_at}}</td>
        <td>
            {{--            <a href="{{url('/brand/destroy/'.$v->brand_id)}}">--}}
            <button type="button" class="btn btn-danger" brand_id = "{{$v->brand_id}}">删除</button>
            {{--            </a>--}}
            <a href="{{url('/brand/show/'.$v->brand_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
        </td>
    </tr>

@endforeach
<tr><td colspan="6">{{ $data->links('vendor.pagination.adminbrand') }}</td></tr>
