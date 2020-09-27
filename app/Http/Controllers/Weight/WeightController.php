<?php

namespace App\Http\Controllers\Weight;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Weight;
use App\Model\RoleWeight;
class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $WeightModel = new Weight();
    $data = $WeightModel->orderBy('weight_id','desc')->paginate(3);
    if (Request()->ajax()){
        return view('weight.ajaxpage', ['data' => $data]);
    }
     // dd($data);
    return view('weight.list', ['data' => $data]);
    }

    public function addpriv($id){
      // dd($id);
      $WeightModel = new Weight();
      $data = $WeightModel->orderBy('weight_id','asc')->get();
      $weight_list =  $this->weightTree($data);
        // dd($weight_list);
      return view('weight.addpriv',['weight_list'=>$weight_list,'role_id'=>$id]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $data = Weight::all();
         $weight_list =  $this->weightTree($data);
         // print_r($weight_list);die;
          return view('weight.create',['weight_list'=>$weight_list]);
    }

    public function weightTree($data,$p_id=0,$level=0){
        if(!$data){
            return;
        }
       static  $res = [];
        foreach ($data as $key => $value) {
          if($value['p_id'] == $p_id){
              $value['level'] = $level;
              $res[] = $value;
              $this->weightTree($data,$value['weight_id'],$level+1);
          }
        }
        return $res;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $weight_name =  $request->input('weight_name');
        $url =  $request->input('url');
          $routename =  $request->input('routename');

        if(empty($weight_name) || empty($url) || empty($routename)){
          return redirect('/weight/create')->with('msg', '必填项不能为空');
          die;
        }

        $WeightModel = new Weight();
        //唯一性验证
        $ret_name = $WeightModel::where('weight_name', $weight_name)->first();


        if ($ret_name) {
            return redirect('/weight/create')->with('msg', '此角色已存在，请重新添加');
            die;
        }
        //需要添加的数据
        $data = [
            'weight_name' => $weight_name,
            'url' => $url,
            'routename' => $routename,

        ];
        //执行添加
        $res = $WeightModel->create($data);
        if ($res) {
            //添加成功
            echo '<script>alert("添加成功，正在为您跳至列表页....");location.href="/weight/list"</script>';
            die;
        } else {
            //添加失败
            return redirect('/weight/create ')->with('msg', '操作繁忙，请稍后重试...');
            die;
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $ids = Request()->all();
      // $ids = Request()->all();
      // dd($ids);
      if(!$ids){
          return $this->JsonResponse('11','请选择要删除的数据');
      }
      foreach ($ids as $k=>$v){
          $isdel = Weight::destroy($v);
      }
//        dd($isdel);
      if($isdel){
          return $this->JsonResponse('0','OK');
      }else{
          return $this->JsonResponse('1','删除失败');
      }
    }


    public function addweight(Request $request){
      $role_id = $request->input('role_id');
      $arr = $request->input('arr');
      // dump($role_id);
      // dd($arr);
      if(empty($arr) || empty($role_id)){
          return $this->JsonResponse('12','操作繁忙，请稍后重试');
      }
        $data = [];
        foreach ($arr as $key => $value) {
          // dump($value);
          $data['role_id'] = $role_id;
          $data['weight_id'] = $value;
         $addweight =  RoleWeight::create($data);
        }
        if($addweight){
          return $this->JsonResponse('0','OK');
        }else{
          return $this->JsonResponse('14','操作繁忙，请稍后重试');
        }

    }


}
