@extends('admin.layout.layout')

@section('content')
@if (count($errors) > 0)
    <div class="mws-form-message error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-pencil"></i>岗位编辑</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/role/{{ $role->id }}" method='post' enctype="multipart/form-data">
    		{{ csrf_field() }}
    		{{ method_field('PUT') }}
        	<div class="mws-form-inline">
            	<div class="mws-form-row">
                	<label class="mws-form-label">岗位名称 </label>
                	<div class="mws-form-item">
                    	<input type="text" name='rname' class="large" value='{{ $role->rname }}'>
                    </div>
                </div>
                <div class="mws-form-row">
                    				<label class="mws-form-label">岗位权限</label>
                    				<div class="mws-form-item clearfix">
                    					<ul class="mws-form-list inline">
                                            @foreach($nodes_data as $k=>$v)
                                            <h3>{{ $cnames[$k] }}<small>{{ $k }}</small></h3>
                                                @foreach($v as $vv)
                    						      <li><input type="checkbox" value='{{$vv->id}}' name='nid[]' {{ $vv->flag ? 'checked':'' }}> <label>{{ $vv->desc }}</label></li>
                    					        @endforeach
                                            @endforeach
                                        </ul>
                    				</div>
                    			</div>               
				<div class="mws-button-row">
                    <input type="submit" value="Submit" class="btn btn-danger">
                    <input type="reset" value="Reset" class="btn ">
                </div>
            </div>
        </form>
    </div>    	
</div>
	

@endsection