<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use DB;
class RecommendController extends Controller
{
    //推荐是否 置顶 
    public function changeTop(Request $request)
    {
        //接收id
        $id = $request->input('id');
        //查询是否已置顶
        $top  = DB::table('recommend')->where('id',$id)->first();
        if ( $top->top == 1) {
            //修改数据库 置顶 字段 值为2---置顶 修改更新时间
            $res = DB::table('recommend')->where('id',$id)->update(['top'=>2,'updated_at'=>date('Y-m-d H:i:s')]);           
        } else {
            //修改更新时间
            $res = DB::table('recommend')->where('id',$id)->update(['updated_at'=>date('Y-m-d H:i:s')]);
        }
        if ( $res ) {
            echo 'ok';
            exit;
        } else {
            echo 'error';
            exit;
        } 

    }
    //推荐是否启用方法 
    public function changeStatus(Request $request)
    {
        //接收id
        $id = $request->input('id');
        //获取状态
        $status = DB::table('recommend')->where('id',$id)->first();
        if ( $status->status ==1 ) {
            $res = DB::table('recommend')->where('id',$id)->update(['status'=>2]);
            echo 'ok';
            exit;
        }
        if ( $status->status ==2 ) {
            $res = DB::table('recommend')->where('id',$id)->update(['status'=>1]);
            echo 'ok';
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
        //获取推荐数据
        $recommends = DB::table('recommend')->get();
        return view('admin.recommend.index',['recommends'=>$recommends]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取所有分类
        $cates =  CatesController::getCates();
        return view('admin.recommend.create',['cates'=>$cates]);
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
                'big' => 'required',
                'small' => 'required',
                'cid' => 'required',
                'profile'=>'required',
        ],[
                'big.required' =>'大标题未填写',
                'small.required' =>'小标题未填写',
                'cid.required' => '所属分类未选择',
                'profile.required'=>'图片未上传',
        ]);
        //上传文件
        $path = $request->file('profile')->store(date('Ymd'));
        //接收数据
        $data = $request->except('_token');
        $data['profile'] = $path;
        //存入数据库
        $res = DB::table('recommend')->insert($data);
        if ($res) {
            return redirect('admin/recommend')->with('success','添加成功');
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
        //获取所有分类
        $cates =  CatesController::getCates();
        //获取数据
        $recommend = DB::table('recommend')->where('id',$id)->first();
        return view('admin.recommend.edit',['cates'=>$cates,'recommend'=>$recommend]);
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
                'big' => 'required',
                'small' => 'required',
                'cid' => 'required',
        ],[
                'big.required' =>'大标题未填写',
                'small.required' =>'小标题未填写',
                'cid.required' => '所属分类未选择',
        ]);
        //判断是否有文件上传
        if ( $request->hasFile('profile') ) {
            //有
            $path = $request->file('profile')->store(date('Ymd'));
        } else {
            $path = $request->input('old_profile');
        }
        //接收数据
        $data = $request->except(['_token','_method','old_profile']);
        $data['profile'] = $path;
        //存入数据库
        $res = DB::table('recommend')->where('id',$id)->update($data);
        if ($res) {
            return redirect('admin/recommend')->with('success','修改成功');
        } else {
            return redirect('admin/recommend')->with('success','修改失败');            
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
     //删除数据  
       $res = DB::table('recommend')->where('id',$id)->delete();
       if ( $res ) {
            return redirect('admin/recommend')->with('success','删除成功');
       } else {
        return back()->with('error','删除失败');
       }
    }
}
