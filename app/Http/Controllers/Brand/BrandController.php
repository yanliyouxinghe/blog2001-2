<?php
namespace App\Http\Controllers\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Brand;
class BrandController extends Controller
{
    /**
     * Display a listing of thxe resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        new
        $brandModel = new Brand();
        $data = $brandModel->paginate(3);
        if (Request()->ajax()){
            return view('brand.ajaxpage', ['data' => $data]);
        }

//        dd($data);
        return view('brand.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $post = $request->except('_token');
        //post接值
        $brand_name = $request->input('brand_name');
        $brand_url = $request->input('brand_url');
        $brand_logo = $request->input('brand_logo');
//        dd($brand_logo);
        $brand_desc = $request->input('brand_desc');
        // 后台非空验证
        if (empty($brand_name) || empty($brand_url) || empty($brand_logo)) {
            return redirect('/brand/create')->with('msg', '必填项不能为空');
            die;
        }
        //new model
        $brandModel = new Brand();
        //唯一性验证
        $ret_name = $brandModel::where('brand_name', $brand_name)->first();
        $ret_url = $brandModel::where('brand_url', $brand_url)->first();

        if ($ret_name) {
            return redirect('/brand/create')->with('msg', '此品牌名称已存在，请重新添加');
            die;
        } else if ($ret_url) {
            return redirect('/brand/create')->with('msg', '此品牌网址已存在，请添加不存在的品牌网址');
            die;
        }
        //需要添加的数据
        $data = [
            'brand_name' => $brand_name,
            'brand_url' => $brand_url,
             'brand_logo' => env('APP_URL').$brand_logo,
            'brand_desc' => $brand_desc,
        ];
        //执行添加
        $res = $brandModel->create($data);
        if ($res) {
            //添加成功
            echo '<script>alert("添加成功，正在为您跳至列表页....");location.href="/brand/list"</script>';
            die;
        } else {
            //添加失败
            return redirect('/brand/create')->with('msg', '操作繁忙，请稍后重试...');
            die;
        }

    }

    //文件上传

    public function uploads(Request $request)
    {
        //接收文件上传的值
        $photo = $request->file();
        //判断文件上传是否有文件或者有没有出错
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $photo = $request->file('file');
//        dd($photo);
        //文件上传
        $store_result = $photo->store("upload");
            $store_results = '/'.$store_result;
        //返回json
//            dd($store_result);die;
            return $this->JsonResponse('0','上传成功',$store_results);
        }
        return $this->JsonResponse('1','文件上传失败');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brandModel = new Brand();
        $data = $brandModel->where('brand_id',$id)->first();
//        dd($data);
        return view('brand.update',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // $post = $request->except('_token');
        //post接值
        $brand_name = $request->input('brand_name');
        $brand_url = $request->input('brand_url');
        $brand_logo = $request->input('brand_logo');
        $brand_desc = $request->input('brand_desc');

        if (empty($brand_name) || empty($brand_url) || empty($brand_logo)) {
            return redirect('/brand/show/'.$id)->with('msg', '必填项不能为空');
            die;
        }
        //new model
        $brandModel = new Brand();
        //唯一性验证
        $ret_name = $brandModel::where('brand_name', $brand_name)->count();
        $ret_url = $brandModel::where('brand_url', $brand_url)->count();
        if ($ret_name > 1) {
            return redirect('/brand/show/'.$id)->with('msg', '此品牌名称已存在，请重新添加');
            die;
        } else if ($ret_url > 1) {
            return redirect('/brand/show/'.$id)->with('msg', '此品牌网址已存在，请添加不存在的品牌网址');
            die;
        }

        //需要修改的数据
        $data = [
            'brand_name' => $brand_name,
            'brand_url' => $brand_url,
            'brand_logo' => env('APP_URL').$brand_logo,
            'brand_desc' => $brand_desc,
        ];
        //执行添加
        $res = $brandModel->where('brand_id',$id)->update($data);
        if ($res) {
            //添加成功
            echo '<script>alert("修改成功，正在为您跳至列表页....");location.href="/brand/list"</script>';
            die;
        } else {
            //添加失败
            return redirect('/brand/show/'.$id)->with('msg', '操作繁忙，请稍后重试...');
            die;
        }


//        dd($brand_logo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
//        $brand_id = $request->input('id');
        $ids = Request()->all();
        if(!$ids){
            return $this->JsonResponse('11','请选择要删除的数据');
        }
        foreach ($ids as $k=>$v){
            $isdel = brand::destroy($v);
        }
//        dd($isdel);
        if($isdel){
            return $this->JsonResponse('0','OK');
        }else{
            return $this->JsonResponse('1','删除失败');
        }
    }

    //即点即该
    public function updated(Request $request){
        $brand_id = $request->input('brand_id');
        $brand_name = $request->input('brand_name');
//        dd($brand_names);
        if(!$brand_id || !$brand_name){
            return $this->JsonResponse('22','操作繁忙，请稍后重试');
        }
        $ret = Brand::where('brand_id',$brand_id)->update(['brand_name'=>$brand_name]);
//        dd($ret);
        if($ret==1){
//            return json_encode(['code'=>0,'msg'=>'修改成功']);die;
            return $this->JsonResponse('0','修改成功');
        }else{
            return $this->JsonResponse('33','操作繁忙，请稍后重试');
        }

    }
}
