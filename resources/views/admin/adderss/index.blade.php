@extends('admin.layout.layout')
@section('css')
	<style type="text/css">
		#abc ul,#abc li{
			margin:0;
			padding:0;
			list-style-type: none;
		}
		#abc a,#abc span{
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

		#abc .active span{
			background-color: #1BE7ED;
			color:#fff;
		}
	</style>

@show
@section('content')
	
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header"  style="height:50px">
        	<span><i class="icon-table"></i> 栏目列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>收货人名称</th>
                        <th>收货人手机号</th>
                        <th>收货地址</th>
                        <th>用户名称</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($address as $k=>$v)
						<tr>
							<td style="width:50px">{{$v->id}}</td>
							<td style="width:60px">{{$v->uname}}</td>
							<td style="width:100px">{{$v->phone}}</td>
							<td ><span  style="width:100px;display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="{{$v->address}}">{{$v->address}}</span></td>
							<td style="width:100px">
								@if(empty($v->getUserAddress->uname) &&empty($v->getUserAddress->phone))
								<span>{{$v->getUserAddress->email}}</span>
								@elseif(empty($v->getUserAddress->email) &&empty($v->getUserAddress->phone))
								<span>{{$v->getUserAddress->uname}}</span>
								@elseif(empty($v->getUserAddress->email) &&empty($v->getUserAddress->uname))
								<span>{{$v->getUserAddress->phone}}</span>
								@endif
								<!-- {{$v->getUserAddress}} -->
							</td>
							<td>
								<button type="button" onclick="show({{$v->id}})" class="btn btn-primary " data-toggle="modal" data-target="#myModal">
								  查看详情
								</button>
									<form action="/admin/address/{{ $v->id }}" method='post' style='display:inline-block'>
			                            {{csrf_field()}}
			                            {{method_field('DELETE')}}
			                            <input type="submit" value='删除' class='btn btn-danger' >
	                                
			                        </form> 
							</td>
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