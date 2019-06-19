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
    	<div class="mws-panel-header" style="height:50px">
        	<span>轮播图添加</span>
        </div>
        <div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admin/banners" method="post" enctype="multipart/form-data">
        		{{csrf_field()}}
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">轮播图标题</label>
        				<div class="mws-form-item">
        					<input type="text" name="title" value="{{old('title')}}" class="small">
        				</div>
        			</div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">轮播图描述</label>
                        <div class="mws-form-item">
                            <input type="text" name="desc" value="{{old('desc')}}" class="small">
                        </div>
                    </div>
                    
        			<div class="mws-form-row">
                        <label class="mws-form-label">轮播图连接</label>
                        <div class="mws-form-item" style="width:400px">
                            <input type="file" name="url" value="" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">轮播图所属分类</label>
                        <div class="mws-form-item">
                            <select name="cid" class="small">
                                <option>--请选择--</option>
                                @foreach($cate as $k=>$v)
                                <option value="{{$v->id}}" {{ substr_count($v->path,',') < 2 ? 'disabled' : '' }}>{{$v->cname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">轮播图状态</label>
                        <div class="mws-form-item">
                            激活&nbsp;<input type="radio" name="status" value="1" >
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            未激活&nbsp;<input type="radio" name="status" value="0">
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