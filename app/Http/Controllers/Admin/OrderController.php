<?php

namespace App\Http\Controllers\Admin;

use App\Models\Courier;
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
    public  function  add($id,  $gid)
    {
        $res =  Orders::where('id',$id)->update(['status'=>3]);
        return view('admin.order.courier',['oid'=>$id, 'gid'=>$gid]);
    }
    
    // 添加快递信息
    public function courier(Request $request)
    {
        // 数据验证
        $this->validate($request,[
            'oid'=> 'required',
            'gid'=> 'required',
            'name'=>'required',
            'num' =>'required|numeric',
        ],[
            'oid.required'=>'订单id不能为空',
            'gid.required'=>'商品id不能为空',
            'name.required'=>'快递公司不能为空',
            'num.required'=>'快递单号不能为空',
            'num.numeric'=>'快递单号必须为数字',
        ]);
        
        $courier = new Courier();
    
        $courier->oid = $request->input('oid', 0);
        $courier->gid = $request->input('gid', 0);
        $courier->name = $request->input('name', '');
        $courier->num = $request->input('num', 0);
        
        $res = $courier->save();
    
        if ($res) {
            return redirect('admin/order/index')->with('success', '发货成功');
        }
    }
}
