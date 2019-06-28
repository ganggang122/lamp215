<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use  App\Models\Users;
use  Hash;
use  App\Models\UserInfo;

class LoginController extends Controller
{
	//登录页面
    public  function index()
    {
    	return view('home.login.index');
    }
    

    //执行登录操作
    public  function dologin(Request $request)
    {
         $this->validate($request, [
                'uname' => 'required',
                'upass' => 'required|regex:/^[\w]{6,18}$/',
            ],[ 
            	'uname.required' => '用户名必填',
                'upass.required'=>'密码必填',
                'upass.regex'=>'密码格式错误',
            ]);
         $users_name = $request->input('uname' ,'');
         $users_upass = $request->input('upass' , '');
         

         $users_data =Users::where('uname' , $users_name)->orwhere('email' , $users_name)->orwhere('phone',$users_name)->first();
         
         $upass =  $users_data->upass;
         
         if(!Hash::check($users_upass,$upass)){
            return  back()->with('error' , '用户名或者密码错误');
            exit;
         }

         if($users_data->status == 0){
            return  back()->with('error' , '账号未激活');
            exit;
         }
        
     	session(['home_usersinfo'=>$users_data]);
     	session(['users_status'=>true]);
     	$id = session('home_usersinfo')->id;
     	$uid_data =UserInfo::select('uid')->get();
        $data = [];
     	foreach($uid_data as  $k=>$v){
         	$data[] = $v->uid;
         }

         if(!in_array($id , $data)){
           $users_data = new UserInfo;
      	   $users_data->uid = session('home_usersinfo')->id;
      	   $users_data->save();
      	   return  redirect('home/index');
         }else{
      	

     	  return  redirect('home/index');
 
       }
    }

    //用户退出
    public  function  logout()
    {
        session(['home_usersinfo'=>false]);
     	session(['users_status'=>false]);
     	return  back();
 
       
    }

}
