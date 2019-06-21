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
	<div class="mws-panel-header"  style="height:50px;">
    	<span><i class="icon-pencil"></i>添加权限</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/node" method='post' enctype="multipart/form-data">
    		{{ csrf_field() }}
        	<div class="mws-form-inline">
            	<div class="mws-form-row">
                	<label class="mws-form-label">权限描述</label>
                	<div class="mws-form-item">
                    	<input type="text" name='desc' class="large">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">控制器</label>
                    <div class="mws-form-item">
                        <input type="text" name='cname' class="large">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">方法名</label>
                    <div class="mws-form-item">
                        <input type="text" name='aname' class="large">
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