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
    	<span><i class="icon-pencil"></i>管 理 员 添 加</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/adminuser/{{$user->id}}" method='post' enctype="multipart/form-data">
    		{{ csrf_field() }}
    		{{ method_field('PUT') }}
        	<input type='hidden' name='old_profile' value='{{ $user->profile }}'>
        	<div class="mws-form-inline">
            	<div class="mws-form-row">
                	<label class="mws-form-label">用 户 名</label>
                	<div class="mws-form-item">
                    	<input type="text" name='uname' class="large" value='{{ $user->uname }}'>
                    </div>
                </div>
            	<div class="mws-form-row">
                	<label class="mws-form-label">新 密 码</label>
                	<div class="mws-form-item">
                    	<input type="password" name='upass' class="large">
                    </div>
                </div>
            	<div class="mws-form-row">
                	<label class="mws-form-label">确 认 密 码</label>
                	<div class="mws-form-item">
                    	<input type="password" name='repass' class="large">
                    </div>
                </div>
            	<div class="mws-form-row">
                	<label class="mws-form-label">头 像</label>
                	<div class="mws-form-item">
                    	<input type="file" name='profile' style='width:100px'>
                    	<img src="/uploads/{{ $user->profile }}" style='width:120px;border-radius:5%'>
                    </div>

                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">职 位 选 择</label>
                        <div class="mws-form-item clearfix">
                            <ul class="mws-form-list inline">
                                @foreach($role_data as $v)
                                <li><input type="radio" name='rid' value='{{ $v->id }}' {{ $v->id == $rid->rid ? 'checked':'' }}  > <label>{{ $v->rname }}</label></li>
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