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
            <span>新闻添加</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/admin/news" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">新闻标特</label>
                        <div class="mws-form-item">
                            <input type="text" name="title" value="{{old('title')}}" class="small">
                        </div>
                    </div>
                     <div class="mws-form-row">
                        <label class="mws-form-label">新闻图片</label>
                        <div class="mws-form-item" style="width:500px">
                            <input type="file" name="image" value="" class="small">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">新闻内容</label>
                        <div class="mws-form-item">
                            <input type="text" name="content" value="{{old('content')}}" class="small">
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