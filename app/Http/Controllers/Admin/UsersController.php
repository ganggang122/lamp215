<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Models\Users;
use Hash;
use App\Models\UserInfo;
use DB;
use Illuminate\Support\Facades\Storage;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //接收查询信息
        $search_uname = $request->input('search_uname','');
        $search_email = $request->input('search_email','');
        //获取用户信息
        $users = Users::where('uname','like','%'.$search_uname.'%')->where('email','like','%'.$search_email.'%')->paginate(2);

        return view('admin.user.index',['users'=>$users,'parmas'=>$request->all()]);
    }

    /**
     * 添加 用户 页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * 存储 用户 信息.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        //开启事务
        DB::beginTransaction();
        //文件上传 
        if ($request->hasfile('profile')) {
            //获取文件位置路径
            $path = $request->file('profile')->store(date('Ymd'));
        } else {
            $path = '';
        }
        //获取表单数据
        $data = $request->all();
        //创建user表对象
        $user = new Users;
        //赋值
        $user->uname = $data['uname'];
        $user->upass = Hash::make($data['upass']);
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->status = 1;
        //存储到user表
        $res1 = $user->save();
        //将头像信息存储到user_info表
        if ($res1) {
            //获取user_info表内的uid
            $uid = $user->id;
            //创建user_info表对象
            $user_info = new UserInfo;
            //给user_info表填数据
            $user_info->uid = $uid;
            $user_info->profile = $path;
            //存储到user_info表
            $res2 = $user_info->save();
        }

        if ($res1 && $res2) {
            //提交事务
            DB::commit();
            return redirect('admin/users')->with('success', '添加成功');
        } else {
            //回滚事务
            DB::commit();
            return back()->with('error','添加失败');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取用户信息
        $user = Users::find($id);
        return view('admin/user/edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //开启事务
        DB::beginTransaction();
        //判断是否有新头像上传
        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store(date('Ymd'));
        } else {
            $path = $request->input('old_profile');
        }
        //获取user表信息
        $user = Users::find($id);
        $user->email = $request->input('email','');
        $user->phone = $request->input('phone','');
        //保存user表修改的信息
        $res1 = $user->save();
        //获取user_info表信息
        $user_info = UserInfo::where('uid',$id)->first();
        $user_info->profile = $path;
        //保存user_info表修改的信息
        $res2 = $user_info->save();
        if ($res1 && $res2) {
            //提交事务
            DB::commit();
            return redirect('admin/users')->with('success', '修改成功');
        } else {
            //回滚事务
            DB::commit();
            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //开启事务
        DB::beginTransaction();
        //删除user表内的用户信息
        $res1 = Users::destroy($id);
        //获取头像信息
        $path = UserInfo::where('uid',$id)->first()->profile;
        //删除user_info表内的信息
        $res2 = UserInfo::where('uid',$id)->delete();
        //删除头像
        Storage::delete($path);
        if ($res1 && $res2) {
            //提交事务
            DB::commit();
            return redirect('admin/users')->with('success','删除成功');
        } else {
            //回滚事务
            DB::commit();
            return back()->with('error','添加失败');     
       }
    }
}
