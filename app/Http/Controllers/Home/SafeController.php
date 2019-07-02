<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Hash;

class SafeController extends Controller
{
    public  function  index()
    {
    	if(!session('home_usersinfo')){
    		return redirect('home/login/index');
    	}
    	 //统计购物车数量
        $num  =  ShopcartController::num();
    	return  view('home.safe.index', ['num'=>$num,'links'=>IndexController::getLinksData()]);
    }

    public  function  update(Request  $request)
    {
        $oldupass = $request->input('oldupass' ,'');
        $newupass = $request->input('newupass' ,'');
        $id = session('home_usersinfo')->id;	
        $users_data = Users::find($id);
       
        if(!Hash::check($oldupass,$users_data->upass)){
        	echo  json_encode(['msg'=>'error' , 'info'=>'修改失败']);
        	exit;
        }
        $newupass = Hash::make($newupass);
        $res = Users::where('id',$id)->update(['upass'=>$newupass]); 

        if($res){
        	echo  json_encode(['msg'=>'error' , 'info'=>'修改成功']);
        	exit;
        }

        
    }
}
