@extends('admin.layout.layout')
@section('css')
	<style type="text/css">
		#abc ul,#abc li{
			margin:0;
			padding:0;
			list-style-type: none;
		}
		#abc a,#abc span{
		    position: relative;
		    float: left;
		    padding: 6px 12px;
		    margin-left: -1px;
		    line-height: 1.42857143;
		    color: #337ab7;
		    text-decoration: none;
		    background-color: #fff;
		    border: 1px solid #ddd;
		}

		#abc .active span{
			background-color: #1BE7ED;
			color:#fff;
		}
	</style>

@show
@section('content')
	
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header" style="height:50px">
        	<span><i class="icon-table"></i> 轮播图列表</span>

        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>轮播图标题</th>
                        <th>所属分类</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($banner as $k=>$v)
                    <tr>
                        <td>{{$v->id}}</td>
                        <td>{{$v->title}}</td>
                        <td>
                            <img title="{{$v->desc}}" src="/uploads/{{$v->url}}" style="width:70px">
                        </td>
                        <td>
                            @if($v->status == 0)
                            <kbd style="background-color: #E2E1E1">未开启</kbd>
                            @else
                            <kbd style="background-color: pink">开启</kbd>
                            @endif
                        </td>

                        <td>
                            <a href="/admin/banners/{{ $v->id }}/edit" class="btn btn-warning">修改</a>
                            <form action="/admin/banners/{{ $v->id }}" method="post" style="display: inline-block;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" value="删除" class="btn btn-danger">
                            </form>

                            @if($v->status==0)
                             <button type="button"  onclick="changeStatus({{ $v->id }},0)"" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                              激活
                            </button>
                            @elseif($v->status==1)
                            <!-- Button trigger modal -->
                            <button type="button"  onclick="changeStatus({{ $v->id }},1)"" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                              未激活
                            </button>
                            @endif
                            <!-- Button trigger modal -->
                            
                        </td>
                    </tr>
                    @endforeach
                    <script type="text/javascript">
                        function changeStatus(id,sta){
                             if (sta==0) {
                                    $('#myModal form input[type=radio]').eq(1).attr('checked',true);
                                } else {
                                    $('#myModal form input[type=radio]').eq(0).attr('checked',true);
                                }
                                // $('#myModal form input[type=hidden]').eq(0).val(id);   
                                $('#asd').val(id);        
                            }
                    </script>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">轮播图状态</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/admin/banners/changeStatus" method="get">
                                        <input type="hidden" name="id" id='asd' value="">
                                        <div class="form-group">
                                        
                                          未开启:<input type="radio" checked name="status" value="0" id="status" >
                                          &nbsp; &nbsp;&nbsp;
                                          开启:<input type="radio" name="status" value="1"  id="status" >
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-default">提交</button>
                                
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
              <!--  -->
                </tbody>
            </table>
             
        </div>
    </div>
@endsection