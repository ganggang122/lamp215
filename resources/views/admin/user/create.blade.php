@extends('admin.layout.layout')

@section('content')
	<div class="mws-panel grid_8">
        @if (count($errors) > 0)
        <div class="mws-form-message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
   		@endif
    	<div class="mws-panel-header">
        	<span>添 加 用 户</span>
        </div>
        <div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admin/users" method='post' enctype="multipart/form-data">
        		{{csrf_field()}}
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">用 户 名</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='uname' value={{old('uname')}}>
        				</div>
        			</div>
         			<div class="mws-form-row">
        				<label class="mws-form-label">密 码</label>
        				<div class="mws-form-item">
        					<input type="password" class="small" name='upass'>
        				</div>
        			</div>
         			<div class="mws-form-row">
        				<label class="mws-form-label">确 认 密 码</label>
        				<div class="mws-form-item">
        					<input type="password" class="small" name='repass'>
        				</div>
        			</div>
         			<div class="mws-form-row">
        				<label class="mws-form-label">邮 箱</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='email' value={{old('email')}}>
        				</div>
        			</div>
           			<div class="mws-form-row">
        				<label class="mws-form-label">手 机</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='phone' value={{old('phone')}}>
        				</div>
        			</div>
         			<div class="mws-form-row" >
        				<label class="mws-form-label">头 像</label>
        				<div class="mws-form-item" style='width:395px'>
        					<input type="file" class="small" name='profile'>
        				</div>
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