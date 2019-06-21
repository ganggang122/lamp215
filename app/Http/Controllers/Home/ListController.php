<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
   //商品列表页
   public  function   index()
   {
   	 return view('home.list.index');
   }
}
