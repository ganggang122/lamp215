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
                        <th>商品ID</th>
                        <th>商品数量</th>
                        <th>商品属性一</th>
                        <th>商品属性二</th>
                        <th>商品价格</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($order_data as $k=>$v)
						<tr>
							<td style="width:50px">{{$v->id}}</td>
							<td style="width:50px">{{$v->uid}}</td>
							<td style="width:60px">{{$v->goods->goodsName}}</td>
							<td style="width:100px">{{$v->goodnum}}</td>
							<td style="width:100px">{{$v->specname1}}</td>
							<td style="width:100px">{{$v->specname2}}</td>
							<td style="width:100px">{{$v->goodsprice}}</td>

							
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