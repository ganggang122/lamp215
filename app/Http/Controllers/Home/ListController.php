<?php

namespace App\Http\Controllers\Home;

use App\Models\Goods;
use App\Models\Cate;
use App\Models\Brands;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
	

	public static function getBrands($cid)
	{
		//获取二级分类
   		$cate = Cate::where('id',$cid)->first();
   		$id = $cate->pid;
   		$cate_data = Cate::where('id',$id)->first();
   		//获取一级分类
   		$id = $cate_data->pid;
   		$cate_first_data = Cate::where('id',$id)->first();
   		//获取一级分类id
   		$id = $cate_first_data->id;
   		$brands = Brands::where('cid',$id)->get();
   		return $brands;
	}

   //商品列表页
   public function index(Request $request,$cid,$id)
   {
    // $search = $request->input('search','');
      if ($id && $cid) {
         if ($id == 'n') {
          // 查询对应分类下，上架的商品
          $goods = Goods::where('cid', $cid)->where('goodsStatus', 1)->get();
             /*foreach ($goods as $k => $v) {
                 $shopPrice  = explode(',', $v->shopPrice);
                 $shopPrice = $shopPrice[0];
    
             }*/
    
         } else {
          $goods = Goods::where('cid', $cid)->where('bid',$id)->where('goodsStatus', 1)->get();
         }
   		} else {
         $goods = SearchController::getData();
      }
     

   		 $links = IndexController::getLinksData();

   		

   		    
       	
   			 
      //统计购物车数量
         $num  =  ShopcartController::num();
       return view('home.list.index',['num'=>$num,'goods'=>$goods,'brands'=>self::getBrands($cid),'cid'=>$cid,'links'=>$links]);

       return view('home.list.index',[
            'num'=>$num ,
           'goods'=>$goods,
           'brands'=>self::getBrands($cid),
           'cid'=>$cid,
       ]);

   }
   
  
}
