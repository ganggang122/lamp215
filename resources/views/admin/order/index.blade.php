@extends('admin.layout.layout')
@section('css')

@show
@section('content')

	<div class="mws-panel grid_8">
    	<div class="mws-panel-header"  style="height:50px">
        	<span><i class="icon-table"></i>订单列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>订单用户</th>
                        <th>商品名称</th>
                        <th>商品数量</th>
                        <th>商品属性一</th>
                        <th>商品属性二</th>
                        <th>商品价格</th>
                        <th>显示状态</th>
                        <th>修改状态</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($order_data as $k=>$v)
						<tr>
							<td>{{$v->id}}</td>
							<td>{{$v->uid}}</td>
							<td  title="{{$v->goods->goodsName}}" style="width:120px;display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis">{{$v->goods->goodsName}}</td>
							<td>{{$v->goodnum}}</td>
							<td >{{$v->specname1}}</td>
							<td >{{$v->specname2}}</td>
							<td >{{$v->goodsprice}}</td>
							@if($v->status == 2)
							<td  >已付款</td>
							<td ><a  href="/admin/order/add/{{$v->id}}">代发货</a></td>
							@endif
							@if($v->status == 3)
							<td style="color:red">待收货</td>
							<td>不能修改</td>
							@endif
							@if($v->status == 4)
							<td style="color:red">待评价</td>
							<td>不能修改</td>
							@endif
							
							
							
						</tr>
                	@endforeach
					<script type="text/javascript">
						function show(id){
							console.log(id)
							$.get('/admin/address/getAddress',{id},function(res){
								$('#add').val(res)
							},'html');
						}

					</script>
					<!-- Button trigger modal -->


					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">收货地址</h4>
					      </div>
					      <div class="modal-body">
					        <form>
								<input style="width:100%;height:45px" type="text" id="add">
					        </form>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
                </tbody>
            </table>
             
        </div>
    </div>
@endsection