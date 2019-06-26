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

    <div class="mws-panel">
        <div class="mws-panel-header"  style="height:50px">
            <span>商品添加</span>
        </div>
        <div class="mws-panel-body no-padding" >
            <form class="mws-form" action="/admin/goods/add" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="mws-form-inline" style="width:80%">
                    <div class="mws-form-row">
                        <label class="mws-form-label">商品名称</label>
                        <div class="mws-form-item">
                            <input type="text" name="goodsName" class="required large" value="{{old('goodsName')}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">商品编号</label>
                        <div class="mws-form-item">
                            <input type="text" name="goodsNum" value="{{$goodsNum}}" class="required email large"   disabled>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">市场价格</label>
                        <div class="mws-form-item">
                            <input type="text" name="marketPrice" class="required url large" value="{{old('marketPrice')}}">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">店铺价格</label>
                        <div class="mws-form-item">
                            <input type="text" name="shopPrice" class="required digits large" value="{{old('shopPrice')}}">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品库存</label>
                        <div class="mws-form-item">
                            <input type="text" name="goodsStock" class="required digits large" value="{{old('goodsStock')}}">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品分类</label>
                        <div class="mws-form-item">
                            <select class="required large" name="cid">
                                <option value="0">请选择</option>
                                @foreach($goodsCate as $k=>$v)
                                    <option value="{{$v->id}}"  {{ substr_count($v->path,',') <=1 ? 'disabled' : ''}}>{{$v->cname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品状态</label>
                        <div class="mws-form-item">
                            <ul class="mws-form-list">
                                <li><input id="gender_male" type="radio" name="goodsStatus" value="1" class="required">
                                    <label for="gender_male">上架</label></li>
                                <li><input id="gender_female" type="radio" name="goodsStatus" value="2">
                                    <label for="gender_female">下架</label></li>
                            </ul>
                            <label for="gender" class="error plain" generated="true" style="display:none"></label>
                        </div>
                    </div>
                </div>
                <div class="mws-button-row">
                    <input type="submit" value="下一步" class="btn btn-danger">
                    <input type="reset" value="重置" class="btn ">
                </div>
            </form>
        </div>
    </div>
@endsection

