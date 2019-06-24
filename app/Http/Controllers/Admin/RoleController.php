<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class RoleController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected static function getControllerName()
    {
        //控制器cname对应的中文名称
        $cnames['UserController'] = '用户管理';
        $cnames['CateController'] = '栏目管理';
        $cnames['AdminuserController'] = '管理员管理';
        $cnames['RoleController'] = '岗位管理';
        $cnames['NodeController'] = '权限管理';
        return  $cnames;
    } 

    public function index()
    {
        //获取职位信息
        $role_data = DB::table('role')->get();
        //遍历 职位 获取 职位 对应的权限的 nid
        $nids = [];
        foreach($role_data as $k=>$v){
            $nids = DB::table('role_node')->select('nid')->where('rid',$v->id)->get();
            $nodes_data = [];
            //遍历 nid 获取 nid 对应权限表的数据
            foreach($nids as $vv){
                $nid = $vv->nid;
                $nodes_data[] = DB::table('node')->where('id',$nid)->first();
            }
            //将权限数据 存入对应的岗位
            $role_data[$k]->node_name = $nodes_data;
        }
        //后台 职位 列表页
        return view('admin.role.index',['role_data'=>$role_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取权限
        $nodes = DB::table('node')->get();
        $nodes_data =[];
        //使控制器名为 数组 temp 的下标 值为控制器对应的方法名
        foreach($nodes as $k=>$v){
            $nodes_data[$v->cname][] = $v; 
        }
        //控制器cname对应的中文名称
        $cnames = self::getControllerName();
        //后台 岗位&部门 添加页
        return view('admin.role.create',['nodes'=>$nodes_data,'cnames'=>$cnames]);
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
        //编写表单验证
        $this->validate($request, [
            'rname' => 'required|unique:role',
            'nid' => 'required',
        ],[
            'rname.required' => '岗位名称未填写',
            'rname.unique' => '该岗位已注册',
            'nid.required'  => '权限未选择'
        ]);
        //接收数据
        $rname = $request->input('rname');
        $nid = $request->input('nid');
        //岗位名称存入role表
        $rid = DB::table('role')->insertGetId(['rname' =>$rname] );
        //岗位的id(rid) 权限id(nid)存入role_node表
        foreach($nid as $n){
            $res2 = DB::table('role_node')->insert(['rid'=>$rid,'nid'=>$n]);
        }

        if ($rid && $res2) {
            //提交事务
            DB::commit();
            return redirect('admin/role')->with('success','添加成功');
        } else {
            DB::rollBack();
            return back('admin/role')->with('error','添加失败');            
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取职位信息  
        $role = DB::table('role')->where('id',$id)->first();
        //获取职位对应的权限
        $user_node = DB::table('role_node')->select('nid')->where('rid',$id)->get();
        $user_nodes= [];
        foreach($user_node as $v){
             $user_nodes[] = $v->nid;
        }
        //获取所有权限
        $nodes = DB::table('node')->get();
        $nodes_data =[];
        //使控制器名为 数组 temp 的下标 值为控制器对应的方法名
        foreach($nodes as $k=>$v){
            $nodes_data[$v->cname][] = $v; 
        }
        //遍历控制器 信息 如果控制器内的id与用户所拥有的权限 nid 相等 就插入一个flag 用于页面复选框 checked
        foreach($nodes_data as $k=>$v){
            foreach($v as $kk=>$vv){
                if(  in_array($vv->id,$user_nodes ) ){
                    $v[$kk]->flag = true;
                } else {
                    $v[$kk]->flag = false;
                }
            }
        }
        //控制器cname对应的中文名称
        $cnames = self::getControllerName();
        return view('admin.role.edit',['role'=>$role,'nodes_data'=>$nodes_data,'cnames'=>$cnames]);
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
        //接收 职位名称 
        $rname = $request->input('rname');
        //接收 权限数据
        $nid = $request->input('nid');
        //判断职位名是否为空 
        if( empty($rname) ) {
            return back()->with('error','职位名不能为空');
        }
        //判断 权限是否为空
        if( empty($nid) ) {
            return back()->with('error','权限未选择');
        }
        //开启事务
        DB::beginTransaction();
        //先查询-职位名称在表中是否存在 若存在就说明-未改变-就不更新 
        //若直接更新会报错 因为该表就两个字段  id rname
        $res = DB::table('role')->where('rname',$rname)->first();
        if( !$res ){
            //存储职位名称到 role表
            $res1 = DB::table('role')->where('id',$id)->update(['rname'=>$rname]);            
        } else {
            $res1 = true;
        }

        //先清除旧权限 再 插入新权限
        $res2 = DB::table('role_node')->where('rid',$id)->delete();
        foreach($nid as $v){
            $res3 = DB::table('role_node')->insert(['rid'=>$id,'nid'=>$v]);
        }    
        if ($res1 && $res2 && $res3) {
            //提交事务
            DB::commit();
            return redirect('admin/role')->with('success','修改成功');
        } else {
            DB::rollBack();
            return back('admin/role')->with('error','修改成功');
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
        //
        $res = DB::table('role')->delete($id);
        if ( $res ) {
            return redirect('admin/role')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');       
        }
    }
}
