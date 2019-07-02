
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>购物车页面</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/h/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/h/css/optstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/h/js/jquery.js"></script>

	</head>

	<body>
@include('home.public.information.header')
			

			<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
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
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
                    @foreach($goods_data  as  $k=>$v)
					<tr class="item-list">
						<div class="bundle  bundle-last ">
							<div class="bundle-hd">
								<div class="bd-promos">
									<div class="bd-has-promo">已享优惠:<span class="bd-has-promo-content">省￥19.50</span>&nbsp;&nbsp;</div>
									
									<span class="list-change theme-login">编辑</span>
								</div>
							</div>
							<div class="clear"></div>
							<div class="bundle-main">
								<ul class="item-content clearfix">
									<li class="td td-chk">
										<div class="cart-checkbox ">
											<input class="check" id="J_CheckBox_170037950254" name="items[]" value="170037950254" type="checkbox">
											<label for="J_CheckBox_170037950254"></label>
										</div>
									</li>
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" data-title="{{$v->goodsinfo['goodsNum']}}" class="J_MakePoint" data-point="tbcart.8.12">
												<img src="{{ $v->goodsinfo['goodsPhotoinfo1']}}" style="width:90px"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" title="{{$v->shopprice->goodsName}}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->shopprice->goodsName}}</a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props item-props-can">
											<span class="sku-line">{{$v->specName1}}：{{$v->specValue1}}</span>
											<span class="sku-line">{{$v-> specName2}}：{{$v->specValue2}}</span>
							
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<div class="price-line">
													<em class="price-original">{{$v->shopPrice}}</em>
												</div>
												<div class="price-line">
													<em class="J_Price price-now" tabindex="0">{{ $v->shopPrice }}</em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
													<input class="min am-btn" name="" type="button" value="-" onclick="minus(this,{{$v->gid}},{{$v->id}})"/>
													<input class="text_box" name="" type="text" value="1" style="width:30px;" />
													<input class="add am-btn" name="" type="button" value="+" onclick="add(this,{{$v->gid}},{{$v->id}})"  />
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" id="abc" class="J_ItemSum number" value="{{$v->shopprice->shopPrice}}">{{$v->shopPrice}}</em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a title="移入收藏夹" class="btn-fav" href="#">
                  移入收藏夹</a>
											<a href="javascript:;" data-point-url="#" class="delete">
                  删除</a>
										</div>
									</li>
								</ul>
								
								
								
											
								
								
								
							</div>
						</div>
					</tr>
					@endforeach
					<div class="clear"></div>

				
				</div>
				<div class="clear"></div>

				<div class="float-bar-wrapper">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						<div class="cart-checkbox">
							<input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
							<label for="J_SelectAllCbx2"></label>
						</div>
						<span>全选</span>
					</div>
					<div class="operations">
						<a href="#" hidefocus="true" class="deleteAll">删除</a>
						<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
					</div>
					<div class="float-bar-right">
						<div class="amount-sum">
							<span class="txt">已选商品</span>
							<em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em id="J_Total">{{$prices}}</em></strong>
						</div>
						<div class="btn-area">
							<a href="/home/pay/index" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a>
						</div>
					</div>
					  <div class="footer ">
						@include('home.public.footer')
						
					</div>
			   </div>
			   <script  type="text/javascript">
			   	    
			   	    function  add(obj,gid,id){
                    let  num = parseInt($(obj).prev().val());
                    //1
                    
                    let  goodid  = gid
                   //当前合计
                    let  pricesold = $('#J_Total').text()
                    console.log(pricesold);
                    							//1      //当前合计
                    $.get('/home/shopcart/add' ,{num,goodid,pricesold,id},function(res){
                    	   let  resold = res.split('-')
                            $(obj).parent().parent().parent().parent().next().find('#abc').text(resold[0]);
                            $('#J_Total').text(resold[1])
                    },'html')
                   

                    
                    
                }
                 function  minus(obj,id){
                    let  num = parseInt($(obj).next().val());
                    if(num == 0){
                    	alert('商品不能为0');
                    	return false
                    }
                    
                    let  gid  = id
                   //当前合计
                    let  pricesold = $('#J_Total').text()
                    console.log(pricesold);
                    							//1      //当前合计
                    $.get('/home/shopcart/minus' ,{num,gid,pricesold},function(res){
                    	   let  resold = res.split('-')
                            $(obj).parent().parent().parent().parent().next().find('#abc').text(resold[0]);
                            $('#J_Total').text(resold[1])
                    },'html')
                   
                }
		             
               
			   </script>

