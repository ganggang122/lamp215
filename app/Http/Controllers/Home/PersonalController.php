<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class PersonalController extends Controller
{
    //个人中心
    public  function  index()
    {
    	return  view('home.personal.index',['links'=>IndexController::getLinksData()]);
    }
}
