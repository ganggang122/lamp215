<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cate;
use App\Models\Specific;

class SpecificController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cates_data  = Cate::get();
        $specific_data  = Specific::get();

        return view('admin.specific.index' , ['cates_data'=>$cates_data , 'specific_data'=>$specific_data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $cates_data  = Cate::get();
        return  view('admin.specific.create',['cates_data' => $cates_data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'cid' => 'required',
            'specificname' => 'required',
        ],[
            'cid.required'=>'分类名称必填',
            'specificname.required' => '规格名称必填'
        ]);

         $spdata = new  Specific;

         $spdata->cid = $request->input('cid', 0);
         $spdata->specname = $request->input('specificname' , '');

         $res = $spdata->save();

         if(!$res){
         	return back()->with('error' ,'添加失败');
         }else{
         	return redirect('admin/specific')->with('success' ,'添加成功');
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
        $res = Specific::destroy($id);
        if($res){
        	return back()->with('error' ,'删除成功');
        }else{
        	return back()->with('success' , '删除失败');
        }
    }
}
