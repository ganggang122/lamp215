<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Address;
class AddressController extends Controller
{
    /**
     * 显示地址详情
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取所有地址信息
        $address = Address::all();
       
        return view('admin.adderss.index',['address'=>$address]);
    }
    public function getAddress(Request $request)
    {
        //获取id

        $id = $request->input('id',0);
        //获取信息
        $address = Address::find($id);
        $address_data = $address->address;
        echo $address_data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.adderss.create');
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
        $res = Address::destroy($id);
        if ($res) {
            return redirect('admin/address')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }
}
