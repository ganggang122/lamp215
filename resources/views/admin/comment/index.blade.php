@extends('admin.layout.layout')
@section('css')

@show
@section('content')
    <div class="mws-panel grid_8" style="margin-left: -37px;">
        <div class="mws-panel-header" style="height:50px">
            <span><i class="icon-table"></i>评论列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>评论用户</th>
                    <th >评论商品</th>
                    <th>评论内容</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comment as $k=>$v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->nickname}}</td>
                    <td title="{{$v->goods['goodsName']}}" style="width:120px;display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis">{{$v->goods['goodsName']}}</td>
                    <td>{{$v->content}}</td>
                    <td>{{$v->created_at}}</td>
                    <td >
                        <a href="javascript:;" class="btn btn-danger" onclick="commentdel('{{$v->id}}',this)" >删除</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <script>
                function commentdel(id,obj) {
                    layer.confirm('您确认删除该评论吗？', {
                        btn: ['确认','取消'] //按钮
                    }, function(){
                        $.get('/admin/comment/destroy/'+id,function(data) {
                            if(data.error == 0){
                                layer.msg(data.msg, {icon: 6});
                                $(obj).parent().parent().remove();
                            }else {
                                layer.msg(data.msg, {icon: 5});

                                var t=setTimeout("location.href = location.href;",2000);
                            }

                        });
                    }, function(){

                    });
                }
            </script>
        </div>
    </div>
@endsection


