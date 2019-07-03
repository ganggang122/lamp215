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
        
        
   //压入订单数据
  	$order_data = [];
    foreach($shopid as  $k=>$v){
    	if(!in_array( $v, $goodid_data)){
    	 array_push($order_data,[
       	'uid' => session('home_usersinfo')->id,
        'sid' => $shopid[$k],
       	'goodnum' => $goodnum[$k],
       	'goodsprice' => $goodsprice[$k],
       	'status' => 1,
       	'gid' => $goodid[$k],
       	'specname1' => $specName1[$k],
       	'specname2' => $specName2[$k],
          ]);
         Orders::insert($order_data);


        }
        Shopcart::destroy($v);

       }  
       
       

       
        


       //统计总计价钱
       $zongji =self::zongji();
     

   	

       $uid = session('home_usersinfo')->id;
       $address_data = Address::where('uid',$uid)->get();

        //统计购物车数量
      $num  =  ShopcartController::num();
      $shop = Orders::where('uid',$uid)->where('status' ,1)->get();
       if($shop->isEmpty()){
    	echo  "<script>alert('订单为空,请先购物');location.href='/home/index'</script>";
    }

      return  view('home.pay.index' , ['num'=>$num,'address_data' => $address_data,'shop'=>$shop,'zongji'=>$zongji]);
    }


    public  static function  zongji()
    {
      $uid = session('home_usersinfo')->id;
   	  $goods_data = Orders::where('uid',$uid)->where('status' ,1)->get();
      $num = 0;
   	  foreach($goods_data  as  $k=>$v){
         $num +=$v->goodnum * $v->goodsprice;
   	  }
   	    return $num;
    }

    
    
    public function create(Request $request)
    {
        
        //获取数据
        $gid = $request->input('gid', 0);
        // 用户id
        $uid = session('home_usersinfo')->id;
        // 商品价格
        $goodsprice = $request->input('shopPrice', 0);
        // 商品数量
        $num = $request->input('num', 0);
        // 商品规格名称1
        $specName1 = $request->input('specName1', '');
        // 商品规格值1
        $specValue1 = $request->input('specValue1', '');
        // 商品规格名称2
        $specName2 = $request->input('specName2', '');
        // 商品规格值2
        $specValue2 = $request->input('specValue2', '');
    
        $orders = new Orders();
    
        $orders->gid = $gid;
        $orders->uid = $uid;
        $orders->goodsprice = $goodsprice;
        $orders->goodnum = $num;
        // 拼接商品规格1
        $orders->specname1 = $specName1.':'.$specValue1;
        
        // 拼接商品规格2
        $orders->specname2 = $specName2 . ':' . $specValue2;
        // 订单状态
        $orders->status = 1;
        // 存入订单
        $orders->save();
    
        $uid = session('home_usersinfo')->id;
        $address_data = Address::where('uid',$uid)->get();
    
        $shop = Orders::where('uid',$uid)->get();
        
        // 合计
        $zongji =  $goodsprice * $num;
        
        return view('home.pay.index',[
            'shop' => $shop,
            'address_data' => $address_data,
            'num' => $num,
            'zongji' => $zongji,
            
            
        ]);
    
        
    
    }
    

}
