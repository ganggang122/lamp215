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
use App\Models\Users;
use App\Models\Collect;
class GoodsController extends Controller
{
    public function index($id)
    {
        $good = Goods::where('id', $id)->first();
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
        
        //获取用户id
        $uid = 2;
        //获取商品id
        $gid = $good->id;
        //获取用户信息
        $user = Users::where('id',$uid)->first();
        //获取该用户收藏的所有商品id
        $user_gids = $user->userCollect;
        //将该用户的收藏商品id 存到同一数组
        $collects = [];
        foreach($user_gids as $v){
            $collects[] = $v->gid;
        }
        //判断当前商品是否被收藏
        $collect = in_array($gid,$collects);        
        return view('home.goods.index', [
            'good'=>$good,
            'specName1'  => $sepcName1,
            'specName2'  => $sepcName2,
            'specValue1' => $specValue1,
            'specValue2' => $specValue2,
            'collect'    => $collect,
        ]);
    }
}