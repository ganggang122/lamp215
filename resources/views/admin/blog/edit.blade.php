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
        	<span>头条添加</span>
        </div>
        <div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admin/blog/{{$message->id}}" method="post" enctype="multipart/form-data">
        		{{ csrf_field() }}
        		{{ method_field('PUT') }}
        		<div class="mws-form-inline" >
        			<div class="mws-form-row"   >
        				<label class="mws-form-label">头条标题</label>
        				<div class="mws-form-item">
        					<input type="text" name="title" value="{{ $message->title }}" class="small">
        				</div>
        			</div>
        			<div class="mws-form-row"   >
        				<label class="mws-form-label">头条内容</label>
        				<div class="mws-form-item" class='small'>
						    <!-- 加载编辑器的容器 -->
						    <script id="container" name="content" type="text/plain"  style='height:300px'>
						    	{!! $message->content !!}
						    </script>
						    <!-- 配置文件 -->
						    <script type="text/javascript" src="/d/utf8-php/ueditor.config.js"></script>
						    <!-- 编辑器源码文件 -->
						    <script type="text/javascript" src="/d/utf8-php/ueditor.all.js"></script>
						    <!-- 实例化编辑器 -->
						    <script type="text/javascript">
						        var ue = UE.getEditor('container');
						    </script>        				
        				</div>
        			</div>
        			<div class="mws-form-row"   >
        				<label class="mws-form-label">置顶</label>
        				<div class="mws-form-item">
        					<input type='radio' name='top' value='0' {{ $message->top ==0 ? 'checked':'' }}>否&nbsp;&nbsp;
        					<input type='radio' name='top' value='1' {{ $message->top ? 'checked':'' }}  >是
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