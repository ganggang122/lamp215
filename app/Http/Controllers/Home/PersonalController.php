<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class PersonalController extends Controller
{
    //个人中心
    public  function  index()
    {
    	 //统计购物车数量
        $num  =  ShopcartController::num();
    	return  view('home.personal.index',['num'=>$num,'links'=>IndexController::getLinksData()]);
    }
}
