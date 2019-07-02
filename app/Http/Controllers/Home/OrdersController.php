<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    //加载订单页面
    public function index()
    {
        if(!session('home_usersinfo')){
            return redirect('home/login/index');
        }
        //统计购物车数量
        $num  =  ShopcartController::num();
        return  view('home.orders.index', ['num'=>$num,'links'=>IndexController::getLinksData()]);
        
    }
}
