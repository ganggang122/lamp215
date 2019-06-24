<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class BlogController extends Controller
{
    //后台 模态框 内的 头条 content
    public function msg(Request $request)
    {
        //获取头条id
        $id = $request->input('id');
        //获取content
        $content = DB::table('blog')->select('content')->where('id',$id)->first();
        if ($content) {
            echo( $content->content);
        }
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取所有头条信息
        $blogs = DB::table('blog')->orderBy('top','desc')->orderBy('created_at','desc')->get();
        return view('admin.blog.index',['blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //编写验证 确认有标题 内容 是否置顶 提交过来
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                'top' => 'required',
            ],[
                'title.required' =>'标题未填写',
                'content.required' =>'内容未填写',
                'top.required' => '置顶未选择',
            ]);
            //接收数据
            $data = $request ->except('_token');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $res = DB::table('blog')->insert($data);
            if ($res) {
                return redirect('admin/blog')->with('success','发布成功');
            } else {
                return back()->with('error','发布失败');
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
        //获取该头条信息
        $message = DB::table('blog')->where('id',$id)->first();
        return view('admin.blog.edit',['message'=>$message]);
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
        //编写验证
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'top' => 'required',
        ],[
            'title.required' =>'标题未填写',
            'content.required' =>'内容未填写',
            'top.required' => '置顶未选择',
        ]);
        //接收数据
        $data = $request->except(['_token','_method']);
        $data['updated_at'] = date('Y-m-d H:i:s');
        //存入数据库
        $res = DB::table('blog')->where('id',$id)->update($data);
        if ( $res ) {
            return redirect('admin/blog')->with('success','修改成功');
        } else {
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
        //
        $res = DB::table('blog')->where('id',$id)->delete();
        if ($res) {
            return redirect('admin/blog')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }
}
