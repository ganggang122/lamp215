<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use DB;
use App\Models\Collect;
class CollectController extends Controller
{
    //收藏夹首页
    public function index()
    {
    	//获取用户id
        $uid = 12;
        //获取用户信息
        $user = Users::where('id',$uid)->first();
        //获取该用户收藏的所有商品id
        $user_gids = $user->userCollect;
        //将该用户的收藏商品id 存到同一数组
        $collects = [];
        foreach($user_gids as $v){
            $collects[] = $v->gid;
        }
        //获取所有收藏商品的详细信息
        $goods = DB::table('goods')->whereIn('id',$collects)->get();
		return view('home.collect.index',['goods'=>$goods]);
    }

    //删除收藏
    public function del(Request $request)
    {
    	//获取用户id
    	// $user = session('home_usersinfo');
    	// $uid = $user->id;
    	$uid = 18;
    	//接收商品id
    	$gid =  $request->input('id');
    	//从 collect表中删除数据
    	$res = DB::table('collect')->where([['uid',$uid],['gid',$gid]])->delete();
    	if ($res) {
    		return back();
    	} else {
    		return back();
    	}

    }

    //商品详情页 点击添加 收藏 功能
     public function collect(Request $request)
    {
    	//先判断是否登录
    	//接收商品id
    	$gid = $request->input('gid');
    	//获取用户id  应该从session的用户信息中获取
    	$uid = 12;
    	//获取该用户所有收藏商品的id
    	$user = Users::where('id',$uid)->first();
    	$user_gids = $user->userCollect;
    	//将该用户的收藏商品id 存到同一数组
    	$collects = [];
    	foreach($user_gids as $v){
    		$collects[] = $v->gid;
    	}

        //本次 收藏商品 gid未在该数组就插入uid gid到collect表--添加收藏 否则删除--取消收藏
    	if( !in_array($gid,$collects) ){
    		//插入数据到 collect表 即保存该用户的id 与 商品的id
    		$store = new Collect;
    		$store->uid = $uid;
    		$store->gid = $gid;
    		$store->save();
    		echo json_encode('ok');
<<<<<<< HEAD
    		die;
=======
    		exit;
>>>>>>> origin/lx
    	} else {
    		$res = Collect::where(['uid'=>$uid,'gid'=>$gid])->forceDelete();
    		if ($res) {
    			echo json_encode('del');
<<<<<<< HEAD
    			die;
=======
    			exit;
>>>>>>> origin/lx
    		}
    	}
    }
   
}
