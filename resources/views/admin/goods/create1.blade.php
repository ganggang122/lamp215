@extends('admin.layout.layout')
@section('content')

    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-ok"></i> 商品添加</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form id="mws-validate" class="mws-form" action="/admin/goods/add" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">商品名称</label>
                        <div class="mws-form-item">
                            <input type="text" name="goodsName" class="required large">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品编号</label>
                        <div class="mws-form-item">
                            <input type="text" name="goodNum" value="{{$goodsNum}}" class="required email large">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">市场价格</label>
                        <div class="mws-form-item">
                            <input type="text" name="marketPrice" class="required url large">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">店铺价格</label>
                        <div class="mws-form-item">
                            <input type="text" name="shopPrice" class="required digits large">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">商品库存</label>
                        <div class="mws-form-item">
                            <input type="text" name="goodsStock" class="required digits large">
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

                    <div class="mws-form-row">
                       {{-- <label class="mws-form-label">商品分类</label>
                        <div class="mws-form-item">
                            <select class="required large" name="cid">
                                <option value="0">请选择</option>
                                @foreach($goodsCate as $k=>$v)
                                    <option value="{{$v->id}}">{{$v->cname}}</option>
                                @endforeach
                            </select>
                        </div>--}}
                    </div>
                    <div class="mws-form-row">
                        {{--<label class="mws-form-label">商品规格</label>
                        <div class="mws-form-item">
                            <select class="required large" name="selectBox">
                                <option>请选择</option>
                                <option>Option 1</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                            </select>
                        </div>--}}
                    </div>
                    <div class="mws-form-row">
                       {{-- <label class="mws-form-label">商品品牌</label>
                        <div class="mws-form-item">
                            <select class="required large" name="bid">
                                <option value="0">请选择</option>
                                @foreach($brandsName as $k=>$v)
                                    <option value="{{$v->id}}" {{ substr_count($v->path,',') <= 1 ? 'disabled' : ''}}>{{$v->bname}}</option>
                                @endforeach
                            </select>
                        </div>--}}
                    </div>
                    <div class="mws-form-row">
                        {{--<label class="mws-form-label">商品图片</label>
                        <div class="mws-form-item">
                            <div class="fileinput-holder" style="position: relative;">
                                <input type="hidden"  name="goodsPhoto" id="art_thumb" value="art_thumb">
                                <span><input type="file" name="file_upload" id="file_upload" class="required" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;"></span></div>
                            <br>
                                <img src="https://lamp215.oss-cn-beijing.aliyuncs.com/156091289878275d09a4026742c.jpg" id="img1" alt="" style="width: 80px;height: 80px;">
                            <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>--}}
                        <br>

                        <div class="mws-form-row">
                            {{--<label class="mws-form-label">商品详情</label>
                            <div class="mws-form-item">
                                <script id="container" name="content" type="text/plain">

                                </script>
                            </div>--}}
                        </div>

                        {{--<script type="text/javascript">
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


                        </script>--}}
                    </div>

                </div>
                <div class="mws-button-row">
                    <input type="submit" class="btn btn-danger">
                </div>
            </form>
        </div>
    </div>

    <!-- 配置文件 -->
    <script type="text/javascript" src="/d/utf8-php/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/d/utf8-php/ueditor.all.js"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
@endsection