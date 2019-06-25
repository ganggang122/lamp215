@extends('admin.layout.layout')

@section('content')

	<div class="mws-panel grid_8">
                	<div class="mws-panel-header" style="height:50px;">
                    	<span><i class="icon-table"></i>规格列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>规格名称</th>
                                    <th>所属分类</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($specific_data  as  $k=>$v)
                                <tr>
                                    <td align="center">{{$v->id }}</td>
                                    <td align="center">{{$v->specname }}</td>
                                    <td align="center">{{$v->specific->cname }}</td>
                                   
                                    <td align="center">
                                    	
                                    	<form action='/admin/specific/{{$v->id4}}'  method='post' style='display:inline-block'>
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