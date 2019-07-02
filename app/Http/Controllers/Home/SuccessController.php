<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuccessController extends Controller
{
    public  function  index()
    {   
    	$num  =  ShopcartController::num();
    	return  view('home.success.index' ,['num'=>$num]);
    }
}
