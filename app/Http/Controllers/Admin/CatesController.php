<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use DB;
class CatesController extends Controller
{
    public static function getCates()
    {
        $cates = Cate::select('*',DB::raw("concat(path,',',id) as paths"))->orderBy('paths','asc')->get();
        foreach ($cates as $key => $value) {
            $n = substr_count($value->path,',');
            $cates[$key]->cname = str_repeat('|-----',$n).$value->cname;
        }
        return $cates;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.cates.index',['cates'=>self::getCates()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id',0);
        return view('admin.cates.create',['id'=>$id,'cates'=>self::getCates()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request, [
            'cname' => 'required',
        ],[
            'cname.required' => '栏目必填',
        ]);
        //获取pid
        $pid = $request->input('pid',0);
        if ($pid==0) {
            $path = 0;
        } else {
            $cates_path = Cate::find($pid);
            $path = $cates_path->path.','.$cates_path->id;
        }
        //压入数据
        $cates = new Cate;
        $cates->cname = $request->input('cname','');
        $cates->path= $path;
        $cates->path= $path;
        $cates->pid= $pid;
        $res = $cates->save();
         if ($res) {
            return redirect('admin/cates')->with('success','添加成功');
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
