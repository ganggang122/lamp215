@extends('admin.layout.layout')

@section('content')
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i>品牌列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>商品编号</th>
                    <th>商品图片</th>
                    <th>商品名称</th>
                    <th width="90px">所属分类</th>
                    <th width="90px">所属品牌</th>
                    <th>市场价格</th>
                    <th>店铺价格</th>
                    <th>商品状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($goods as $k=>$v)
                    <tr>
                        <td>{{$v->id}}</td>
                        <td>{{$v->goodsNum}}</td>
                        <td>
                            <img src="{{$v->goodsinfo['goodsPhotoinfo1']}}" alt="">
                        </td>
                        <td>{{$v->goodsName}}</td>
                        <td>{{$v->goodscate['cname']}}</td>
                        <td>{{$v->goodsbrand['bname']}}</td>
                        <td>{{$v->marketPrice}}</td>
                        <td>{{$v->shopPrice}}</td>
                        <td ondblclick="status({{$v->goodsStatus}},{{$v->id}})">
                            @if( $v->status == 1 )
                                <span class="btn btn-warning  btn-small">上架</span>
                            @else
                                <span class="btn btn-primary btn-small">下架</span>
                            @endif
                        </td>
                        <td>{{$v->created_at}}</td>
                        <td>
                            <a href="/admin/brands/{{$v->id}}/edit" class="btn btn-success">修改</a>
                            <a href="javascript:;" onclick="delGoods({{$v->id}}, this)" class="btn btn-danger">删除</a>
                            @if($v->status == 0)
                                <a href="javascript:;"
                                   class="btn btn-primary  btn-small" data-toggle="modal" data-target="#myModal" onclick="changeStatus({{$v->id}}, 0)">
                                    <i class="am-icon-archive"></i> 下架
                                </a>


                            @else
                                <a href="javascript:;" class="btn btn-warning  btn-small" data-toggle="modal" data-target="#myModal" onclick="changeStatus({{ $v->id }}, 1)">
                                    <i class="am-icon-archive"></i> 上架
                                </a>
                            @endif


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <script>

                function status(status,id) {

                    // 发送ajax
                    $.get('/admin/goods/show',{id}, function (res) {



                    });
                }
                function delGoods(id,obj) {

                    //询问框
                    layer.confirm('您确认删除吗？', {
                        btn: ['确认','取消'] //按钮
                    }, function(){
//                如果用户发出删除请求，应该使用ajax向服务器发送删除请求
//                $.get("请求服务器的路径","携带的参数", 获取执行成功后的额返回数据);
                        //admin/user/1
                        $.post("{{url('admin/goods')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
//                    data是json格式的字符串，在js中如何将一个json字符串变成json对象
                            //var res =  JSON.parse(data);
//                    删除成功
                            if(data.error == 0){
                                //console.log("错误号"+res.error);
                                //console.log("错误信息"+res.msg);
                                layer.msg(data.msg, {icon: 6});
//                       location.href = location.href;
                                //var t=setTimeout("location.href = location.href;",2000);
                                $(obj).parent().parent().remove();
                            }else if(data.error == 1){
                                layer.msg(data.msg, {icon: 5});

                                var t=setTimeout("location.href = location.href;",2000);
                                //location.href = location.href;
                            }else {
                                layer.msg(data.msg, {icon: 5});

                            }


                        });


                    }, function(){

                    });
                }
            </script>
        </div>
    </div>
@endsection