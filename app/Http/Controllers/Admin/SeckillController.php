<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class SeckillController extends Controller
{
    //是否启用方法 
    public function changeStatus(Request $request)
    {
        //接收id
        $id = $request->input('id');
        //获取状态
        $status = DB::table('seckill')->where('id',$id)->first();
        if ( $status->status ==1 ) {
            $res = DB::table('seckill')->where('id',$id)->update(['status'=>2]);
            echo 'ok';
            exit;
        }
        if ( $status->status ==2 ) {
            $res = DB::table('seckill')->where('id',$id)->update(['status'=>1]);
            echo 'ok';
            exit;
        }
    }
    //是否 置顶 
    public function changeTop(Request $request)
    {
        //接收id
        $id = $request->input('id');
        //查询是否已置顶
        $top  = DB::table('seckill')->where('id',$id)->first();
        if ( $top->top == 1) {
            //修改数据库 置顶 字段 值为2---置顶 修改更新时间
            $res = DB::table('seckill')->where('id',$id)->update(['top'=>2,'updated_at'=>date('Y-m-d H:i:s')]);           
        } else {
            //修改更新时间
            $res = DB::table('seckill')->where('id',$id)->update(['updated_at'=>date('Y-m-d H:i:s')]);
        }
        if ( $res ) {
            echo 'ok';
            exit;
        } else {
            echo 'error';
            exit;
        } 

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取数据
        $seckills = DB::table('seckill')->get();
        return view('admin.seckill.index',['seckills'=>$seckills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.seckill.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //编写验证
        $this->validate($request, [
            'seckill' => 'required',
            'goodsName' => 'required',
            'profile' => 'required',
        ],[
            'seckill.required' =>'秒杀标题未填写',
            'goodsName.required' =>'商品名称未填写，务必填写准确',
            'profile.required' => '封面图未选择',
        ]);
        //上传图片
        $path = $request->file('profile')->store(date('Ymd'));
        //接收数据
        $data = $request->except('_token');
        $data['profile'] = $path;
        $data['updated_at'] = date('Y-m-d H:i:s');
        //存入数据库
        $res = DB::table('seckill')->insert($data);
        if ( $res ) {
            return redirect('admin\seckill')->with('success','添加成功');
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
        //获取数据
        $seckill = DB::table('seckill')->where('id',$id)->first();
        return view('admin.seckill.edit',['seckill'=>$seckill]);

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
            'seckill' => 'required',
            'goodsName' => 'required',
        ],[
            'seckill.required' =>'秒杀标题未填写',
            'goodsName.required' =>'商品名称未填写，务必填写准确',
        ]);
        //判断是否有图片上传
        if ( $request->hasFile('profile') ) {
            $path = $request->file('profile')->store(date('Ymd'));
        } else {
            $path = $request->input('old_profile');
        }
        //接收数据
        $data = $request->except(['_token','_method','old_profile']);
        $data['profile']=$path;
        $data['updated_at'] = date('Y-m-d H:i:s'); 
        //存入数据库
        $res = DB::table('seckill')->where('id',$id)->update($data);
        if ( $res ){
            return redirect('admin/seckill')->with('success','修改成功');
        } else {
            return back()->with('error')->with('error','修改失败');
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
        $res = DB::table('seckill')->where('id',$id)->delete();
       if ( $res ){
            return redirect('admin/seckill')->with('success','删除成功');
        } else {
            return back()->with('error')->with('error','删除失败');
        }
    }
}
