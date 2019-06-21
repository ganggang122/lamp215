@extends('admin.layout.layout')

@section('content')

	<div class="mws-panel grid_8">
                	<div class="mws-panel-header"    style="height:50px;">
                    	<span><i class="icon-table"></i>管理员列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>职位</th>
                                    <th>头像</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($admins as $v)
                                <tr>
                                    <td align="center">{{ $v->id }}</td>
                                    <td align="center">{{ $v->uname}}</td>
                                    <td align="center">{{ $v->rname }}</td>
                                    <td align="center">
                                    	<img src="/uploads/{{ $v->profile }}" style='width:150px;border-radius:5%'>
                                    </td>
                                    <td align="center">
                                    	<a href="/admin/adminuser/{{ $v->id }}/edit" class='btn btn-info'>修改</a>&nbsp;&nbsp;&nbsp;
                                    	<form action='/admin/adminuser/{{ $v->id }}'  method='post' style='display:inline-block'>
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class='btn btn-danger'>删除</button>   
                                        </form>
                                        

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

@endsection