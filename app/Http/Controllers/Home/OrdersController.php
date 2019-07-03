<?php

namespace App\Http\Controllers\Home;

use App\Models\Orders;
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
        
        // 查询订单所有状态
        // 查询代付款状态
        $orders1 = Orders::where('status',1)->get();
        // 查询已完成付款，代发货的订单
        $orders2 = Orders::where('status',2)->get();
        // 查询待确认收货订单
        $orders3 = Orders::where('status',3)->get();
        // 查询待评价订单
        $orders4 = Orders::where('status',4)->get();
        //查询已完成订单
        $orders5 = Orders::where('status',5)->get();
        
        
        return  view('home.orders.index', [
            'num'=>$num,
            'links'=>IndexController::getLinksData(),
            'orders1'=>$orders1,
            'orders2'=>$orders2,
            'orders3'=>$orders3,
            'orders4'=>$orders4,
            'orders5'=>$orders5,
            
        ]);
        
    }
}
