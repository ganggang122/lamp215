@extends('admin.layout.layout')

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
	<div class="mws-panel grid_8">
		<form action="/admin/users" method='get'>
			用户名: <input type="text" name='search_uname' value={{$parmas['search_uname'] or ''}}>&nbsp;
			邮箱: <input type="text" name='search_email' value={{$parmas['search_email'] or ''}}>
			<input type="submit" class='btn btn-info'>
		</form>
		<div class="mws-panel-header"  style="height:50px">
	    	<span><i class="icon-table"></i>用 户 列 表</span>
	    </div>
	    <div class="mws-panel-body no-padding">
	        <table class="mws-table">
	            <thead>
	                <tr>
	                	<th>ID</th>
	                    <th>用户名</th>
	                    <th>邮箱</th>
	                    <th>手机</th>
	                    <th>头像</th>
	                    <th>创建时间</th>
	                    <th>操作</th>
	                </tr>
	            </thead>
	            <tbody>
					@foreach($users as $k=>$v)
	                <tr>
	                    <td>{{ $v->id }}</td>
	                    <td>{{ $v->uname }}</td>
	                    <td>{{ $v->email }}</td>
	                    <td>{{ $v->phone }}</td>
	                    <td  align="center" valign="middle">
							<img style='width:130px;border:1px solod #ccc;border-radius:5%' src="/uploads/{{ $v->home->profile }}" alt="">
	                    </td>
	                    <td>{{ $v->created_at }}</td>
	                    <td align="center" valign="middle">
	                    	<a href="/admin/users/{{ $v->id }}/edit" class='btn'>修改</a>&nbsp;
	                    	<form action="/admin/users/{{ $v->id }}" method='post' style='display:inline-block'>
	                    		{{csrf_field()}}
	                    		{{method_field('DELETE')}}
	                    		<input type="submit" value='删除' class='btn btn-danger' >
	                    		
	                    	</form>  
	                    </td>
	                </tr>
					@endforeach
	            </tbody>
	        </table>
	        <div id='page_page'>
	        	{{ $users->appends($parmas)->links() }}	        	
	        </div>

	    </div>
	</div>
@endsection