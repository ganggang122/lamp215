@extends('admin.layout.layout');

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
        	<span>栏目添加</span>
        </div>
        <div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admin/cates" method="post" enctype="multipart/form-data">
        		{{csrf_field()}}
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">栏目名称</label>
        				<div class="mws-form-item">
        					<input type="text" name="cname" value="{{old('uname')}}" class="small">
        				</div>
        			</div>
        			<div class="mws-form-row">
        				<label class="mws-form-label">栏目名称</label>
        				<div class="mws-form-item">
        					<select name="pid" class="small">
        						<option value="0">--请选择--</option>
        						@foreach($cates as $k=>$v)
        						<option value="{{$v->id}}" {{ substr_count($v->path,',') >= 2 ? 'disabled' : ''}}>{{$v->cname}}</option>
        						@endforeach
        					</select>
        				</div>
        			</div>
        		<div class="mws-button-row">
        			<input type="submit" value="Submit" class="btn btn-danger">
        			<input type="reset" value="Reset" class="btn ">
        		</div>
        	</form>
        </div>    	
    </div>
	
@endsection