<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;

use App\Models\Shopcart;
class ShopcartController extends Controller
{  
   public  function  store(Request  $request)
   {
      $gid = $request->input('gid',0);
      $gidspec1 = $request->input('gidspec1' , '');
      $gidspec2 = $request->input('gidspec2' , '');
      $gidspecid1 = $request->input('gidspecid1' , 0);
      $gidspecid1 = $request->input('gidspecid2' , 0);

      $shop_data = new Shopcart;
      $shop_data->uid = session('home_usersinfo')->id;
      $shop_data->gid = $gid;
      $shop_data->gidspec1 = $gidspec1;
      $shop_data->gidspec2 = $gidspec2;
      $shop_data->gidspecid1 =  $gidspecid1;
      $shop_data->gidspecid2 =  $gidspecid2;
      $res = $shop_data->save();
      if($res){
          return back()->with('success' , '加入购物车成功');
          exit;
      }else{
         return back()->with('error' , '加入购物车失败');
          exit;

      }
     



   }
   //购物车页面
   public  function  index()
   {
    $prices = self::zongji();
    $goods_data = Shopcart::get();
  
   	return  view('home.shopcart.index',['prices'=>$prices,'goods_data'=>$goods_data,'links'=>IndexController::getLinksData()]);
   }
    //购物车加好计算
   public  function add(Request  $request)
   { 
     $num  = $request->input('num' ,0); //2
     $gid  = $request->input('gid' , 0);
     $pricesold = $request->input('pricesold' , 0);
     session(['pricesold'=>$pricesold]);
     $goods_data = Goods::find($gid);
  
     
      if( session('pricesold') !=0 ){
      	$prices = session('pricesold') + $goods_data->shopPrice;
      }else{
      	 //总计 显示的是2个单品价格
    	   	
      }
     //小计
     $price = $num * $goods_data->shopPrice;
     $price = $price +$goods_data->shopPrice;

     
    
     echo $price.'-'.$prices; 
   }
   //购物车减法计算
   public  function minus(Request  $request)
   { 
     $num  = $request->input('num' ,0); //2
     $gid  = $request->input('gid' , 0);
     $pricesold = $request->input('pricesold' , 0);
     session(['pricesold'=>$pricesold]);
     $goods_data = Goods::find($gid);
  
     
      if( session('pricesold') !=0 ){
        $prices = session('pricesold') - $goods_data->shopPrice;
      }else{
         //总计 显示的是2个单品价格
          
      }
     //小计
     $price = $num * $goods_data->shopPrice;
     $price = $price - $goods_data->shopPrice;

     
    
     echo $price.'-'.$prices; 
   }
   //统计购物车单价总计
   public  static function  zongji()
   {
   	  $goods_data = Goods::get();
      $num = 0;
   	  foreach($goods_data  as  $k=>$v){
         $num +=$v->shopPrice;
   	  }

   	  return $num;
   }


}