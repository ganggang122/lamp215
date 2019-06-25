<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeusersController extends Controller
{
    public function index()
    {
    	return view('admin.homeusers.index');
    }
}
