<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Users;

class EmailController extends Controller
{
    public  function  index()
    {     
    	//统计购物车数量
         $num  =  ShopcartController::num();
    	 return  view('home.resgister.email',['num'=>$num,'links'=>IndexController::getLinksData()]);
    }

    public  function  storemail(Request  $request)
    {
    	 

         $email = $request->input('email' ,'');
         $email_data = Users::select('email')->get();
         $data = [];
         foreach($email_data as  $k=>$v){
         	$data[] = $v->email;
         }

         if(in_array($email , $data)){
         	echo json_encode(['msg'=>'error' , 'info'=>'该邮箱已经被注册']);
            exit;
         }else{
         	 $uid = session('home_usersinfo')->id;
	         $res =  Users::where('id',$uid)->update(['email'=>$email]);
	         if($res){
	         	echo json_encode(['msg'=>'success' , 'info'=>'绑定成功']);
	            exit;
	         }else{
	         	echo json_encode(['msg'=>'error' , 'info'=>'绑定失败']);
	            exit;
         }
         }
        
         
    }
    public  function  phone()
    {   
    	 //统计购物车数量
         $num  =  ShopcartController::num();
    	return  view('home.resgister.phone',['num'=>$num,'links'=>IndexController::getLinksData()]);
    }

    public  function storephone(Request $request)
    {
    	 $phone = $request->input('phone' ,'');
         $phone_data = Users::select('phone')->get();
         $data = [];
         foreach($phone_data as  $k=>$v){
         	$data[] = $v->phone;
         }

         if(in_array($phone , $data)){
         	echo json_encode(['msg'=>'error' , 'info'=>'该手机号已经被注册']);
            exit;
         }else{
         	 $uid =  session('home_usersinfo')->id;
	         $res =  Users::where('id',$uid)->update(['phone'=>$phone]);
	         if($res){
	         	echo json_encode(['msg'=>'success' , 'info'=>'绑定成功']);
	            exit;
	         }else{
	         	echo json_encode(['msg'=>'error' , 'info'=>'绑定失败']);
	            exit;
         }
         }
    }
}
