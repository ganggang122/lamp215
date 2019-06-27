@extends('admin.layout.layout')

@section('content')
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header"  style="height:50px;">
                    	<span><i class="icon-table"></i>推荐列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CID</th>
                                    <th>大标题</th>
                                    <th>小标题</th>
                                    <th>图片</th>
                                    <th>状态</th>
                                    <th style="text-align:center;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                     			@foreach( $recommends as $v )
                     				<tr>
                     					<td>{{ $v->id }}</td>
                     					<td>{{ $v->cid }}</td>
                     					<td>{{ $v->big }}</td>
                     					<td>{{ $v->small }}</td>
                                        <td>
                                            <img src="/uploads/{{ $v->profile }}" style='width:150px;border-radius:5%'>
                                        </td>
                     					<td>{{ $v->status == 1 ? '未启用' :'启用' }}</td>
                     					<td > 
                                            <button class='btn' onclick='changeTop({{$v->id}})'>置顶</button>
                     						<button onclick='changeStatus({{$v->id}},this)' class='btn btn-info'>{{ $v->status ==1 ?'开启':'关闭'  }}</button>
                     						<a href='/admin/recommend/{{ $v->id }}/edit' class='btn btn-primary'>修改</a>
                     						
                                            <form action='/admin/recommend/{{ $v->id }}' method='post' style='display:inline-block'>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class='btn btn-danger'>删除</button>
                                            </form>
                                           
                     					</td>
                     				</tr>
                     			@endforeach
                            </tbody>
                        </table>
                    </div><!-- Large modal -->
                </div>
        		<script type="text/javascript">
        			function changeStatus(id,obj)
        			{
        				$.get('/admin/recommend/changeStatus',{id},function(res){
        					if( res == 'ok') {
	  							if ( $(obj).html() =='开启' ) {
	  								$(obj).html('关闭')
	  								$(obj).parent().prev().html('启用');
	  							} else {
	  								$(obj).html('开启')
	  							$(obj).parent().prev().html('未启用');

	  							}	        						
        					}
          				},'html')
        			}

                    function changeTop(id)
                    {
                        $.get('/admin/recommend/changeTop',{id},function(res){
                               
                        },'html')
                    }
        		</script>        
@endsection