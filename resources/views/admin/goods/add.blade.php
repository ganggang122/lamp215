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

    <div class="mws-panel grid_8" style="margin-left: -25px; ">
        <div class="mws-panel-header"  style="height:50px; " >
            <span>商品详情添加</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form id="art_form" class="mws-form" method="post" action="/admin/goods"  enctype="multipart/form-data">
                {{csrf_field() }}
                <div class="mws-form-inline">
                    {{--<input type="hidden" name="gid" value="{{$gid}}">--}}
                    @foreach($specific  as  $k=>$v)
                        <div class="mws-form-row">
                            <label class="mws-form-label">{{$v->specname}}</label>
                            <div class="mws-form-item">
                                <input type="text" name="specName[]" value="" placeholder="若输入多个值请以','分隔" class="small" >

                            </div>
                        </div>
                    @endforeach

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品品牌</label>
                         <div class="mws-form-item">
                             <select class="required large" name="bid"  style="width:55%" >
                                 <option value="0">请选择</option>
                                 @foreach($brands as $k=>$v)
                                     <option value="{{$v->id}}" {{ substr_count($v->path,',') >= 1 ? 'disabled' : ''}}>{{$v->bname}}</option>
                                 @endforeach
                             </select>
                         </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品图片</label>
                        <div class="mws-form-item">


                            <div class="fileinput-holder"  style="width:55%">
                                <input type="hidden"  name="goodsPhoto" id="art_thumb" value="art_thumb"  >
                                <span>
                                    <input type="file" name="file_upload" id="file_upload" class="required" multiple="true"  >
                                </span>
                            </div>


                            {{--<div class="fileinput-holder" style="position: relative;">
                                <input type="hidden"  name="goodsPhoto" id="art_thumb" value="art_thumb">
                                <span>
                                    <input type="file" name="file_upload" id="file_upload" class="required" multiple="true" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                                </span>
                            </div>--}}

                            <br>
                            <img src="https://lamp215.oss-cn-beijing.aliyuncs.com/156091289878275d09a4026742c.jpg" id="img1" alt="" style="width: 80px;height: 80px;">
                            <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">商品详情</label>
                        <div class="mws-form-item">
                            <script id="container" name="content" type="text/plain">

                            </script>
                        </div>
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


                   
                    
                <div class="mws-button-row">
                    <input type="submit" value="添加商品" class="btn btn-danger">
                    <input type="reset" value="重置" class="btn ">
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