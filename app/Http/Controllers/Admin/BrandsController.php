<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brands;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OSS;

class BrandsController extends Controller
{
    /**
     *  处理客户端上传 的文件
     * 上传至阿里云oss
     * @return $newfile
     */
    public function upload(Request $request)
    {

        // 获取客户端传来的文件
         $file = $request->file('file_upload');
        // $filename = $_FILES['file']['name'];
        
        if ($file->isValid()) {
            // 获取文件上传对象的后缀名
            $ext = $file->getClientOriginalExtension();
            // 生成一个唯一的文件名，保证所有的文件不重名
            $newfile = time().rand(1000, 9000).uniqid().'.'.$ext;
            // 设置上传文件的目录
//            $dirpath = public_path().'/uploads'.'/'.date('Ymd');
            $dirpath = public_path().'/uploads/';
            //将文件移动到指定目录，并以新文件名命名
            // $file->move($dirpath, $newfile);
            // 将文件移入阿里云oss存储
            OSS::upload($newfile, $file->getRealPath());
    
            // 将上传的照片返回前台，显示图片
            return $newfile;
    
        }
        /*if($file->isValid()){
            //        获取文件上传对象的后缀名
            $ext = $file->getClientOriginalExtension();
        
        
            //生成一个唯一的文件名，保证所有的文件不重名
            $newfile = time().rand(1000,9999).uniqid().'.'.$ext;
        
        
            //设置上传文件的目录
            $dirpath = public_path().'/uploads/';
        
        
        
        
            //将文件移动到本地服务器的指定的位置，并以新文件名命名
//            $file->move(移动到的目录, 新文件名);
//            $file->move($dirpath, $newfile);
        
        
        
            //将文件移动到七牛云，并以新文件名命名
            //\Storage::disk('qiniu')->writeStream('uploads/'.$newfile, fopen($file->getRealPath(), 'r'));
        
        
            //将文件移动到阿里OSS
            OSS::upload($newfile,$file->getRealPath());
        
        
            //将上传的图片名称返回到前台，目的是前台显示图片
            return $newfile;
        
        
        }*/
    
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询数据发送页面
        $brands = Brands::all();
        return view('admin.brands.index',['brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        //引入添加页面 发送分类数据
        return view('admin.brands.create', ['cates'=>CatesController::getCates()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // 表单验证
        $this->validate($request, [
            'cid'   => 'required',
            'bname' => 'required|unique:brands',
            'photo' => 'required'
        ],[
            'cid.required'   => '分类名称必选',
            'bname.required' => '品牌名称必填',
            'bname.unique'   => '品牌名称已存在',
            'photo.required'   => '请上传品牌图片',
        ]);
        //接收表单传来的数据
        
        // 压入数据
        $brands = new Brands();
        $brands->cid    = $data['cid'];
        $brands->bname  = $data['bname'];
        $brands->photo  = $data['photo'];
        $brands->status = 0;
        
        $res = $brands->save();
        if ($res) {
            return redirect('admin/brands')->with('success','添加品牌成功');
        } else {
            return back()->with('error','添加品牌失败');
            
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
        //查询数据添加修改页面
        $brand = Brands::find($id);
        return view('admin.brands.edit',['brand'=>$brand]);
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
        // 数据验证
        $this->validate($request, [
            
            'bname' => 'required|unique:brands',
            'photo' => 'required'
        ],[
            
            'bname.required' => '品牌名称必填',
            'bname.unique'   => '品牌名称已存在',
            'photo.unique'   => '上传品牌图片',
        ]);
        //接收修改值
        $brands = Brands::find($id);
        $brands->status = 0;
        $brands->bname = $request->input('bname');
        $brands->photo = $request->input('photo');
        $res = $brands->save();
        if ($res) {
            return redirect('admin/brands')->with('success','修改品牌成功');
        } else {
            return back()->with('error','修改品牌失败');
        
        }
        
    }
    
    /**
     * 修改品牌状态
     */
    
    public function changeStatus(Request $request)
    {
        $status = $request->input('status', 0);
        $id = $request->input('id');
    
        $brands = Brands::find($id);
        $brands->status = $status;
        $res = $brands->save();
        if ($res) {
            return redirect('admin/brands')->with('success','修改品牌状态成功');
        } else {
            return back()->with('error','修改品牌状态失败');
        
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
        
        //执行删除
        $res = Brands::destroy($id);
        
        $data = [];
        
        if ($res) {
            $data['error'] = 0;
            $data['msg'] = '删除成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '删除失败';
        }
        
        return $data;
    
        
    }
}
