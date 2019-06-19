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
//前台登录
Route::get('home/login/index' , 'Home\LoginController@index');
//前台用户退出
Route::get('home/logout' , 'Home\LoginController@logout');

Route::post('home/login/dologin' , 'Home\LoginController@dologin');
//首页
Route::get('home/index' ,'Home\PageController@index');
//前台个人中心
Route::get('home/personal' , 'Home\PersonalController@index');
//前台商品列表页面
Route::get('home/list/index' , 'Home\ListController@index');



//前台地址列表
Route::get('home/address/index' , 'Home\AddressController@index');
//前台添加地址
Route::post('home/address/create' , 'Home\AddressController@create');
//前台默认地址修改
Route::get('home/address/update/{id}' , 'Home\AddressController@update');




//  前台注册  邮箱  手机号
Route::get('home/register','Home\ResgisterController@index');
Route::get('home/register/sendPhone','Home\ResgisterController@sendPhone');
Route::post('home/register/store','Home\ResgisterController@store');
Route::post('home/register/insert','Home\ResgisterController@insert');
Route::get('home/register/changeStatus/{id}/{token}','Home\ResgisterController@changeStatus');




Route::get('admin/banners/changeStatus','Admin\BannersController@changeStatus');
Route::resource('admin/banners','Admin\BannersController');
//后台 链接 路由
Route::resource('admin/links','Admin\LinksController');
//前台 首页 路由
Route::resource('home/index','Home\IndexController');













//后台 登录页 路由
Route::get('admin/login','Admin\LoginController@login');
//后台 登录 验证
Route::post('admin/dologin','Admin\LoginController@dologin');
//后台 退出 登录
Route::get('admin/logout','Admin\LoginController@logout');
//后台 没有 权限 页面
Route::get('admin/rbac',function(){
	return view('admin.rbac');
});

//后台 登录，node权限 中间
// Route::group(['middleware'=>['login','node']],function(){
// Route::group(['middleware'=>'login'],function(){
 Route::group([],function(){
	//后台 首页
	Route::get('admin','Admin\IndexController@index');

	//后台 用户 路由 UsersController
	Route::resource('admin/users','Admin\UsersController');

	//后台 栏目 路由
	Route::resource('admin/cates','Admin\CatesController');

	//后台 管理员 路由
	Route::resource('admin/adminuser','Admin\AdminuserController');

	//后台 岗位&部门 路由
	Route::resource('admin/role','Admin\RoleController');
	//后台 权限 路由
	Route::resource('admin/node','Admin\NodeController');

});