<?php

namespace App\Http\Middleware;
use Illuminate\Routing\Route;
use Closure;
use App\Model\UserRole;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

        $admin_user = Request()->session()->get('admin_user');
        $admin_user_id = Request()->session()->get('admin_user_id');

        if(!$admin_user){
            return redirect('login');die;
        }
        //获取别名
        // $routeAction = Route::getActionName();
        // print_r($routeAction);die;

        // $role = UserRole::where('admin_user_id',$admin_user)8

        return $next($request);
    }
}
