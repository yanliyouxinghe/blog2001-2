<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
use App\Model\Role;
use App\Model\UserRole;
use DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $AdminModel = new Admin();
    $data = $AdminModel->orderBy('admin_user_id','desc')->paginate(3);
    if (Request()->ajax()){
        return view('admin.ajaxpage', ['data' => $data]);
    }
     // dd($data);
    return view('admin.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $role = Role::all();
          return view('admin.create',['role'=>$role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
          $admin_user =  $request->input('admin_user');
            $admin_pwd =  $request->input('admin_pwd');
              $admin_plone =  $request->input('admin_plone');
              $role_id = $request->input('role');
              if(empty($role_id)){
                return redirect('/admin/create')->with('msg', '请选择角色');
                die;
              }
              // dd($role_id);
            if(empty($admin_user) || empty($admin_pwd) || empty($admin_plone)){
              return redirect('/admin/create')->with('msg', '必填项不能为空');
              die;
            }

            $AdminModel = new Admin();
            //唯一性验证
            $ret_name = $AdminModel::where('admin_user', $admin_user)->first();
            $ret_plone = $AdminModel::where('admin_plone', $admin_plone)->first();

            if ($ret_name) {
                return redirect('/admin/create')->with('msg', '管理员已存在，请重新添加');
                die;
            }

            if ($ret_plone) {
                return redirect('/admin/create')->with('msg', '手机号码已存在，请重新添加');
                die;
            }
            //需要添加的数据
            $data = [
                'admin_user' => $admin_user,
                'admin_pwd' => password_hash($admin_pwd,PASSWORD_DEFAULT),
                'admin_plone' => $admin_plone,
            ];
            //执行添加
            $res = $AdminModel->create($data);
            $admin_user_id = $res->admin_user_id;
            $data = [];
            if($admin_user_id){
                foreach ($role_id as $key => $value) {
                    $data['admin_user_id'] = $admin_user_id;
                    $data['role_id'] = $value;
                    UserRole::create($data);
                }
            }
            DB::commit();
            //添加成功
            // echo "456";die;
            echo '<script>alert("添加成功，正在为您跳至列表页....");location.href="/admin/list"</script>';
            die;
        } catch (\Exception $e) {
          DB::rollback();
          // echo "1111";die;
          return redirect('/admin/create ')->with('msg', '操作繁忙，请稍后重试...');
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
          $isdel = Admin::destroy($v);
      }
//        dd($isdel);
      if($isdel){
          return $this->JsonResponse('0','OK');
      }else{
          return $this->JsonResponse('1','删除失败');
      }
    }
}
