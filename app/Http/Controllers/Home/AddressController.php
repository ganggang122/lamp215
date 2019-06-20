<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\IndexController;
use App\Models\Address;

class AddressController extends Controller
{
    //用户前台列表
    public  function  index()
    {   
    	 $users_address = Address::get();

    	  return  view('home.address.index' , ['users_address' =>$users_address,'links'=>IndexController::getLinksData()]);

    	return  view('home.address.index' , ['users_address' =>$users_address,'links'=>IndexController::getLinksData()]);

    }

    //接收提交过来的地址信息
    public  function create(Request $request)
    {    
    	 $this->validate($request, [
                'uname' => 'required',
                'phone' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
                'province' => 'required',
                'country' =>  'required',
                'town' => 'required',
                'address' => 'required'

            ],[ 
            	'uname.required' => '用户名必填',
                'phone.required'=>'手机号必填',
                'phone.regex'=>'手机号格式错误',
                'province.required' => '所属省份必填',
                'country.required' => '所属市/直辖市必填',
                'town.required' => '所属市区必填',
                'address.required' => '详细地址必填'
            ]);
	    	$province = $request->input('province','');
	    	$country = $request->input('country','');
	    	$town = $request->input('town','');
	    	$address = $request->input('address','');
	    	$uname = $request->input('uname','');
	    	$phone = $request->input('phone','');

    	   

    	   
    	   $users_address  = new Address;
    	   $users_address->uid =  session('home_usersinfo')->id;
    	   $users_address->uname = $uname;
    	   $users_address->phone = $phone;
    	   $users_address->address =  $province.$country.$town.$address;
    	    $res = $users_address->save();

    	    if($res){
    	    	return  back()->with('success' , '添加成功');
    	    }else{
    	    	return  back()->error('error' , '添加失败');
    	    }


    }

    public  function  update($id)
    {
         Address::where('status',1)->update(['status'=>0]);
         Address::where('id' , $id)->update(['status'=>1]);

         return  back();

    }

    public  function  edit($id)
    {
    	 $users_address = Address::get();
    	 $users_addre = Address::find($id);
         return view('home.address.edit' , ['users_address' =>$users_address,'users_addre'=>$users_addre,'links'=>IndexController::getLinksData()]);
    }

    public  function  show(Request $request,$id)
    {
    	$this->validate($request, [
                'uname' => 'required',
                'phone' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
                'province' => 'required',
                'country' =>  'required',
                'town' => 'required',
                'address' => 'required'

            ],[ 
            	'uname.required' => '用户名必填',
                'phone.required'=>'手机号必填',
                'phone.regex'=>'手机号格式错误',
                'province.required' => '所属省份必填',
                'country.required' => '所属市/直辖市必填',
                'town.required' => '所属市区必填',
                'address.required' => '详细地址必填'
            ]);
	    	$province = $request->input('province','');
	    	$country = $request->input('country','');
	    	$town = $request->input('town','');
	    	$address = $request->input('address','');
	    	$uname = $request->input('uname','');
	    	$phone = $request->input('phone','');


    	   

    	   
    	   $users_address  = Address::find($id);
    	   $users_address->uid =  session('home_usersinfo')->id;
    	   $users_address->uname = $uname;
    	   $users_address->phone = $phone;
    	   $users_address->address =$province.$country.$town.$address;
    	   $res = $users_address->save();

    	    if($res){
    	    	return  back()->with('success' , '添加成功');
    	    }else{
    	    	return  back()->error('error' , '添加失败');
    	    }
    }

    public  function destory($id)
    {
         dump($id);
    }

}
