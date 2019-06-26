<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Collect;
class IndexController extends Controller
{
    /**
     * 后台 首页.
     *sss
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //这是前台 商品详情页 收藏功能的 是否收藏该商品的信息 先暂存在这里
        //获取该用户是否收藏过当前商品
        //获取用户id
        $uid = 2;
        //获取商品id
        $gid = 46;
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
        return view('admin.index.index',['collect'=>$collect]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
