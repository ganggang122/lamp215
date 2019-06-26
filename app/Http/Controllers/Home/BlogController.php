<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class BlogController extends Controller
{
    //头条页面
    public function index($id)
    {
    	//获取文章信息
    	$message = DB::table('blog')->where('id',$id)->first();
 
    	//获取下一页文章id
    	$next_id = DB::table('blog')->select('id')->where('id','>',$id)->first();
    	if ( !$next_id ) {
    		//如果已经到最后一页了  则下一页id等于当前id
    		$next_id = $id;
    	} else {
    		$next_id = $next_id->id;
    	}
    	//获取上一页文章id
    	$prev_id = DB::table('blog')->select('id')->where('id','<',$id)->orderBy('id','desc')->first();
    	if ( !$prev_id ) {
    		//如果已经到第一页了 则上一页id 等于当前id
    		$prev_id = $id;
    	} else {
    		$prev_id = $prev_id->id;
    	}
    	return view('home.blog.index',['message'=>$message,'next_id'=>$next_id,'prev_id'=>$prev_id]);
    }
}
