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
    <div class="mws-panel grid_8" style="margin-left: -27px; ">
        <div class="mws-panel-header"  style="height:50px; " >
            <span>商品修改</span>
        </div>
        <div class="mws-panel-body no-padding" >
            <form  class="mws-form" method="post" action="/admin/goods/{{$good->id}}"  enctype="multipart/form-data">
                {{csrf_field()}}
                {{ method_field('PUT') }}
                <div class="mws-form-inline" style="width: 55%">

                    <div class="mws-form-row" >
                        <label class="mws-form-label">商品分类</label>
                        <div class="mws-form-item">
                            <select class="required large" name="cid" >
                                <option value="">请选择</option>
                                @foreach($goodsCate as $k=>$v)
                                    <option value="{{$v->id}}"  {{ substr_count($v->path,',') <=1 ? 'disabled' : ''}} {{ $good->cid == $v->id ? 'selected' : '' }}>{{$v->cname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品品牌</label>
                        <div class="mws-form-item">
                            <select class="required large" name="bid"  >
                                <option value="0">请选择</option>
                                @foreach($brandName as $k=>$v)
                                    <option value="{{$v->id}}" {{ substr_count($v->path,',') >= 1 ? 'disabled' : ''}} {{ $good->bid == $v->id ? 'selected' : '' }}>{{$v->bname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">市场价格</label>
                        <div class="mws-form-item">
                            <input type="text" name="marketPrice" class="required url large" value="{{$good->marketPrice}}" placeholder="请输入市场价格">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">店铺价格</label>
                        <div class="mws-form-item">
                            <input type="text" name="shopPrice" class="required digits large" value="{{$good->shopPrice}}" placeholder="请输入店铺价格">
                            <span style="font-size: 10px;color:#dd4b39">若店铺价格多个请以','分隔</span>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品库存</label>
                        <div class="mws-form-item">
                            <input type="text" name="goodsStock" class="required digits large" value="{{$good->goodsStock}}" placeholder="请输入商品库存">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">{{$specName1}}</label>
                        <div class="mws-form-item">
                            <input type="text" name="specValue1" value="{{$specValue1}}" placeholder="若输入多个值请以','分隔" class="small" style="width: 100%">

                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">{{$specName2}}</label>
                        <div class="mws-form-item">
                            <input type="text" name="specValue2" value="{{$specValue2}}" placeholder="若输入多个值请以','分隔" class="small" style="width: 100%">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品图片</label>
                        <div class="mws-form-item">


                            <div class="fileinput-holder"  style="width:100%">
                                <input type="hidden"  name="goodsPhoto" id="art_thumb" value="{{$good->goodsinfo['goodsPhotoinfo1']}}"  >
                                <span>
                                    <input type="file" name="file_upload" id="file_upload" class="required" multiple="true"   >
                                </span>
                            </div>
                            <br>
                            <img src="{{$good->goodsinfo['goodsPhotoinfo1']}}" id="img1" alt="" style="width: 80px;height: 80px;">
                            <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>

                        <script type="text/javascript">
                            $(function () {
                                $("#file_upload").change(function () {
                                    $('img1').show();
                                    uploadImage();
                                });
                            });
                            function uploadImage() {
                                // 判断是否有选择上传文件
                                var imgPath = $("#file_upload").val();
                                if (imgPath == "") {
                                    alert("请选择上传图片！");
                                    return;
                                }
                                //判断上传文件的后缀名
                                var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                if (strExtension != 'jpg' && strExtension != 'gif'
                                    && strExtension != 'png' && strExtension != 'bmp') {
                                    alert("请选择图片文件");
                                    return;
                                }
                                // var formData = new FormData($('#art_form')[0]);
                                var formData = new FormData();
                                formData.append('file_upload', $('#file_upload')[0].files[0]);
                                formData.append('_token', '{{csrf_token()}}');
                                $.ajax({
                                    type: "POST",
                                    url: "/admin/upload",
                                    data: formData,
                                    async: true,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function(data) {
                                        // $('#img1').attr('src','/uploads/'+data);
                                        $('#img1').attr('src','https://lamp215.oss-cn-beijing.aliyuncs.com/'+data);
                                        $('#img1').show();
                                        $('#art_thumb').val('https://lamp215.oss-cn-beijing.aliyuncs.com/'+data);
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert("上传失败，请检查网络后重试");
                                    }
                                });
                            }
                        </script>

                    </div>
                </div>

                <div class="mws-button-row">
                    <input type="submit" value="提交" class="btn btn-danger">
                    <input type="reset" value="重置" class="btn ">
                </div>
            </form>
        </div>
    </div>

@endsection