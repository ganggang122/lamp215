<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    // 引入评论列表页
    public function index()
    {
        $comment = Comment::where('parent_id', 0)->get();
    
        return view('admin.comment.index', [
            'comment' => $comment,
        ]);
    }
    
    // 删除评论
    public function destroy($id)
    {
        $res = Comment::destroy($id);
        if ($res) {
            $data['error'] = 0;
            $data['msg'] = '删除订单成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '删除订单失败';
        }
    
        return $data;
    }
    
}
