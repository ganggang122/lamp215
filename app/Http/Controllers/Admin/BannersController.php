<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cate;
use Illuminate\Support\Facades\Storage;
class BannersController extends Controller
{
    /**
     * 轮播图显示列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::all();
        return view('admin.banners.index',['banner'=>$banner]);
    }

    /**
     * 轮播图 添加 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = CatesController::getCates();
        // echo '啊啊啊啊';
        return view('admin.banners.create',['cate'=>$cate]);
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
            'desc' => 'required',
        ],[
            'title.required'=>'标题必填',
            'desc.required' => '描述必填',
        ]);
        //验证文件是否上传
        if ($request->hasFile('url')) {
            $path = $request->file('url')->store(date('Ymd'));
        } else {
            $path = '';
        }
        //获取数据
        $title = $request->input('title');
        $desc = $request->input('desc');
        $status = $request->input('status',0);
        $cid = $request->input('cid',0);
        //压入数据
        $banner = new Banner;
        $banner->title = $title;
        $banner->desc = $desc;
        $banner->status = $status;
        $banner->cid = $cid;
        $banner->url = $path;
        $res = $banner->save();
        if ($res) {
            return redirect('admin/banners')->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
        }
    }
    public function changeStatus(Request $request)
    {
        // echo '啊啊';
        
        $status = $request->input('status','');
        $id = $request->input('id','');


        $banner = Banner::find($id);
        $banner->status = $status;
        $res = $banner->save();
        if ($res) {
            return redirect('admin/banners')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
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
        $banner = Banner::find($id);
        $cate = CatesController::getCates();
        return view('admin.banners.edit',['banner'=>$banner,'cate'=>$cate]);
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
        // dd($request->all());
         //获取url
        if ($request->hasFile('url')) {
            Storage::delete($request->input('old_url'));
            $url_path = $request->file('url')->store(date('Ymd'));
        } else {
            $url_path = $request->input('old_url');
        }
        $banner = Banner::find($id);
        $banner->title = $request->input('title','');
        $banner->desc = $request->input('desc','');
        $banner->cid - $request->input('cid',0);
        $banner->url = $url_path;
        $res = $banner->save();
         if ($res) {
            return redirect('admin/banners')->with('success','修改成功');
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
        //删除
       $res = Banner::destroy($id);
        if ($res) {
            return redirect('admin/banners')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }
}
