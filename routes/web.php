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
Route::get('home/list/index/{cid}' , 'Home\ListController@index');






//前台地址列表
Route::get('home/address/index' , 'Home\AddressController@index');
//前台添加地址
Route::post('home/address/create' , 'Home\AddressController@create');
//前台默认地址修改
Route::get('home/address/update/{id}' , 'Home\AddressController@update');

//前台地址修改
Route::get('home/address/edit/{id}' , 'Home\AddressController@edit');
//前台地址执行修改
Route::post('home/address/show/{id}' , 'Home\AddressController@show');
//前台地址删除
Route::get('home/address/destory/{id}' ,'Home\AddressController@destory');
//前台用户个人信息
Route::get('home/information/index' , 'Home\InformationController@index');
//前台用户添加个人信息
Route::post('home/information/create' , 'Home\InformationController@create');
//前台用户修改密码
Route::get('home/safe/index' , 'Home\SafeController@index');
//执行用户修改密码
Route::post('home/safe/update' , 'Home\SafeController@update');
//加入购物车
Route::post('home/shopcart/store' , 'Home\ShopcartController@store');
//前台购物车
Route::get('home/shopcart/index' , 'Home\ShopcartController@index');
//前台购物车小计加法
Route::get('home/shopcart/add' , 'Home\ShopcartController@add');
//前台购物车小计减法
Route::get('home/shopcart/minus' , 'Home\ShopcartController@minus');
//前台结算页面
Route::get('home/pay/index' , 'Home\PayController@index');



//前台 新闻 路由
Route::resource('home/news','Home\NewsController');



//  前台注册  邮箱  手机号
Route::get('home/register','Home\ResgisterController@index');
Route::get('home/register/sendPhone','Home\ResgisterController@sendPhone');
Route::post('home/register/store','Home\ResgisterController@store');
Route::post('home/register/insert','Home\ResgisterController@insert');
Route::get('home/register/changeStatus/{id}/{token}','Home\ResgisterController@changeStatus');








//后台 栏目 路由

Route::resource('admin/cates','Admin\CatesController');
//后台 轮播图 路由


Route::get('admin/banners/changeStatus','Admin\BannersController@changeStatus');
Route::resource('admin/banners','Admin\BannersController');
//后台 链接 路由
Route::resource('admin/links','Admin\LinksController');
//后台 收货地址
Route::get('admin/address/getAddress','Admin\AddressController@getAddress');
Route::resource('admin/address','Admin\AddressController');


Route::resource('admin/cates',  'Admin\CatesController');
// 后台 品牌管理 路由
// 品牌状态路由
Route::get('admin/brands/changeStatus', 'Admin\BrandsController@changeStatus');
// 后台品牌
Route::resource('admin/brands', 'Admin\BrandsController');
// 文件上传路由
Route::post('admin/upload', 'Admin\BrandsController@upload');

// 后台商品路由
Route::resource('admin/goods','Admin\GoodsController');

//后天商品规格路由
Route::resource('admin/specific' , 'Admin\SpecificController');
//后台添加商品规格
Route::post('admin/goods/add' , 'Admin\GoodsController@add');


//前台 首页 路由
Route::resource('home/index','Home\IndexController');

//后台 新闻 路由
Route::resource('admin/news','Admin\NewsController');
//后天商品规格
Route::resource('admin/specific' , 'Admin\SpecificController');
//后台添加商品规格
Route::post('admin/goods/add' , 'Admin\GoodsController@add');











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
	//后台 公告 路由
	Route::resource('admin/blog','Admin\BlogController');
	Route::get('/admim/blog/msg','Admin\BlogController@msg');

});





































































// =========================================

 //前台 收藏商品 点击收藏功能 路由
Route::get('home/collect/collect','Home\CollectController@collect');
//前台 收藏夹 主页
Route::get('home/collect/index','Home\CollectController@index');
//前台 收藏夹 删除收藏 按钮
Route::get('home/collect/del','Home\CollectController@del');


// ============================================

