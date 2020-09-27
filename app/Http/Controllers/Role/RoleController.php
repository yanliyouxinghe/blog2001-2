<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $soleModel = new Role();
      $data = $soleModel->orderBy('role_id','desc')->paginate(3);
      if (Request()->ajax()){
          return view('role.ajaxpage', ['data' => $data]);
      }

       // dd($data);
      return view('role.list', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sole_name =  $request->input('role_name');
          $sole_desc =  $request->input('role_desc');
          if(empty($sole_name) || empty($sole_desc)){
            return redirect('/role/create')->with('msg', '必填项不能为空');
            die;
          }
          $soleModel = new Role();
          //唯一性验证
          $ret_name = $soleModel::where('role_name', $sole_name)->first();
          if ($ret_name) {
              return redirect('/role/create')->with('msg', '此角色已存在，请重新添加');
              die;
          }
          //需要添加的数据
          $data = [
              'role_name' => $sole_name,
              'role_desc' => $sole_desc
          ];
          //执行添加
          $res = $soleModel->create($data);
          if ($res) {
              //添加成功
              echo '<script>alert("添加成功，正在为您跳至列表页....");location.href="/role/list"</script>';
              die;
          } else {
              //添加失败
              return redirect('/role/create ')->with('msg', '操作繁忙，请稍后重试...');
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
          $ids = Request()->all();
          if(!$ids){
              return $this->JsonResponse('11','请选择要删除的数据');
          }
          foreach ($ids as $k=>$v){
              $isdel = Role::destroy($v);
          }
  //        dd($isdel);
          if($isdel){
              return $this->JsonResponse('0','OK');
          }else{
              return $this->JsonResponse('1','删除失败');
          }
    }


}
