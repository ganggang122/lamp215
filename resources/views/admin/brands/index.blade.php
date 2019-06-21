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
                <th>所属分类</th>
                <th>品牌名称</th>
                <th>品牌图片</th>
                <th>审核状态</th>
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
                <td>
                    <a href="/admin/brands/{{$v->id}}/edit" class="btn btn-success">修改</a>
                    <form action="/admin/brands/{{ $v->id }}" method="post" style="display: inline-block;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="删除" class="btn btn-danger">
                    </form>

                    @if($v->status == 0)
                        <a href="javascript:;"
                           class="btn btn-primary  btn-small"  onclick="changeStatus({{ $v->bid }}, 0)">
                            <i class="am-icon-archive"></i> 审核通过
                        </a>


                    @else
                        <a href="javascript:;" class="btn btn-warning  btn-small"  onclick="changeStatus({{ $v->bid }}, 1)">
                            <i class="am-icon-archive"></i> 审核中
                        </a>
                    @endif


                </td>
            </tr>


            @endforeach

            </tbody>

        </table>

       {{-- <script>
            function changeStatus(id, status) {

                console.log(status);

                if (status == 1) {
                    // 赋值
                    $('#myModal form input[type=radio]').eq(1).attr('checked', true);
                }else {
                    $('#myModal form input[type=radio]').eq(0).attr('checked', true);

                }

                $('#myModal form input[type=hidden]').eq(0).val(id);

                $('#myModal').modal('show')
            }

        </script>--}}
        {{--model--}}


    </div>
</div>
<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable ui-dialog-buttons" tabindex="-1" style="outline: 0px; z-index: 1002; position: absolute; height: auto; width: 640px; top: 2524px; left: 337px; display: block;" role="dialog" aria-labelledby="ui-id-5"><div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-5" class="ui-dialog-title">jQuery-UI Dialog</span><a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button"><span class="ui-icon ui-icon-closethick">close</span></a></div><div id="mws-jui-dialog" class="ui-dialog-content ui-widget-content" scrolltop="0" scrollleft="0" style="width: auto; min-height: 10px; height: auto;">
        <div class="mws-dialog-inner">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi tellus, faucibus tristique faucibus sit amet, lacinia at velit. Proin pretium vulputate orci, nec luctus odio volutpat ac. Curabitur semper adipiscing tellus sed venenatis. Integer vitae diam dui. Ut ut quam ac ante eleifend aliquam. Cras tincidunt pulvinar sollicitudin. Nullam mattis justo nec nisl adipiscing ullamcorper. Curabitur fermentum egestas massa, eu dictum ligula accumsan id. Duis elit arcu, adipiscing vel consectetur ac, fermentum ac nisl. Quisque varius ipsum vitae mauris cursus eu tristique velit dapibus. Cras eu viverra neque.</p>
        </div>
         <script>
@endsection