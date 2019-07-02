<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Address;
class SuccessController extends Controller
{
    public  function  index()
    {   
    	 //统计总计价钱
        $zongji = ShopcartController::zongji();
        //统计购物车数量
    	$num  =  ShopcartController::num();
    	$id = session('home_usersinfo')->id;
    	$address = Address::where('uid',$id)->where('status',1)->first();
    	

    	return  view('home.success.index' ,['zongji'=>$zongji,'num'=>$num,'address'=>$address]);
    }
}
