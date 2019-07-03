<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders;

class OrderController extends Controller
{
    public  function  index()
    {   

        $order_data = Orders::get();
        
    	return  view('admin.order.index',['order_data'=>$order_data]);
    }
    public  function  add($id)
    {
        $res =  Orders::where('id',$id)->update(['status'=>3]);
        return back()->with('success','状态修改成功');
    }
}
