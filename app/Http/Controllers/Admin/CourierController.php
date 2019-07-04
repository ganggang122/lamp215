<?php

namespace App\Http\Controllers\Admin;

use App\Models\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourierController extends Controller
{
    //加载快递列表页
    public function index()
    {
        $courier = Courier::all();
        
        return view('admin.courier.index', ['courier' => $courier]);
    }
}
