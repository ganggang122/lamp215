@extends('admin.layout.layout')

@section('content')
	<div class="mws-panel grid_8">
                	<div class="mws-panel-header"  style="height:50px;">
                    	<span><i class="icon-table"></i>头条列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th>是否置顶</th>
                                    <th>发布时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($blogs as $v)
                            		<tr>
                            			<td>{{ $v->id }}</td>
                            			<td>{{ $v->title }}</td>
                            			<td>{{ $v->top }}</td>
                            			<td>{{ $v->created_at }}</td>
                            			<td>
                            			<button onclick='look({{ $v->id }})' type="button"  data-toggle="modal" data-target="#myModal" class='btn btn-primary' >查看内容</button>
											 
                            				<a href="/admin/blog/{{ $v->id }}/edit" class='btn btn-info'>修改</a>
                            				<form action='/admin/blog/{{ $v->id }}' method='post' style='display:inline-block'>
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
	function look(id)
	{
		$.get('/admim/blog/msg',{id:id},function(res){
				$('#blog_content').html(res);
		},'html')
	}
</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body" id='blog_content'>
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection