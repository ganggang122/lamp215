<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/25
 * Time: 16:06
 */

namespace App\Http\Controllers\Home;
use App\Models\Cate;
use App\Models\Goods;
use App\Models\Specific;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function index($id)
    {
        $good = Goods::where('id', $id)->first();
        // 组合商品店铺价格
        $len = strlen($good->shopPrice);
        if ($len > 8) {
            $shopPrice = explode(',',$good->shopPrice);
    
            $shopPrice = $shopPrice[0].'-'.$shopPrice[2];
    
        }else{
            $shopPrice = $good->shopPrice;
        }
        
        
        // 查询商品下的规格名称
        $path = Cate::find($good->cid)->path;
        $pid = (int)explode(',', $path)[1];
//        返回商品规格名称
        $specName = Specific::where('cid', $pid)->get();
        // 第一个商品属性名
        $sepcName1 = $specName[0]->specname;
        // 第二个商品属性名
        $sepcName2 = $specName[1]->specname;
        // 查询商品下的规格值
        $specValue1 = $good->goodsinfo['specName1'];
        $specValue1 = explode( ',', $specValue1);
    
        $specValue2 = $good->goodsinfo['specName2'];
        $specValue2 = explode( ',', $specValue2);
       
        return view('home.goods.index', [
            'good'=>$good,
            'shopPrice' => $shopPrice,
            'specName1'  => $sepcName1,
            'specName2'  => $sepcName2,
            'specValue1' => $specValue1,
            'specValue2' => $specValue2,
        ]);
    }
}