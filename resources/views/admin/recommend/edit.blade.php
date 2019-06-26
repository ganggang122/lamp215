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
    	<span><i class="icon-pencil"></i>添加推荐</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/recommend/{{ $recommend->id }}" method='post' enctype="multipart/form-data">
    		{{ csrf_field() }}
    		{{ method_field('PUT') }}
    		<input type='hidden' name='old_profile' value='{{ $recommend->profile }}'>
        	<div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">所属分类</label>
                    <div class="mws-form-item">
                        <select name='cid'>
                             <option ></option>
                             @foreach($cates as $v)
                             <option value='{{ $v->id }}' {{ $recommend->cid==$v->id?'selected':'' }} {{ substr_count($v->path,',') <= 1 ? 'disabled' : ''}}   >{{ $v->cname }}</option>
                             @endforeach
                        </select>
                    </div>
                </div>
            	<div class="mws-form-row">
                	<label class="mws-form-label">大标题</label>
                	<div class="mws-form-item">
                    	<input type="text" name='big' value='{{ $recommend->big }}' class="large">
                    </div>
                </div>
            	<div class="mws-form-row">
                	<label class="mws-form-label">小标题</label>
                	<div class="mws-form-item">
                    	<input type="text" name='small' value='{{ $recommend->small }}' class="large">
                    </div>
                </div>                
            	<div class="mws-form-row">
                	<label class="mws-form-label">图片</label>
                	<div class="mws-form-item">
                    	<input type="file" name='profile' class="large">
                    	<img src="/uploads/{{ $recommend->profile }}" style='width:200px;border-radius:5%'>
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