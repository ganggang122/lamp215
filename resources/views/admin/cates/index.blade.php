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
                        <th>栏目名称</th>
                        <th>父级id</th>
                        <th>分类路径</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($cates as $k=>$v)
                    <tr>
                        <td>{{$v->id}}</td>
                        <td>{{$v->cname}}</td>
                        <td>{{$v->pid}}</td>
                        <td>{{$v->path}}</td>
                        <td>
                            @if(substr_count($v->path,',') < 2)
							<a href="/admin/cates/create?id={{$v->id}}" class="btn btn-success">添加子类分类</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
             
        </div>
    </div>
@endsection