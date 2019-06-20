@extends('admin.layout.layout')

@section('content')
	<div class="mws-panel grid_8">
                	<div class="mws-panel-header"  style="height:50px;">
                    	<span><i class="icon-table"></i>岗位列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>职位名称</th>
                                    <th>权限</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($role_data as $v)
                                    <tr>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->rname }}</td>
                                        <td>
                                            @foreach($v->node_name as $vv)
                                                {{ $vv->desc }}，
                                            @endforeach
                                        </td>
                                        <td align='center'>
                                            <a href="/admin/role/{{ $v->id }}" class='btn btn-info'>修改权限</a>
                                        </td>
                                    </tr>
                               @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>	
@endsection