@extends('admin.layout.layout')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{--<link rel="stylesheet" href="/h/css/AdminLTE.min.css">--}}
<link rel="stylesheet" href="/h/css/font-awesome.min.css">
@section('css')
    <style type="text/css">

        #page_page ul li{
            list-style-type:none;
        }
        #page_page a,#page_page span{
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        #page_page .active span{
            background-color:#9BE7ED;
        }
    </style>

@endsection
@section('content')
    <div class="mws-panel grid_8" style="margin-left: -25px;">
        <small id="info"></small>
        <form action="/admin/goods" method='get'>
            商品编号: <input type="text" name='search_num' value={{$parmas['search_num'] or ''}}>&nbsp;
            商品名称: <input type="text" name='search_name' value={{$parmas['search_name'] or ''}}>
            {{--商品分类: <select class="required large" name="cid" >
                        <option value="">请选择</option>
                        @foreach($goodsCate as $k=>$v)
                            <option value="{{$v->id}}"  {{ substr_count($v->path,',') <=1 ? 'disabled' : ''}}>{{$v->cname}}</option>
                        @endforeach
                    </select>

            商品品牌:  <select class="required large" name="bid"  >
                        <option value="">请选择</option>
                        @foreach($brandName as $k=>$v)
                            <option value="{{$v->id}}"  >{{$v->bname}}</option>
                        @endforeach
                    </select>
            商品状态:--}}
            <input type="submit" class='btn btn-info'>
        </form>
        <div class="mws-panel-header" style="height:50px">
            <span><i class="icon-table"></i>品牌列表 &nbsp;&nbsp;&nbsp;
                <span style="float: right; color:  #dd4b39; font-size: 13px;"> * 双击可修改商品名称和商品状态</span>
            </span>

        </div>
        <div class="mws-panel-body no-padding" >

            <table class="mws-table" >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>商品编号</th>
                    <th>商品图片</th>
                    <th>商品名称</th>
                    <th>所属分类</th>
                    <th>所属品牌</th>
                    <th>市场价格</th>
                    <th>店铺价格</th>
                    <th>商品状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                @if(session('info'))
                    <div class="alert alert-danger">{{session('info')}}</div>

                @endif
                <tbody>
                @foreach($goods as $k=>$v)

                    <tr>
                        <td class="ids">{{$v->id}}</td>
                        <td  title="{{$v->goodsNum}}" >{{$v->goodsNum}}</td>
                        <td>
                            <img src="{{$v->goodsinfo['goodsPhotoinfo1']}}" alt="" id="img1" onclick="edit">

                        </td>
                        <td >
                            <p title="{{$v->goodsName}}" class="name" ondblclick="editName({{$v->id}},this)" style="width:120px;display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis" >{{$v->goodsName}}</p>
                        </td>
                        <td>{{$v->goodscate['cname']}}</td>
                        <td>{{$v->goodsbrand['bname']}}</td>
                        <td>{{$v->marketPrice}}</td>
                        <td>{{$v->shopPrice}}</td>
                        <td ondblclick="status({{$v->id}},this)" id="status">
                            @if( $v->goodsStatus == 1 )
                                <span class="btn btn-warning  btn-small">上架</span>
                            @else
                                <span class="btn btn-primary btn-small">下架</span>
                            @endif
                        </td>
                        <td  >{{$v->created_at}}</td>
                        <td>
                            <a href="/admin/goods/{{$v->id}}/edit" class="btn btn-success">修改</a>
                            <a href="javascript:;" onclick="delGoods({{$v->id}}, this)" class="btn btn-danger">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <script>

                function status(id,obj) {
                    let t = $(obj);
                    // 发送ajax
                    $.get('/admin/goods/'+id, function (res) {
                        if (res.goodsStatus == 1) {
                            t.html('<button type="button" class="btn btn-warning  btn-small">上架</button>');
                        }else {
                            t.html('<button type="button" class="btn btn-primary btn-small">下架</button>');
                        }

                    },'json');
                }

                // 修改商品名
                function editName(id, obj) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    let t = $(obj);
                    var name = t.html();
                    var inp = $('<input type="text" >');
                    inp.val(name);
                    t.html(inp);
                    inp.select();

                    inp.on('blur', function () {
                        var newName = $(this).val();
                        $.ajax({
                            url:"{{ url('/admin/goods/ajaxname') }}",
                            type:'post',
                            data:{id:id, name:newName},
                            beforeSend:function()
                            {
                                $("#info").html('<span class="text-red" style="font-size: 18px; color: #dd4b39 ;"><i class="fa fa-fw fa-spin fa-circle-o-notch"></i >正在修改中...</span>');
                                $("#info").show();
                            },
                            success:function (data) {
                                if(data.code == 0)
                                {
                                    t.html(name);
                                    $("#info").html('<span class="text-red" style="font-size: 18px; color: #dd4b39 ;">商品名称已经存在</span>');
                                    $("#info").show();
                                    $("#info").fadeOut(1000);
                                }else if(data.code == 1)
                                {

                                    t.html(newName);
                                    $("#info").html('<span class="text-red" style="font-size: 18px; color: #dd4b39 ;">修改成功</span>');
                                    $("#info").show();
                                    $("#info").fadeOut(1000);
                                }else {
                                    t.html(name);
                                    $("#info").html('<span class="text-red" style="font-size: 18px; color: #dd4b39 ;">修改失败</span>');
                                    $("#info").show();
                                    $("#info").fadeOut(1000);
                                }
                            },
                            error:function () {

                            },
                            dataType:'json',
                        });
                        // 添加事件。
                        t.on('dblclick',editName);
                    });
                    t.off('dblclick');
                }
                /*$(".name").on('dblclick', fn1);
                function fn1() {
                    var t = $(this);
                    var id = t.parent().find('.ids').html();
                    console.log(id);
                }*/
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
            <div id='page_page' style="margin: auto; margin-left: 500;">
                {{ $goods->appends($params)->links() }}
            </div>
        </div>
    </div>
@endsection