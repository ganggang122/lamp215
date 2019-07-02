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
       $gid = $request->input('id',0);
       $shopPrice = $request->input('shopPrice', 0);
       $num = $request->input('num', 0);
       $specName1 = $request->input('specName1' , '');
       $specValue1 = $request->input('specValue1' , '');
       $specName2 = $request->input('specName2' , '');
       $specValue2 = $request->input('specValue2' , '');

      $shop_data = new Shopcart;
      // $shop_data->uid = session('home_usersinfo')->id;
      $shop_data->gid = $gid;
      $shop_data->num = $num;
      $shop_data->shopPrice = $shopPrice;
      $shop_data->specName1 = $specName1;
      $shop_data->specValue1 = $specValue1;
      $shop_data->specName2 =  $specName2;
      $shop_data->specValue2 =  $specValue2;
      $res = $shop_data->save();
      
      if($res){
          echo  json_encode(['msg'=>'success' , 'info'=>'加入购物车成功']);
          exit;
       /* $data['error'] = 0;
        $data['msg']   = '加入购物车成功';*/
      }else{
          echo  json_encode(['msg'=>'error' , 'info'=>'加入购物车失败']);
          exit;
         /* $data['error'] = 1;
          $data['msg']   = '加入购物车失败';*/
      }
   }
   //购物车页面
   public  function  index()
   {
    $prices = self::zongji();
    $uid = session('home_usersinfo')->id;
    $goods_data = Shopcart::where('uid',$uid)->get();

    
   	return  view('home.shopcart.index',['prices'=>$prices,'goods_data'=>$goods_data,'links'=>IndexController::getLinksData()]);
   }
    //购物车加好计算
   public  function add(Request  $request)
   { 
     $num  = $request->input('num' ,0); //2
     $gid  = $request->input('gid' , 0);
     $id   = $request->input('id' ,0);
     $pricesold = $request->input('pricesold' , 0);

     session(['pricesold'=>$pricesold]);
     $goods_data = Shopcart::find($id);
  
     
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
   	  $uid = session('home_usersinfo')->id;
   	  $goods_data = Shopcart::where('uid',$uid)->get();
      $num = 0;
   	  foreach($goods_data  as  $k=>$v){
         $num +=$v->shopPrice;
   	  }

   	  return $num;
   }


}
