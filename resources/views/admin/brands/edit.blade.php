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
            <span>品牌修改</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="/admin/brands/{{$brand->id}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="mws-form-row">
                    <label class="mws-form-label">品牌名称</label>
                    <div class="mws-form-item">
                        <input type="text" name="bname" value="{{$brand->bname}}" class="small" >
                    </div>
                </div>

                {{--<div class="mws-form-row">
                    <label class="mws-form-label">品牌名称</label>
                    <div class="mws-form-item">
                        <input type="text" name="bname" value="{{ old('bname') }}" class="small" >
                    </div>
                </div>--}}

                <div class="mws-form-row">
                    <label class="mws-form-label">品牌Logo</label>
                    <div class="mws-form-item" style="width: 455px; ">
                        <input type="hidden"  name="photo" id="art_thumb" value="art_thumb">
                        <input type="file" name="file_upload" id="file_upload" multiple="true">
                        <img src="{{$brand->photo}}" id="img1" alt="" style="width: 80px;height: 80px;">
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
                            var formData = new FormData($('#art_form')[0]);
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


                <div class="mws-button-row">
                    <input type="submit" value="Submit" class="btn btn-danger">
                    <input type="reset" value="Reset" class="btn ">
                </div>
            </form>
        </div>
    </div>
@endsection