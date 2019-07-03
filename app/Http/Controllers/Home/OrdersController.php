<?php

namespace App\Http\Controllers\Home;

use App\Models\Comment;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    //加载订单页面
    public function index()
    {
        if(!session('home_usersinfo')){
            return redirect('home/login/index');
        }
        //统计购物车数量
        $num  =  ShopcartController::num();
        
        // 查询订单所有状态
        // 查询代付款状态
        $orders1 = Orders::where('status',1)->get();
        // 查询已完成付款，代发货的订单
        $orders2 = Orders::where('status',2)->get();
        // 查询待确认收货订单
        $orders3 = Orders::where('status',3)->get();
        // 查询待评价订单
        $orders4 = Orders::where('status',4)->get();
        //查询已完成订单
        $orders5 = Orders::where('status',5)->get();
        
        
        return  view('home.orders.index', [
            'num'=>$num,
            'links'=>IndexController::getLinksData(),
            'orders1'=>$orders1,
            'orders2'=>$orders2,
            'orders3'=>$orders3,
            'orders4'=>$orders4,
            'orders5'=>$orders5,
            
        ]);
        
    }
    
    // 一键支付
    public function pay($id)
    {
        $orders = Orders::find($id);
        $orders->status = 2;
        $res = $orders->save();
    
        if ($res) {
            return back();
        }
        
    }
    
    // 提醒发货
    public function message($id)
    {
        $orders = Orders::find($id);
        $orders->status = 2;
        $res = $orders->save();
        if($res){
            echo  json_encode(['msg'=>'success' , 'info'=>'提醒卖家成功']);
            exit;
        }else{
            echo  json_encode(['msg'=>'error' , 'info'=>'提醒卖家失败']);
            exit;
        }
        
    }
    
    // 修改待评价状态
    public function givegoods($id)
    {
        $orders = Orders::find($id);
        $orders->status = 4;
        $res = $orders->save();
    
        if ($res) {
            return back();
        }
    }
    
    // 评价商品
    public function comment($id)
    {
        if(!session('home_usersinfo')){
            return redirect('home/login/index');
        }
        //统计购物车数量
        $num  =  ShopcartController::num();
        // 查询商品评论订单
        //获取用户id
        $uid = session('home_usersinfo')->id;
        $orders4 = Orders::where('id',$id)->where('status',4 )->get();

        return view('home.comment.create',[
            'orders4'=>$orders4,
            'num'=>$num,
            'links'=>IndexController::getLinksData(),
        ]);
    }
    
    // 添加评论商品
    public function commentsotre(Request $request)
    {
        $id = $request->input('id', 0);
       // 添加评论
        $comment = new Comment();
        $comment->gid = $request->input('gid', 0);
        $comment->parent_id = 0;
        $comment->nickname = session('home_usersinfo')->uname;
        $comment->content = $request->input('content', '');
        $res = $comment->save();
        
        // 添加完成修改商品状态
        if ($res) {
            $orders = Orders::find($id);
            $orders->status = 5;
            $res2= $orders->save();
            if ($res2) {
                return redirect('home/orders/index');
            }
        }
        
    }
    
    // 删除订单
    public function destroy($id)
    {
        //删除订单
        $res = Orders::destroy($id);
        if ($res) {
            $data['error'] = 0;
            $data['msg'] = '删除订单成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '删除订单失败';
        }
    
        return $data;
    }
    
    // 查看物流
    public function logistics($id)
    {
        echo $id;
        //统计购物车数量
        $num  =  ShopcartController::num();
        
        
        return view('home.logistics.index', [
            'num'=>$num,
            'links'=>IndexController::getLinksData(),
        ]);
    }
}
