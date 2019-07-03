<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>结算页面</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />

		<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/h/css/cartstyle.css" rel="stylesheet" type="text/css" />

		<link href="/h/css/jsstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/h/js/address.js"></script>

	</head>

	<body>

		<!--顶部导航条 -->
@include('home.public.information.header')		
			<div class="clear"></div>
			<div class="concent">
				<!--地址 -->
				<div class="paycont">
					<div class="address">
						<h3>确认收货地址 </h3>
						<div class="control">
							<div class="tc-btn createAddr theme-login am-btn am-btn-danger">使用新地址</div>
						</div>
						<div class="clear"></div>
						<ul>
							<div class="per-border"></div>
							 @foreach($address_data	  as $k=>$v)
                            @if($v->status == 1)
							<li class="user-addresslist defaultAddr">

								<div class="address-left">
									<div class="user DefaultAddr">

										<span class="buy-address-detail">   
                   <span class="buy-user">{{$v->uname}}</span>
										<span class="buy-phone">{{$v->phone}}</span>
										</span>
									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
								   <span class="province">{{$v->address}}</span>
										
										</span>

										</span>
									</div>
									<ins class="deftip">默认地址</ins>
								</div>
								<div class="address-right">
									<a href="person/address.html">
										<span class="am-icon-angle-right am-icon-lg"></span></a>
								</div>
								<div class="clear"></div>

								<div class="new-addr-btn">
									<a href="#" class="hidden">设为默认</a>
									
									<span class="new-addr-bar">|</span>
									<a href="/home/address/destory/{{ $v->id }}">删除</a>
								</div>

							</li>
							<div class="per-border"></div>
							@endif
                            @if($v->status == 0)
							<li class="user-addresslist">
								<div class="address-left">
									<div class="user DefaultAddr">

										<span class="buy-address-detail">   
                   <span class="buy-user">{{$v->uname}}</span>
										<span class="buy-phone">{{$v->phone}}</span>
										</span>
									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
								   <span class="province">{{$v->address}}</span>
										</span>
										</span>

										</span>
									</div>
									<ins class="deftip hidden">默认地址</ins>
								</div>
								<div class="address-right">
									<span class="am-icon-angle-right am-icon-lg"></span>
								</div>
								<div class="clear"></div>

								<div class="new-addr-btn">
									<a href="/home/address/update/{{ $v->id }}">选择地址</a>
									<span class="new-addr-bar">|</span>
									<a href="/home/address/destory/{{ $v->id }}">删除</a>
								</div>

							</li>

								@endif
							@endforeach
						</ul>
						<div class="clear"></div>
					</div>
					
				
					<div class="clear"></div>

					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>确认订单信息</h3>
							<div class="cart-table-th">
								<div class="wp">

									<div class="th th-item">
										<div class="td-inner">商品信息</div>
									</div>
									<div class="th th-price">
										<div class="td-inner">单价</div>
									</div>
									<div class="th th-amount">
										<div class="td-inner">数量</div>
									</div>
									<div class="th th-sum">
										<div class="td-inner">商品小计</div>
									</div>
									<div class="th th-oplist">
										<div class="td-inner">配送方式</div>
									</div>

								</div>
							</div>
							<div class="clear"></div>

							@foreach($shop  as $k=>$v)
							<tr id="J_BundleList_s_1911116345_1" class="item-list">
								<div id="J_Bundle_s_1911116345_1_0" class="bundle  bundle-last">
									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img src="{{$v->goodsinfo->goodsPhotoinfo1}}"  style="width:80px" class="itempic J_ItemImg"></a>
													</div>
													<div class="item-info">
														<div class="item-basic-info">
															<a href="#" target="_blank" title="{{$v->goods['goodsName']}}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->goods['goodsName']}}</a>
														</div>
													</div>
												</li>
												<li class="td td-info">
													<div class="item-props">
														<span class="sku-line">{{$v->specname1}}</span>
														<span class="sku-line">{{$v->specname2}}</span>
													</div>
												</li>
												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<em class="J_Price price-now">{{$v->goodsprice}}</em>
														</div>
													</div>
												</li>
											</div>

											<li class="td td-amount">
												<div class="amount-wrapper ">
													<div class="item-amount ">
														<span class="phone-title">购买数量</span>
														<div class="sl">
														
															<span class="text_box"  style="width:30px;" >{{$v->goodnum}}</span>

														</div>
													</div>
												</div>
											</li>
											<li class="td td-sum">
												<div class="td-inner">
													<em tabindex="0" class="J_ItemSum number">{{$v->goodsprice * $v->goodnum}}</em>
												</div>
											</li>
											<li class="td td-oplist">
												<div class="td-inner">
													<span class="phone-title">配送方式</span>
													<div class="pay-logis">
														包邮
													</div>
												</div>
											</li>

										</ul>
										<div class="clear"></div>

									</div>
							</tr>
							@endforeach
							</div>
							<div class="clear"></div>
							<div class="pay-total">
						
							
							<div class="clear"></div>
							</div>
							<!--含运费小计 -->
							<div class="buy-point-discharge ">
								<p class="price g_price ">
									合计（含运费） <span>¥</span><em class="pay-sum">{{$zongji}}</em>
								</p>
							</div>

							<!--信息 -->
							<div class="order-go clearfix">
								<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
											<span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">{{$zongji}}</em>
											</span>
										</div>

										<div id="holyshit268" class="pay-address">

											<p class="buy-footer-address">
												<span class="buy-line-title buy-line-title-type">寄送至：</span>
												@foreach($address_data  as  $k=>$v)
												@if($v->status == 1)
												<span class="buy--address-detail">
								   <span class="province">{{$v->address}}</span>
												
											   </span>
											</p>
											<p class="buy-footer-address">
												<span class="buy-line-title">收货人：</span>
												<span class="buy-address-detail">   
                                         <span class="buy-user">{{$v->uname}}</span>
												<span class="buy-phone">{{$v->phone}}</span>
												</span>
												@endif
												@if($v->status == 0)
												

												<span class="buy--address-detail">
								   <span class="province"></span>
												
											   </span>
												@endif
												@endforeach
											</p>
										</div>
									</div>

									<div id="holyshit269" class="submitOrder">
										<div class="go-btn-wrap">
											<a id="J_Go" href="/home/success/index" class="btn-go" tabindex="0" title="点击此按钮，提交订单">提交订单</a>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
				<div class="footer">
					<div class="footer-hd">
						<p>
							<a href="#">恒望科技</a>
							<b>|</b>
							<a href="#">商城首页</a>
							<b>|</b>
							<a href="#">支付宝</a>
							<b>|</b>
							<a href="#">物流</a>
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>
							<em>© 2015-2025 Hengwang.com 版权所有</em>
						</p>
					</div>
				</div>
			</div>
			<div class="theme-popover-mask"></div>
			<div class="theme-popover">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small></div>
				</div>
				<hr/>

				<div class="am-u-md-12">
					<form class="am-form am-form-horizontal" action="/home/address/create"  method="post">
										{{ csrf_field()  }}

						<div class="am-form-group">
							<label for="user-name" class="am-form-label">收货人</label>
							<div class="am-form-content">
								<input type="text" id="user-name" name="uname" placeholder="收货人">
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-phone"  sclass="am-form-label">手机号码</label>
							<div class="am-form-content">
								<input id="user-phone" name="phone" placeholder="手机号必填" type="text">
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-phone" class="am-form-label">所在地</label>
							<div class="am-form-content address">
								<select id="Province" runat="server" name="province" style="width: 90px" ></select>
												<select id="Country" runat="server" name="country" style="width: 90px"></select>
												<select id="Town" runat="server" name="town" style="width: 90px"></select>
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-intro" class="am-form-label">详细地址</label>
							<div class="am-form-content">
								<textarea class="" rows="3" name="address" id="user-intro" placeholder="输入详细地址"></textarea>
								<small>100字以内写出你的详细地址...</small>
							</div>
						</div>

						<div class="am-form-group theme-poptit">
							<div class="am-u-sm-9 am-u-sm-push-3">
								<input  type="submit" class="am-btn am-btn-danger" value="保存"></a>
								<div class="am-btn am-btn-danger close">取消</div>
							</div>
						</div>
					</form>
				</div>

			</div>

			<div class="clear"></div>
	</body>
	<script type="text/javascript" src="/area.js"></script>
 <script language="javascript">
			setup();
		    </script>
</html>