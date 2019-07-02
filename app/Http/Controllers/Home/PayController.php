<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Address;

use App\Models\Shopcart;
use App\Models\Order;
use App\Models\Goods;
use App\Models\Orders;
use DB;

class PayController extends Controller
{
    //结算页面
    public function index(Request $request)
    {
         //提交购物车ID
         //是个数组
       $sid = $request->input('shopid' , 0);

       $shopid = $request->input('shopid',0);
       
       $goodnum = $request->input('goodnum' , 0);
       $goodsprice = $request->input('goodsprice' , 0);
       $goodid = $request->input('goodid' , 0);
       $specName1 = $request->input('specName1' , 0);
       $specName2 = $request->input('specName2'  , 0);
       //判断sid是否已经存入,如果没有的话再压入
       //sid代表购物车id
       $good_id =  Orders::select('sid')->get();
       $goodid_data = [];
        foreach($good_id as  $k=>$v){
         	$goodid_data[] =  (string)$v->sid;
         }
        
        

  	$order_data = [];
    foreach($shopid as  $k=>$v){
    	if(!in_array( $v, $goodid_data)){
    	 array_push($order_data,[
       	'uid' => session('home_usersinfo')->id,
        'sid' => $shopid[$k],
       	'goodnum' => $goodnum[$k],
       	'goodsprice' => $goodsprice[$k],
       	'gid' => $goodid[$k],
       	'specname1' => $specName1[$k],
       	'specname2' => $specName2[$k],
          ]);
         Orders::insert($order_data);

    		
        }

       }  
       
       

       
        
       //统计总计价钱
       $zongji = ShopcartController::zongji();

       $uid = session('home_usersinfo')->id;
       $address_data = Address::where('uid',$uid)->get();

        //统计购物车数量
      $num  =  ShopcartController::num();
      $shop = Orders::where('uid',$uid)->get();

      return  view('home.pay.index' , ['num'=>$num,'address_data' => $address_data,'shop'=>$shop,'zongji'=>$zongji]);
    }
    
}
