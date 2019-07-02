<?php

namespace App\Http\Controllers\Home;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //获取评论列表加载到页面
    public function index($gid)
    {
        $data=array();
        $data=$this->getCommlist($gid);//获取评论列表
        return $data;
//        return view('home.comment',compact('data'));
//        return $data[0]->children;
        //dd($data[0]->children);
    }
    /**
     *递归获取评论列表
     */
    protected function getCommlist($id,$parent_id = 0,&$result = array()){
        $arr = Comment::where('gid', $id)->where('parent_id',$parent_id)->orderBy('created_at','desc')->get();
       
       
        if(empty($arr)){
            return array();
        }
        foreach ($arr as $cm) {
            $thisArr=&$result[];
            $cm["children"] = $this->getCommlist($id,$cm["id"],$thisArr);
            $thisArr = $cm;
        }
        return $result;
    }
    
    /**
     *添加评论
     */
    public function addComment(){
        $data=array();
        
        if((isset($_POST["comment"]))&&(!empty($_POST["comment"]))){
            $cm = json_decode($_POST["comment"],true);//通过第二个参数true，将json字符串转化为键值对数组
            $cm = Comment::create($cm);
            $data = $cm;
        }else{
            $data["error"] = "0";
        }
        echo json_encode($data);
    }
    
    
}
