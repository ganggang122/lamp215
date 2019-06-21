<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public  function  index()
    {   
    	//商城首页
    	return  view('home.index.index');
    }
}
