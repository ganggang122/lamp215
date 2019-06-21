<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return view('admin.news.index',['news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //验证表单
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ],[
            'title.required'=>'新闻标题必填',
            'content.required' => '新闻内容必填',
        ]);
          //验证文件是否上传
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store(date('Ymd'));
        } else {
            $path = '';
        }
        //获取数据
        $title = $request->input('title','');
        $content = $request->input('content','');

        //压入数据
        $news = new News;
        $news->title = $title;
        $news->content = $content;
        $news->image = $path;
        $res = $news->save();
        if ($res) {
            return redirect('admin/news')->with('success','添加成功');
        } else {
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
        $news =  News::find($id);
        return view('admin.news.edit',['news'=>$news]);
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
       
         //获取新闻图片
        if ($request->hasFile('image')) {
            Storage::delete($request->input('old_image'));
            $image_path = $request->file('image')->store(date('Ymd'));
        } else {
            $image_path = $request->input('old_image');
        }
        //获取数据
        $title = $request->input('title','');
        $content = $request->input('content','');

        //压入数据
        $news = News::find($id);
        $news->title = $request->input('title','');
        $news->content = $request->input('content','');
        $news->image = $image_path;
        $res = $news->save();
        if ($res) {
            return redirect('admin/news')->with('success','修改成功');
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
        $res = News::destroy($id);
        if ($res) {
            return redirect('admin/news')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }
}
