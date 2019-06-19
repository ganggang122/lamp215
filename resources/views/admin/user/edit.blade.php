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
        	<span>修 改 用 户</span>
        </div>
        <div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admin/users/{{ $user->id }}" method='post' enctype="multipart/form-data">
        		{{ csrf_field() }}
                {{ method_field('PATCH') }}
                <input type="hidden" name='old_profile' value='{{ $user->userInfo->profile }}'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">用 户 名</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='uname' disabled value={{ $user->uname }}>
        				</div>
        			</div>
         			<div class="mws-form-row">
        				<label class="mws-form-label">邮 箱</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='email' value={{ $user->email }}>
        				</div>
        			</div>
           			<div class="mws-form-row">
        				<label class="mws-form-label">手 机</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='phone' value={{ $user->phone }}>
        				</div>
        			</div>
         			<div class="mws-form-row" >
        				<label class="mws-form-label">头 像</label>
        				<div class="mws-form-item" style='width:395px'>
        					<input type="file" class="small" name='profile'>
                            <img style='width:200px;' src="/uploads/{{$user->userInfo->profile}}" alt="">
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