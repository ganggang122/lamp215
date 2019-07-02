<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取数据
        $nodes = DB::table('node')->get();
        //权限 首页 列表
        return view('admin.node.index',['nodes'=>$nodes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //权限 添加 页面
        return view('admin.node.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //编写表单验证
        $this->validate($request, [
            'desc' =>  'required|unique:node',
            'cname' => 'required',
            'aname' => 'required',
        ],[

            'desc.required' => '权限名称未填写',
            'desc.unique' =>   '该权限名已存在',
            'cname.required' => '控制器未填写',
            'aname.required' => '方法名未填写',
        ]);
        //接收数据
        $data = $request->except('_token');
        $cname = $request->input('cname');
        $data['cname'] = $cname.'Controller';
        //存入数据库
        $res = DB::table('node')->insert($data);
        if ($res) {
            return redirect('admin/node')->with('success','添加成功');
        } else {
            return back()->with('error',"添加失败");
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
        //删除数据
        $res = DB::table('node')->where('id',$id)->delete();
        if ( $res ) {
            return redirect('admin/node')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }

    }
}
