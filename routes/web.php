<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//后台 栏目 路由
Route::resource('admin/cates','Admin\CatesController');

//前台 首页 路由
Route::resource('home/index','Home\IndexController');