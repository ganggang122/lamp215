@extends('admin.layout.layout')
@section('css')

@show
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
            <span>快递添加</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/admin/order/courier" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="oid" value="{{$oid}}">
                <input type="hidden" name="gid" value="{{$gid}}">
                <div class="mws-form-inline" >
                    <div class="mws-form-row"   >
                        <label class="mws-form-label">快递公司</label>
                        <div class="mws-form-item">
                            <input type="text" name="name" value="{{old('name')}}" class="small">
                        </div>
                    </div>
                    <div class="mws-form-inline" >
                        <div class="mws-form-row"   >
                            <label class="mws-form-label">快递单号</label>
                            <div class="mws-form-item">
                                <input type="text" name="num" value="{{old('name')}}" class="small">
                            </div>
                        </div>
                    <div class="mws-button-row">
                        <input type="submit" value="Submit" class="btn btn-danger">
                        <input type="reset" value="Reset" class="btn ">
                    </div>
            </form>
        </div>
        </div>
    </div>
    </div>

@endsection