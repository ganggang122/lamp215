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
        $cnames['UserController'] = '用户管理';
        $cnames['CateController'] = '栏目管理';
        $cnames['AdminuserController'] = '管理员管理';
        $cnames['RoleController'] = '岗位管理';
        $cnames['NodeController'] = '权限管理';
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
            return back('admin/role')->with('error','添加成功');            
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
        //
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
        //
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
    }
}
