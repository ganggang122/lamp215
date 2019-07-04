@extends('admin.layout.layout')
@section('css')

@show
@section('content')
    <div class="mws-panel grid_8" style="margin-left: -37px;">
        <div class="mws-panel-header" style="height:50px">
            <span><i class="icon-table"></i>快递列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>订单号</th>
                    <th>对应商品</th>
                    <th>快递公司</th>
                    <th>快递单号</th>
                    <th>发货时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courier as $k=>$v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->orderinfo['goodnum']}}</td>
                    <td title="{{$v->goods['goodsName']}}" style="width:120px;display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis">{{$v->goods['goodsName']}}</td>
                    <td>{{$v->name}}</td>
                    <td>{{$v->num}}</td>
                    <td>{{$v->created_at}}</td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection


