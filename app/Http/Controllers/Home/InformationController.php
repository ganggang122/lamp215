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
        //统计购物车数量
        $num  =  ShopcartController::num();  
        $id  =  session('home_usersinfo')->id;   
        $users_data = Users::select('email' , 'phone' , 'uname')->find($id);
        
    	return view('home.information.index',['num'=> $num,'users_data'=>$users_data]);
    }


    public function  create(Request  $request)
    { 
           $this->validate($request, [
                'profile' => 'required',
                'nickname' => 'required',
                'uname' => 'required|unique:users|regex:/^[\w]{6,32}$/',
                'sex' => 'required',
                'year' => 'required',
                'moth' =>  'required',
                'day' => 'required',
                
                

            ],[ 
            	'nickname.required' =>'昵称必填',
            	'uname.required' => '用户名必填',
                'uname.unique' => '用户名已存在',
                'year.required' => '所属年必填',
                'moth.required' => '所属月必填',
                'day.required' => '所属日必填',
                
                'sex.required' =>  '性别必填',
                'profile.required' => '头像必填',
                

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
           $res1 = Users::where('id', $id)->update(['uname'=>$uname]);
           
   
            
           $home_usersinfo = new Homeusers;
           $home_usersinfo->uid = $id;
           Homeusers::where('uid',$id)->update(['birth'=>$birth]);
           Homeusers::where('uid',$id)->update(['nickname'=>$nickname]);
  
           Homeusers::where('uid',$id)->update(['sex'=>$sex]);
  
           Homeusers::where('uid',$id)->update(['profile'=>$file_path]);
           

          

           if($res1){
           	return back()->with('success' , '保存成功');
           }else{
           	return back()->with('error' , '保存失败');
           }

 

           
    }
}
