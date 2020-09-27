<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
class LoginController extends Controller
{
    public function login(){
      return view('login');
    }

    public function logindo(){
      $admin_user = Request()->input('admin_user');
      $admin_pwd = Request()->input('admin_pwd');

      if(empty($admin_user) || empty($admin_pwd)){
          return redirect('login')->with('msg','用户名或密码不能为空');die;
      }
      $ret = Admin::where('admin_user',$admin_user)->first();
      if(!$ret){
          return redirect('login')->with('msg','账号或密码错误');die;
      }
      if(password_verify($admin_pwd,$ret->admin_pwd)){
              session(['admin_user' => $ret->admin_user,'admin_user_id'=>$ret->admin_user_id]);
              // $admin_user = Request()->session()->get('admin_user');
              // dd($admin_user);
              return redirect('/brand/list');die;
      }else{
            return redirect('login')->with('msg','账号或密码错误');die;
      }
    }

    public function logout(){
      Request()->session()->flush();
      $admin_user = Request()->session()->get('admin_user');
      if(!$admin_user){
          return redirect('login');die;
      }
      echo '<script>alert("操作繁忙，请稍后重试....");location.href="/brand/list"</script>';
      die;
    }
}
