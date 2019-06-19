<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin_user;
use Hash;
use DB;
class LoginController extends Controller
{
	//后台 登录 页面
    public function login()
    {
    	return view('admin.login.login');    	
    }

    public function dologin(Request $request)
    {
    	//接收数据
    	$uname = $request->input('uname','');
    	$upass = $request->input('upass','');
    	//根据 用户名 查询是否存在用户
    	$admin_user = Admin_user::where('uname',$uname)->first();
    	if ( empty($admin_user)) {
    		return back()->with('error','用户名或密码错误');
    	}
    	//判断密码是否正确
    	if ( !Hash::check($upass, $admin_user->upass)) {
    		return back()->with('error','用户名或密码错误');		  	
		}

		session(['admin_user_flag'=>true]);
		session(['admin_user_info'=>$admin_user]);
        $uid = $admin_user->id;
        //查询用户的后台权限
        $admin_user_nodes =  DB::select(' select cname,aname from node as n,aduser_role as adro,role_node as rono where adro.uid = '.$uid.' and adro.rid= rono.rid and rono.nid = n.id;');
		session(['admin_user_nodes'=>$admin_user_nodes]);
        return redirect('admin');
    }

    //退出登录
    public function logout()
    {
        session(['admin_user_flag'=>false]);
        session(['admin_user_info'=>null]);
        return redirect('/admin/login');
    }

}
