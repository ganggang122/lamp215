<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Address;

class PayController extends Controller
{
    //结算页面
    public function index(Request $request, $id)
    {
        dump($request->all());
//        $uid = session('home_usersinfo')->id;
        $uid = 12;

        $address_data = Address::where('uid',$uid)->get();
        
    	return  view('home.pay.index' , ['address_data' => $address_data]);
    }
    
    
}
