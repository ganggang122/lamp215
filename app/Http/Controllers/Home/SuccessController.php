<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Address;
use App\Models\Orders;
class SuccessController extends Controller
{
    public  function  index()
    {   
    	 //统计总计价钱
        $zongji = PayController::zongji();
        //统计购物车数量
    	$num  =  ShopcartController::num();
    	//修改订单状态
    	$id = session('home_usersinfo')->id;
    	Orders::where('uid' , $id)->update(['status'=>2]);

    	$id = session('home_usersinfo')->id;
    	$address = Address::where('uid',$id)->where('status',1)->first();
    
        header('refresh:3;url=/home/index');
    
    
        return  view('home.success.index' ,['zongji'=>$zongji,'num'=>$num,'address'=>$address]);
    
    }
}
