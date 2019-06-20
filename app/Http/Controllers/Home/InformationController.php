<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Homeusers;

class InformationController extends Controller
{
    public  function  index()
    {    
        if(!session('home_usersinfo')){
             return redirect('home/login/index');
        }  
        $id  =  session('home_usersinfo')->id;   
        $users_data = Users::select('email' , 'phone' , 'uname')->find($id);
        
    	return view('home.information.index',['users_data'=>$users_data]);
    }


    public function  create(Request  $request)
    { 
           $this->validate($request, [
                'profile' => 'required',
                'nickname' => 'required',
                'uname' => 'required',
                'sex' => 'required',
                'year' => 'required',
                'moth' =>  'required',
                'day' => 'required',
                'phone' => 'required|unique:users|regex:/^1{1}[3-9]{1}[\d]{9}$/',
                'email' => 'required',
                

            ],[ 
            	'nickname.required' =>'昵称必填',
            	'uname.required' => '用户名必填',
                'phone.required'=>'手机号必填',
                'phone.regex'=>'手机号格式错误',
                'year.required' => '所属省份必填',
                'moth.required' => '所属市/直辖市必填',
                'day.required' => '所属市区必填',
                'email.required' => '邮箱必填',
                'sex.required' =>  '性别必填',
                'profile.required' => '头像必填',
                'phone.unique' => '该手机号已经注册'

            ]);


	    
           $nickname = $request->input('nickname' , '');  
           $sex   = $request->input('sex' ,'');
           $uname = $request->input('uname' , '');
           $phone = $request->input('phone' ,'');
           $email = $request->input('email' ,'');
           $year = $request->input('year' ,'');
           $moth = $request->input('moth' ,'');
           $day  = $request->input('day' , '');

           $birth = $year.'年'.$moth.'月'.$day.'日';

           if($request->hasFile('profile')){
           	  $file_path = $request->file('profile')->store(date('Ymd'));
           }else{
           	 $file_path ='/h/images/getAvatar.do.jpg';
           }
           
           $id = session('home_usersinfo')->id;
          $res1 = Users::where('id', $id)->update(['uname'=>$uname ,'phone'=>$phone ,'email'=>$email]);
           
   
            
           $home_usersinfo = new Homeusers;
           $home_usersinfo->uid = $id;
           $home_usersinfo->birth = $birth;
           $home_usersinfo->nickname  = $nickname;
           $home_usersinfo->sex = $sex;
           $home_usersinfo->profile = $file_path;

           $res = $home_usersinfo->save();

           if($res  &&   $res1){
           	return back()->with('success' , '保存成功');
           }else{
           	return back()->with('error' , '保存失败');
           }

 

           
    }
}
