<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin_user;
use Hash;
use DB;
class AdminuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取 管理员、职位 表:admin_user、role 数据
        $admins = DB::select('select ad.id,uname,profile,rname,rid from admin_user as ad,role,aduser_role as adlo where ad.id = adlo.uid and role.id = adlo.rid');
        return view('admin.adminuser.index',['admins'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取 职位 数据
        $role_data = DB::table('role')->get();
        //添加 管理员 页面
        return view('admin.adminuser.create',['role_data'=>$role_data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //开启事务
        DB::beginTransaction();
        //表单验证
        $this->validate($request, [
            'uname' => 'required|unique:admin_user',
            'upass' => 'required',
            'repass'=> 'same:upass',
            'rid'   => 'required',
        ],[
            'uname.required'=>'用户名未填写',
            'uname.unique'  =>'该用户名已注册',
            'upass.required'=>'密码未填写',
            'repass.same'   =>'两次密码不一致',
            'rid.required'  =>'职位未选择',
        ]);
        //判断是否有文件上传
        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store(date('Ymd'));
        } else {
            $path = '';
        }
        //写入  adminuser 数据表
        $admin_user = new Admin_user;
        $admin_user->uname = $request->input('uname');
        $admin_user->upass = Hash::make($request->input('upass'));
        $admin_user->profile = $path;
        //存储  adminuser 数据表
        $res1 = $admin_user->save();
        //准备存入 aduser_role数据
        $rid = $request->input('rid','');
        $uid = $admin_user->id;
        $res2 = DB::table('aduser_role')->insert(['uid'=>$uid,'rid'=>$rid]);
        if ($res1 && $res2) {
            //提交事务
            DB::commit();
            return redirect('admin/adminuser')->with('success','添加管理员成功');
        } else {
            //回滚事务
            DB::rollBack();
            return back()->with('error','添加管理员失败');
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
        //获取要修改的用户数据
        $user = DB::table('admin_user')->where('id',$id)->first();
        //获取用户的职位id 即  rid
        //$rid = DB::select('select rid from role,aduser_role as adro where adro.uid = '.$user->id.' and adro.rid = role.id ');
        $rid = DB::table('aduser_role')->select('rid')->where('uid',$user->id)->first();
        //获取职位信息
        $role_data = DB::table('role')->get();
        return view('admin.adminuser.edit',['user'=>$user,'rid'=>$rid,'role_data'=>$role_data]);
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
        //判断是否有头像上传
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile')->store(date('Ymd')); 
        }else {
            $profile = $request->input('old_profile');
        }
        //接收用户名
        $uname = $request->input('uname');
        //判断用户名是否为空 为空则返回
        if (empty($uname)) {
            return back()->with('error','用户名不能为空');
        }
        //接收 密码 
        $upass = $request->input('upass');
        //准备数据
        $data['uname'] = $uname;
        $data['profile'] = $profile;
        //判断 密码是否为空 为空密码则不更新 
        if ( !empty($upass) ) {
            //接收确认密码
            $repass = $request->input('repass');
            if ($upass != $repass ) {
                return back()->with('error','两次密码不一致');                
            }
            $upass = Hash::make($upass);
            $data['upass'] = $upass;
        }
        //开启事务
        DB::beginTransaction();
        $res1 = DB::table('admin_user')->where('id',$id)->update($data);
        $rid = $request->input('rid');
        //判断rid是否变化 若未变则不更新
        $judge = DB::table('aduser_role')->where('uid',$id)->first();
        if ( $judge->rid != $rid ) {
            $res2 = DB::table('aduser_role')->where('uid',$id)->update(['rid'=>$rid]);            
        } else {
            $res2 = true;
        }
        if ($res1 && $res2) {
            //提交事务
            DB::commit();
            return redirect('admin/adminuser')->with('success','修改成功');
        } else {
            //事务回滚
            DB::rollBack();
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
        //删除admin_user表内的用户信息
        $res1 = DB::table('admin_user')->where('id',$id)->delete();
        //删除aduser_role表内的信息
        $res2 = DB::table('aduser_role')->where('uid',$id)->delete();
        if ($res1 && $res2) {
            //提交事务
            DB::commit();
            return redirect('admin/adminuser')->with('success','删除成功');            
        } else {
            //事务回滚
            DB::rollBack();
            return back()->with('error','修改失败');             
        }
    }
}
