@extends('admin.layout.layout')

@section('content')

<div class="mws-panel grid_8">
    <div class="mws-panel-header"  style="height:50px">
        <span><i class="icon-table"></i>品牌列表</span>


  
      

    </div>
    <div class="mws-panel-body no-padding">

        <table class="mws-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>所属分类</th>
                <th>品牌名称</th>
                <th>品牌图片</th>
                <th>审核状态</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($brands as $k=>$v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->catesname->cname}}</td>
                <td>{{$v->bname}}</td>

                <td>
                    <img src="{{$v->photo}}" style="width: 80px; height: 80px" alt="">
                </td>
                <td>
                   @if( $v->status == 0 )
                       <span class="btn btn-warning  btn-small">审核中</span>
                   @else
                       <span class="btn btn-primary btn-small">审核通过</span>
                   @endif
                </td>
                <td>{{$v->created_at}}</td>
                <td>
                    <a href="/admin/brands/{{$v->id}}/edit" class="btn btn-success">修改</a>
                    <a href="javascript:;" onclick="delBrands({{$v->id}}, this)" class="btn btn-danger">删除</a>
                @if($v->status == 0)
                        <a href="javascript:;"
                           class="btn btn-primary  btn-small" data-toggle="modal" data-target="#myModal" onclick="changeStatus({{$v->id}}, 0)">
                            <i class="am-icon-archive"></i> 审核通过
                        </a>


                    @else
                        <a href="javascript:;" class="btn btn-warning  btn-small" data-toggle="modal" data-target="#myModal" onclick="changeStatus({{ $v->id }}, 1)">
                            <i class="am-icon-archive"></i> 审核中
                        </a>
                    @endif


                </td>
            </tr>


            @endforeach

            </tbody>

        </table>
        <script>

            function delBrands(id,obj) {

                //询问框
                layer.confirm('您确认删除吗？', {
                    btn: ['确认','取消'] //按钮
                }, function(){
//                如果用户发出删除请求，应该使用ajax向服务器发送删除请求
//                $.get("请求服务器的路径","携带的参数", 获取执行成功后的额返回数据);
                    //admin/user/1
                    $.post("{{url('admin/brands')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
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


            function changeStatus(id,sta){
                if (sta==0) {
                    $('#myModal form input[type=radio]').eq(1).attr('checked',true);
                } else {
                    $('#myModal form input[type=radio]').eq(0).attr('checked',true);
                }
                // $('#myModal form input[type=hidden]').eq(0).val(id);
                $('#asd').val(id);
            }
        </script>


        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">品牌状态</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/admin/brands/changeStatus" method="get">
                            <input type="hidden" name="id" id='asd' value="">
                            <div class="form-group">
                                审核中:<input type="radio" checked name="status" value="0" id="status" >
                                &nbsp; &nbsp;&nbsp;
                                审核通过:<input type="radio" name="status" value="1"  id="status" >
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>

@endsection