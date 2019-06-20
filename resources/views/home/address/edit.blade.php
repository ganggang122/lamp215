<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>地址管理</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/h/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/h/css/addstyle.css" rel="stylesheet" type="text/css">
		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js"></script>

	</head>

	<body>
		<!--头 -->
@include('home.public.information.header')

		<div class="nav-table">
			<div class="long-title"><span class="all-goods">全部分类</span></div>
			<div class="nav-cont">
				<ul>
					<li class="index"><a href="#">首页</a></li>
					<li class="qc"><a href="#">闪购</a></li>
					<li class="qc"><a href="#">限时抢</a></li>
					<li class="qc"><a href="#">团购</a></li>
					<li class="qc last"><a href="#">大包装</a></li>
				</ul>
				<div class="nav-extra">
					<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
					<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
				</div>
			</div>
		</div>
		<b class="line"></b>

		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-address">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
						</div>
						<hr/>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
                            @foreach($users_address  as $k=>$v)
                            @if($v->status == 1)
							<li class="user-addresslist defaultAddr">
								
							
								
								<span class="new-option-r"><i class="am-icon-check-circle"></i>默认地址</span>
								

								<p class="new-tit new-p-re">
									<span class="new-txt">{{  $v->uname }}</span>
									<span class="new-txt-rd2">{{ $v->phone }}</span>
								</p>
								<div class="new-mu_l2a new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：</span>
										<span class="province">{{ $v->address }}</span></p>
								</div>
								<div class="new-addr-btn">
									<a href="/home/address/edit/{{ $v->id }}"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<a href="javascript:void(0);" onClick="delClick(this);"><i class="am-icon-trash"></i>删除</a>
								</div>
							</li>
							@endif
                            @if($v->status == 0)
							<li class="user-addresslist">
								<span class="new-option-r"><i class="am-icon-check-circle"></i><a  href="/home/address/update/{{ $v->id }}">设为默认</a></span>
								<p class="new-tit new-p-re">
									<span class="new-txt">{{  $v->uname }}</span>
									<span class="new-txt-rd2">{{ $v->phone }}</span>
								</p>
								<div class="new-mu_l2a new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：</span>
										<span class="province">{{ $v->address }}</span></p>
								</div>
								<div class="new-addr-btn">
									<a href="/home/address/edit/{{ $v->id }}"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<a href="javascript:void(0);" onClick="delClick(this);"><i class="am-icon-trash"></i>删除</a>
								</div>
								@endif
							@endforeach
						</ul>
						<div class="clear"></div>
						
						<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
						<!--例子-->
						<div class="am-modal am-modal-no-btn" id="doc-modal-1">

							<div class="add-dress">

								<!--标题 -->

								<div class="am-cf am-padding">
									<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
								</div>
								<hr/>

								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
									<script type="text/javascript" src="/area.js"></script>
									@if (count($errors) > 0)
								    <div class="alert alert-danger">
								        <ul>
								            @foreach ($errors->all() as $error)
								                <li style="color:red;margin:auto">*{{ $error }}</li>
								            @endforeach
								        </ul>
								    </div>
								   @endif	
								    
									<form class="am-form am-form-horizontal"  action="/home/address/show/{{$users_addre->id}}"  method="post">
										{{ csrf_field()  }}
                                       
										<div class="am-form-group">
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text"  name="uname"  id="user-name" value="{{ $users_addre->uname }}" placeholder="收货人">
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-phone" class="am-form-label">手机号码</label>
											<div class="am-form-content">
												<input id="user-phone"  name="phone" placeholder="手机号必填" type="text" value="{{ $users_addre->phone }}">
											</div>
										</div>
										<div class="am-form-group">
											<label for="user-address" class="am-form-label">所在地</label>
											<div class="am-form-content address">
												<select id="Province" runat="server" name="province" style="width: 90px" ></select>
												<select id="Country" runat="server" name="country" style="width: 90px"></select>
												<select id="Town" runat="server" name="town" style="width: 90px"></select>
										    </div>
										</div>

										<div class="am-form-group">
											<label for="user-intro" class="am-form-label">详细地址</label>
											<div class="am-form-content">
												<textarea class="" rows="3" id="user-intro" placeholder="输入详细地址"  name="address">{{ $users_addre->address }}</textarea>
												<small>100字以内写出你的详细地址...</small>
											</div>
										</div>
										

										<div class="am-form-group">
											<div class="am-u-sm-9 am-u-sm-push-3">
												<input  type="submit" class="am-btn am-btn-danger" value="保存"></a>
												<a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
											</div>
										</div>
									</form>
								</div>

							</div>

						</div>

					</div>
                    
		    <script language="javascript">
			setup();
		    </script>
					<script type="text/javascript">
						$(document).ready(function() {							
							$(".new-option-r").click(function() {
								$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
							});
							
							var $ww = $(window).width();
							if($ww>640) {
								$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
							}
							
						})
					</script>

					<div class="clear"></div>

				</div>
				<!--底部-->
			        <div class="footer ">
						@include('home.public.footer')
						
					</div>
			</div>
@include('home.public.information.footer')