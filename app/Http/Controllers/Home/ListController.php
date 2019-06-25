<?php

namespace App\Http\Controllers\Home;

use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
   //商品列表页
   public function index($cid)
   {
     // 查询对应分类下，上架的商品
       $goods = Goods::where('cid', $cid)->where('goodsStatus', 1)->get();
       
       
       return view('home.list.index',['goods'=>$goods]);
   }
}
