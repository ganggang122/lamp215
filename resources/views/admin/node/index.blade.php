@extends('admin.layout.layout')

@section('content')
	<div class="mws-panel grid_8">
                	<div class="mws-panel-header"  style="height:50px;">
                    	<span><i class="icon-table"></i>权限列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>权限名称</th>
                                    <th>控制器</th>
                                    <th>方法名</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nodes as $v)
                                    <tr>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->desc }}</td>
                                        <td>{{ $v->cname }}</td>
                                        <td>{{ $v->aname }}</td>
                                        <td>
                                            <form action='/admin/node/{{ $v->id }}' method='post' style='display:inline-block'>
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