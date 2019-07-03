@include('home.public.header')

<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript" src="/h/comment/js/comment.js" ></script>
<script type="text/javascript" src="/h/basic/js/quick_links.js"></script>
<script type="text/javascript" src="/h/js/list.js"></script>
<script type="text/javascript" src="/h/js/jquery.imagezoom.min.js"></script>
<script type="text/javascript" src="/h/js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="/layui-v2.4.5/layui/css/layui.css">
<script src="/layui-v2.4.5/layui/layui.js"></script>
<script>
    //一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer


    });
</script>


				<!--分类-->
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
				<ol class="am-breadcrumb am-breadcrumb-slash">
					<li><a href="#">首页</a></li>
					<li><a href="#">分类</a></li>
					<li class="am-active">内容</li>
				</ol>
				<script type="text/javascript">
					$(function() {});
					$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							start: function(slider) {
								$('body').removeClass('loading');
							}
						});
					});
				</script>
				<div class="scoll">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<img src="/h/images/01.jpg" title="pic" />
								</li>
								<li>
									<img src="/h/images/02.jpg" />
								</li>
								<li>
									<img src="/h/images/03.jpg" />
								</li>
							</ul>
						</div>
					</section>
				</div>

				<!--放大镜-->

				<div class="item-inform">
					<div class="clearfixLeft" id="clearcontent">

						<div class="box">
							<script type="text/javascript">
								$(document).ready(function() {
									$(".jqzoom").imagezoom();
									$("#thumblist li a").click(function() {
										$(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
										$(".jqzoom").attr('src', $(this).find("img").attr("mid"));
										$(".jqzoom").attr('rel', $(this).find("img").attr("big"));
									});
								});
							</script>

							<div class="tb-booth tb-pic tb-s310">
								<a  href="{{$good->goodsinfo['goodsPhotoinfo1']}}">
                                    <img src="{{$good->goodsinfo['goodsPhotoinfo1']}}" id="goodsPhotoinfo1" alt="细节展示放大镜特效" rel="{{$good->goodsinfo['goodsPhotoinfo1']}}" class="jqzoom" />

                                </a>

                            </div>
							<ul class="tb-thumb" id="thumblist">
								<li class="tb-selected">
									<div class="tb-pic tb-s40">
										<a href="#"><img src="{{$good->goodsinfo['goodsPhotoinfo1']}}" mid="images/01_mid.jpg" big="images/01.jpg"></a>
									</div>
								</li>
								<li>
									<div class="tb-pic tb-s40">
										<a href="#"><img src="/h/images/02_small.jpg" mid="images/02_mid.jpg" big="images/02.jpg"></a>
									</div>
								</li>
								<li>
									<div class="tb-pic tb-s40">
										<a href="#"><img src="/h/images/03_small.jpg" mid="images/03_mid.jpg" big="images/03.jpg"></a>
									</div>
								</li>
							</ul>
						</div>

						<div class="clear"></div>
					</div>

					<div class="clearfixRight">

						<!--规格属性-->
						<!--名称-->
						<div class="tb-detail-hd">
							<h1>{{$good->goodsName}}</h1>
							<button onclick='collect(this)'>{{ $collect ? ' 已收藏 ': '点击收藏' }}</button>
						</div>

						<script>
							function collect(obj)
							{
								//获取商品id
								
								let gid = $('#gid').val();

								$.get('/home/collect/collect',{gid},function(res){
									if( res == 'ok') {
										$(obj).html('已收藏');
									} 
									if ( res == 'del') {
										$(obj).html('点击收藏');
									}
									// console.log(res)
								},'json')
							}
						</script>

	<script>
		function collect(obj)
		{
			//获取商品id
			let gid = $('#gid').val();
			$.get('/home/collect/collect',{'gid':gid},function(res){
				if( res == 'ok') {
					$(obj).html('已收藏');
				} 
				if ( res == 'del') {
					$(obj).html('点击收藏');
				}
			},'json')
		}
	</script>



						<div class="tb-detail-list">
							<!--价格-->
							<div class="tb-detail-price">
								<li class="price iteminfo_price">
									<dt>促销价</dt>
									<dd><em>¥</em><b class="sys_item_price" id="shopPrice">{{$shopPrice}}</b>  </dd>
								</li>
								<li class="price iteminfo_mktprice">
									<dt>原价</dt>
									<dd><em>¥</em><b class="sys_item_mktprice">{{$good->marketPrice}}</b></dd>
								</li>
								<div class="clear"></div>
							</div>

							<!--地址-->
							<dl class="iteminfo_parameter freight">
								<dt>配送至</dt>
								<div class="iteminfo_freprice">
									<div class="am-form-content address">
										<select data-am-selected>
											<option value="a">浙江省</option>
											<option value="b">湖北省</option>
										</select>
										<select data-am-selected>
											<option value="a">温州市</option>
											<option value="b">武汉市</option>
										</select>
										<select data-am-selected>
											<option value="a">瑞安区</option>
											<option value="b">洪山区</option>
										</select>
									</div>
									<div class="pay-logis">
										快递<b class="sys_item_freprice">10</b>元
									</div>
								</div>
							</dl>
							<div class="clear"></div>

							<!--销量-->
							<ul class="tm-ind-panel">
								<li class="tm-ind-item tm-ind-sellCount canClick">
									<div class="tm-indcon"><span class="tm-label">月销量</span><span class="tm-count">1015</span></div>
								</li>
								<li class="tm-ind-item tm-ind-sumCount canClick">
									<div class="tm-indcon"><span class="tm-label">累计销量</span><span class="tm-count">6015</span></div>
								</li>
								<li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
									<div class="tm-indcon"><span class="tm-label">累计评价</span><span class="tm-count">640</span></div>
								</li>
							</ul>
							<div class="clear"></div>

							<!--各种规格-->
							<dl class="iteminfo_parameter sys_item_specpara">
								<dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
								<dd>
									<!--操作页面-->

									<div class="theme-popover-mask"></div>

									<div class="theme-popover">
										<div class="theme-span"></div>
										<div class="theme-poptit">
											<a href="javascript:;" title="关闭" class="close">×</a>
										</div>
										<div class="theme-popbod dform">
											<form action="/home/pay/create/{{$good->id}}" method="get" enctype="multipart/form-data" >
													{{csrf_field()}}
                                                <input type='hidden' id='gid' name='gid' value='{{ $good->id }}'>
                                                <div class="theme-signin-left">
                                                    <input type="hidden" name="shopPrice" value="{{$good->shopPrice}}" >
													<div class="theme-options">
														<div class="cart-title" id="specName1">{{$specName1}}</div>
                                                        <input type="hidden" name="specName1" value="{{$specName1}}">
														<ul id="specValue1">
															@foreach($specValue1 as $k=>$v)
															<li class="sku-line" onclick="specValue1('{{$v}}')">{{$v}}<i></i></li>
															@endforeach
														</ul>
                                                        <input type="hidden" name="specValue1" value="">
                                                    </div>
													<div class="theme-options">
														<div class="cart-title" id="specName2">{{$specName2}}</div>
                                                        <input type="hidden" name="specName2" value="{{$specName2}}">
                                                        <ul id="specValue2">

															@foreach($specValue2 as $k=>$v)
																<li class="sku-line"  onclick="specValue2('{{$v}}','{{$good->shopPrice}}')">{{$v}}<i></i></li>
                                                            @endforeach
                                                                <input type="hidden" name="specValue2" value="{{$v}}">

                                                        </ul>
													</div>
													<div class="theme-options">
														<div class="cart-title number">数量</div>
                                                        <input type="hidden" name="num" value="1">
														<dd>
															<input id="min" class="am-btn am-btn-default" name="" onclick="minus()" type="button" value="-" />
															<input id="text_box" name="" type="text" value="1"  style="width:30px;" />
															<input id="add" class="am-btn am-btn-default" name="" onclick='update()' type="button" value="+" />
															<span id="Stock" class="tb-hidden">库存<span class="stock">{{$good->goodsStock}}</span>件</span>
														</dd>
													</div>
													<div class="clear"></div>

													<div class="btn-op">
														<div class="btn am-btn am-btn-warning">确认</div>
														<div class="btn close am-btn am-btn-warning">取消</div>
													</div>
												</div>
												<div class="theme-signin-right">
													<div class="img-info">
														<img src="/h/images/songzi.jpg" />
													</div>
													<div class="text-info">
														<span class="J_Price price-now">¥39.00</span>
														<span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
													</div>
												</div>
										</div>
									</div>

								</dd>
							</dl>
							<div class="clear"></div>
							<!--活动	-->
							<div class="shopPromotion gold">
								<div class="hot">
									<dt class="tb-metatit">店铺优惠</dt>
									<div class="gold-list">
										<p>购物满2件打8折，满3件7折<span>点击领券<i class="am-icon-sort-down"></i></span></p>
									</div>
								</div>
								<div class="clear"></div>
								<div class="coupon">
									<dt class="tb-metatit">优惠券</dt>
									<div class="gold-list">
										<ul>
											<li>125减5</li>
											<li>198减10</li>
											<li>298减20</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="pay">
							<div class="pay-opt">
							<a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
							<a><span class="am-icon-heart am-icon-fw">收藏</span></a>

							</div>
							<li>
								<div class="clearfix tb-btn tb-btn-buy theme-login">
                                    <button style="width:98px;height:30px;border: 1px solid #F03726;background-color:#FFEDED;color: #F03726;" id="LikBuy" title="点此按钮到下一步确认购买信息" onclick="pay()">立即购买</button>
                                </div>

							</li>
							<li>
								<div class="clearfix tb-btn tb-btn-basket theme-login">
									<a id="LikBasket" title="加入购物车"  href="javascript:;" onclick="goodCart('{{$good->id}}')"><i></i>加入购物车</a>
								</div>
							</li>
						</div>

					</div>
				</form>

<div class="clear"></div>

				</div>

                    <script>


						// 立即购买 判断属性值是否选择
                        function pay() {
                            //判断商品规格值1是否存在
                            if ($('#specValue1').find('.selected').html() == undefined) {
                                layer.msg('请选择商品规格1', {icon:5, time:8000});
                                $("form").submit( function () {
                                    return false;
                                });
                                var t=setTimeout("location.href = location.href;",1000);
                                return  false
                            }
                            //判断商品规格值2是否存在
                            if ($('#specValue2').find('.selected').html() == undefined) {
                                layer.msg('请选择商品规格2', {icon:5, time:3000});
                                $("form").submit( function () {
                                    return false;
                                });
                                var t=setTimeout("location.href = location.href;",1000);
                                return  false
                            }


                        }
//                        点击规格值1
                        function specValue1(specValue1) {

                             $('input[name=specValue1]').val(specValue1);
                        }
                        {{--动态获取价格js--}}
                        function specValue2(val, shopPrice) {
                            let str1 = shopPrice.split(',');
                            if (val == '6+128' || val == '128' ) {
                                 $('.sys_item_price').html(str1[0]);
                                 $('input[name=shopPrice]').val(str1[0]);
                                 $('input[name=specValue2]').val(val);
                            }else if (val == '8+128' ||  val == '256' ) {
                                 $('.sys_item_price').html(str1[1]);
                                $('input[name=shopPrice]').val(str1[1]);
                                $('input[name=specValue2]').val(val);
                            }else if (val == '8+256' || val == '512' ){
                                 $('.sys_item_price').html(str1[2]);
                                $('input[name=shopPrice]').val(str1[2]);
                                $('input[name=specValue2]').val(val);
                            }
                        }

                        // 加
                        function update(obj) {
                            var num = parseInt($('#text_box').eq(0).val())+1;
                            $('input[name=num]').val(num);
                        }

                        // 减
                        function minus() {
                            num = $('#text_box').eq(0).val()-1;
                            $('input[name=num]').val(num);

                        }
                        // 加入购物车
                        function goodCart(id) {
                            $.ajaxSetup({
                                headers: {
//                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            //判断商品规格值1是否存在
                            if ($('#specValue1').find('.selected').html() == undefined) {
                                layer.msg('请选择商品规格1', {icon:5, time:3000});
                                return false;
                            }
                            if ($('#specValue2').find('.selected').html() == undefined) {
                                layer.msg('请选择商品规格2', {icon:5, time:3000});
                                return false;
                            }

                            let num =$('#text_box').eq(0).val();
                            // 规格名称1
                            let specName1 = $('#specName1').html();
                            //判断规格值
                            if ($('#specValue1').find('.selected').html() == undefined) {
                            	alert('商品属性1不能为空');
                            	return false;
                            }
                            
                            // 获取规格值1
                            let specValue1 = $('#specValue1').find('.selected').html().replace('<i></i>', '');


                            // 规格名称2
                            let specName2 = $('#specName2').html();
                            // 规格值2
                            if ($('#specValue2').find('.selected').html() == undefined) {
                            	alert('商品属性2不能为空')
                            	return false;
                            }
                            let specValue2 = $('#specValue2').find('.selected').html().replace('<i></i>', '');
                            // 店铺价格
                            let  shopPrice = $('#shopPrice').html();
                            $.post('/home/shopcart/store', {id,specName1,specValue1,specName2,specValue2,shopPrice,num},function (res) {
                                if(res.msg = 'error'){
                                    layer.msg(res.info,{icon:6})
                                }else{
                                    alert(res.info)
                                }
                            },'json');

                        }
                    </script>
				<!--优惠套装-->
				<div class="match">
					<div class="match-title">优惠套装</div>
					<div class="match-comment">
						<ul class="like_list">
							<li>
								<div class="s_picBox">
									<a class="s_pic" href="#"><img src="/h/images/cp.jpg"></a>
								</div> <a class="txt" target="_blank" href="#">萨拉米 1+1小鸡腿</a>
								<div class="info-box"> <span class="info-box-price">¥ 29.90</span> <span class="info-original-price">￥ 199.00</span> </div>
							</li>
							<li class="plus_icon"><i>+</i></li>
							<li>
								<div class="s_picBox">
									<a class="s_pic" href="#"><img src="/h/images/cp2.jpg"></a>
								</div> <a class="txt" target="_blank" href="#">ZEK 原味海苔</a>
								<div class="info-box"> <span class="info-box-price">¥ 8.90</span> <span class="info-original-price">￥ 299.00</span> </div>
							</li>
							<li class="plus_icon"><i>=</i></li>
							<li class="total_price">
								<p class="combo_price"><span class="c-title">套餐价:</span><span>￥35.00</span> </p>
								<p class="save_all">共省:<span>￥463.00</span></p> <a href="#" class="buy_now">立即购买</a> </li>
							<li class="plus_icon"><i class="am-icon-angle-right"></i></li>
						</ul>
					</div>
				</div>
				<div class="clear"></div>
				
							
				<!-- introduce-->

				<div class="introduce">
					<div class="browse">
					    <div class="mc"> 
						     <ul>					    
						     	<div class="mt">            
						            <h2>看了又看</h2>        
					            </div>
						     	
							      <li class="first">
							      	<div class="p-img">                    
							      		<a  href="#"> <img class="" src="/h/images/browse1.jpg"> </a>               
							      	</div>
							      	<div class="p-name"><a href="#">
							      		【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
							      	</a>
							      	</div>
							      	<div class="p-price"><strong>￥35.90</strong></div>
							      </li>
							      <li>
							      	<div class="p-img">                    
							      		<a  href="#"> <img class="" src="/h/images/browse1.jpg"> </a>               
							      	</div>
							      	<div class="p-name"><a href="#">
							      		【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
							      	</a>
							      	</div>
							      	<div class="p-price"><strong>￥35.90</strong></div>
							      </li>
							      <li>
							      	<div class="p-img">                    
							      		<a  href="#"> <img class="" src="/h/images/browse1.jpg"> </a>               
							      	</div>
							      	<div class="p-name"><a href="#">
							      		【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
							      	</a>
							      	</div>
							      	<div class="p-price"><strong>￥35.90</strong></div>
							      </li>							      
							      <li>
							      	<div class="p-img">                    
							      		<a  href="#"> <img class="" src="/h/images/browse1.jpg"> </a>               
							      	</div>
							      	<div class="p-name"><a href="#">
							      		【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
							      	</a>
							      	</div>
							      	<div class="p-price"><strong>￥35.90</strong></div>
							      </li>							      
							      <li>
							      	<div class="p-img">                    
							      		<a  href="#"> <img class="" src="/h/images/browse1.jpg"> </a>               
							      	</div>
							      	<div class="p-name"><a href="#">
							      		【三只松鼠_开口松子218g】零食坚果特产炒货东北红松子原味
							      	</a>
							      	</div>
							      	<div class="p-price"><strong>￥35.90</strong></div>
							      </li>							      
					      
						     </ul>					
					    </div>
					</div>
					<div class="introduceMain">
						<div class="am-tabs" data-am-tabs>
							<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active">
									<a href="#">

										<span class="index-needs-dt-txt">宝贝详情</span></a>

								</li>

								<li>
									<a href="#">

										<span class="index-needs-dt-txt" >全部评价</span></a>

								</li>

								<li>
									<a href="#">

										<span class="index-needs-dt-txt">猜你喜欢</span></a>
								</li>
							</ul>

							<div class="am-tabs-bd">

								<div class="am-tab-panel am-fade am-in am-active">
									{!!  $good->goodsinfo['goodsContent'] !!}
								</div>


								<div class="am-tab-panel am-fade">
									
                                    <div class="actor-new">
                                    	<div class="rate">                
                                    		<strong>100<span>%</span></strong><br> <span>好评度</span>            
                                    	</div>
                                        <dl>                    
                                            <dt>买家印象</dt>                    
                                            <dd class="p-bfc">
                                                <q class="comm-tags"><span>味道不错</span><em>(2177)</em></q>
                                                <q class="comm-tags"><span>颗粒饱满</span><em>(1860)</em></q>
                                                <q class="comm-tags"><span>口感好</span><em>(1823)</em></q>
                                                <q class="comm-tags"><span>商品不错</span><em>(1689)</em></q>
                                                <q class="comm-tags"><span>香脆可口</span><em>(1488)</em></q>
                                                <q class="comm-tags"><span>个个开口</span><em>(1392)</em></q>
                                                <q class="comm-tags"><span>价格便宜</span><em>(1119)</em></q>
                                                <q class="comm-tags"><span>特价买的</span><em>(865)</em></q>
                                                <q class="comm-tags"><span>皮很薄</span><em>(831)</em></q>
                                            </dd>                                           
                                         </dl> 
                                    </div>	
                                    <div class="clear"></div>
									<div class="tb-r-filter-bar">
										<ul class=" tb-taglist am-avg-sm-4">
											<li class="tb-taglist-li tb-taglist-li-current">
												<div class="comment-info">
													<span>全部评价</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-1">
												<div class="comment-info">
													<span>好评</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-0">
												<div class="comment-info">
													<span>中评</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li--1">
												<div class="comment-info">
													<span>差评</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>
										</ul>
									</div>
									<div class="clear"></div>

									<script>



                                        $(function(){
                                            let id = $('input[name=gid]').val();
                                            $.get('/home/comment/index/'+id, function (data) {
                                                $.each(data,function (idx,obj) {
                                                    console.log(obj.content);
                                               });
                                            },'json');

                                            {{--$.ajax({--}}
                                                {{--url:"{{ url('/home/comment/index/') }}",--}}
                                                {{--type:'get',--}}
                                                {{--data:{id:id},--}}
                                                {{--success:function (data) {--}}
                                                    {{--console.log(data);--}}
                                                {{--}--}}
                                            {{--});--}}
                                        });
                                    </script>
				        			<ul class="am-comments-list am-comments-list-flip">
										<li class="am-comment">
											<!-- 评论容器 -->
											<a href="">
												<img class="am-comment-avatar" src="/h/images/hwbn40x40.jpg" />
												<!-- 评论者头像 -->
											</a>

											<div class="am-comment-main">
												<!-- 评论内容容器 -->
												<header class="am-comment-hd">
													<!--<h3 class="am-comment-title">评论标题</h3>-->
													<div class="am-comment-meta">
														<!-- 评论元数据 -->
														<a href="#link-to-user" class="am-comment-author">b***1 (匿名)</a>
														<!-- 评论者 -->
														评论于
														<time datetime="">2015年11月02日 17:46</time>
													</div>
												</header>

												<div class="am-comment-bd">
													<div class="tb-rev-item " data-id="255776406962">
														<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
															摸起来丝滑柔软，不厚，没色差，颜色好看！买这个衣服还接到诈骗电话，我很好奇他们是怎么知道我买了这件衣服，并且还知道我的电话的！
														</div>
														<div class="tb-r-act-bar">
															颜色分类：柠檬黄&nbsp;&nbsp;尺码：S
														</div>
													</div>

												</div>
												<!-- 评论内容 -->
											</div>
										</li>
                                    </ul>


                                {{--<div class="">--}}
                                            <!--发表评论区begin-->

                                            <!--发表评论区end-->

                                            <!--评论列表显示区begin-->
                                            <!-- {$commentlist} -->
                                            {{--<div class="" >--}}

                                                <br>
                                                {{--<div class="comment-list" >--}}
                                                    <!--一级评论列表begin-->
                                                    <ul class="comment-ul am-comments-list am-comments-list-flip">
                                                        @if(isset($data))
                                                            @foreach($data as $v1)
                                                                <li comment_id="{{$v1->id}}" class="am-comment">
                                                                    <div class="am-comment-main">
                                                                        <div>
                                                                            <img class="head-pic"  src="{{$v1->head_pic}}" alt="">
                                                                        </div>
                                                                        <div class="cm">
                                                                            <div class="am-comment-hd">
                                                                                <div class="cm-header am-comment-meta">
                                                                                    <span>{{$v1->nickname}}</span>
                                                                                    <span>{{$v1->created_at}}</span>
                                                                                    <input type="hidden" name="id" value="{{ $good->id }}">
                                                                                </div>
                                                                            </div>

                                                                            <div class="cm-content ">
                                                                                <br>
                                                                                <p class="J_TbcRate_ReviewContent">
                                                                                    {!! $v1->content !!}
                                                                                </p>
                                                                            </div>
                                                                            <br>
                                                                            <div class="cm-footer tb-r-act-bar">
                                                                                <a class="comment-reply" comment_id="{{$v1->id}}" href="javascript:void(0);">回复</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!--二级评论begin-->
                                                                    <ul class="children">
                                                                        @if(isset($v1->children))
                                                                            @foreach($v1->children as $v2)

                                                                                <li comment_id="{{$v2->id}}" class="am-comment">
                                                                                    <div class="am-comment-main">
                                                                                        <div>
                                                                                            <img class="head-pic"  src="{{$v2->head_pic}}" alt="">
                                                                                        </div>

                                                                                        <div class="children-cm">
                                                                                            <div class="am-comment-hd">
                                                                                                <div class="cm-header am-comment-meta">
                                                                                                    <span>{{$v2->nickname}}</span>
                                                                                                    <span>{{$v2->created_at}}</span>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="cm-content">
                                                                                                <br>
                                                                                                <p class="J_TbcRate_ReviewContent">
                                                                                                    {!! $v2->content !!}
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="cm-footer tb-r-act-bar">
                                                                                                <a class="comment-reply" replyswitch="off" comment_id="{{$v2->id}}"  href="javascript:void(0);">回复</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!--三级评论begin-->
                                                                                    <ul class="children">
                                                                                        @if(isset($v2->children))
                                                                                            @foreach($v2->children as $v3)
                                                                                                <li comment_id="{{$v3->id}}">
                                                                                                    <div >
                                                                                                        <div>
                                                                                                            <img class="head-pic"  src="{{$v3->head_pic}}" alt="">
                                                                                                        </div>
                                                                                                        <div class="children-cm">
                                                                                                            <div  class="cm-header">
                                                                                                                <span>{{$v3->nickname}}</span>
                                                                                                                <span>{{$v3->created_at}}</span>
                                                                                                            </div>
                                                                                                            <div class="cm-content">
                                                                                                                <p>
                                                                                                                    {!! $v3->content !!}
                                                                                                                </p>
                                                                                                            </div>
                                                                                                            <div class="cm-footer">
                                                                                                                <!-- <a class="comment-reply" comment_id="1"  href="javascript:void(0);">回复</a> -->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </ul>
                                                                                    <!--三级评论end-->
                                                                                </li>
                                                                            @endforeach
                                                                        @endif
                                                                    </ul>
                                                                    <!--二级评论end-->

                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                    <!--一级评论列表end-->
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            <!--评论列表显示区end-->
                                        {{--</div>--}}





									<div class="clear"></div>

									<!--分页 -->
									<ul class="am-pagination am-pagination-right">
										<li class="am-disabled"><a href="#">&laquo;</a></li>
										<li class="am-active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
										<li><a href="#">&raquo;</a></li>
									</ul>
									<div class="clear"></div>

									<div class="tb-reviewsft">
										<div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
									</div>

								</div>

								<div class="am-tab-panel am-fade">
									<div class="like">
										<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
											<li>
												<div class="i-pic limit">
													<img src="/h/images/imgsearch1.jpg" />
													<p>【良品铺子_开口松子】零食坚果特产炒货
														<span>东北红松子奶油味</span></p>
													<p class="price fl">
														<b>¥</b>
														<strong>298.00</strong>
													</p>
												</div>
											</li>
										</ul>
									</div>
									<div class="clear"></div>

									<!--分页 -->
									<ul class="am-pagination am-pagination-right">
										<li class="am-disabled"><a href="#">&laquo;</a></li>
										<li class="am-active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
										<li><a href="#">&raquo;</a></li>
									</ul>
									<div class="clear"></div>

								</div>

							</div>

						</div>

						<div class="clear"></div>

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

				</div>
			</div>
			<!--菜单 -->
			<div class=tip>
				<div id="sidebar">
					<div id="wrap">
						<div id="prof" class="item">
							<a href="#">
								<span class="setting"></span>
							</a>
							<div class="ibar_login_box status_login">
								<div class="avatar_box">
									<p class="avatar_imgbox"><img src="/h/images/no-img_mid_.jpg" /></p>
									<ul class="user_info">
										<li>用户名：sl1903</li>
										<li>级&nbsp;别：普通会员</li>
									</ul>
								</div>
								<div class="login_btnbox">
									<a href="#" class="login_order">我的订单</a>
									<a href="/home/collect/index" class="login_favorite">我的收藏</a>
								</div>
								<i class="icon_arrow_white"></i>
							</div>

						</div>
						<div id="shopCart" class="item">
							<a href="#">
								<span class="message"></span>
							</a>
							<p>
								购物车
							</p>
							<p class="cart_num">0</p>
						</div>
						<div id="asset" class="item">
							<a href="#">
								<span class="view"></span>
							</a>
							<div class="mp_tooltip">
								我的资产
								<i class="icon_arrow_right_black"></i>
							</div>
						</div>

						<div id="foot" class="item">
							<a href="#">
								<span class="zuji"></span>
							</a>
							<div class="mp_tooltip">
								我的足迹
								<i class="icon_arrow_right_black"></i>
							</div>
						</div>

						<div id="brand" class="item">
							<a href="/home/collect/index">
								<span class="wdsc"><img src="/h/images/wdsc.png" /></span>
							</a>
							<div class="mp_tooltip">
								我的收藏
								<i class="icon_arrow_right_black"></i>
							</div>
						</div>

						<div id="broadcast" class="item">
							<a href="#">
								<span class="chongzhi"><img src="/h/images/chongzhi.png" /></span>
							</a>
							<div class="mp_tooltip">
								我要充值
								<i class="icon_arrow_right_black"></i>
							</div>
						</div>

						<div class="quick_toggle">
							<li class="qtitem">
								<a href="#"><span class="kfzx"></span></a>
								<div class="mp_tooltip">客服中心<i class="icon_arrow_right_black"></i></div>
							</li>
							<!--二维码 -->
							<li class="qtitem">
								<a href="#none"><span class="mpbtn_qrcode"></span></a>
								<div class="mp_qrcode" style="display:none;"><img src="/h/images/weixin_code_145.png" /><i class="icon_arrow_white"></i></div>
							</li>
							<li class="qtitem">
								<a href="#top" class="return_top"><span class="top"></span></a>
							</li>
						</div>

						<!--回到顶部 -->
						<div id="quick_links_pop" class="quick_links_pop hide"></div>

					</div>

				</div>
				<div id="prof-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						我
					</div>
				</div>
				<div id="shopCart-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						购物车
					</div>
				</div>
				<div id="asset-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						资产
					</div>

					<div class="ia-head-list">
						<a href="#" target="_blank" class="pl">
							<div class="num">0</div>
							<div class="text">优惠券</div>
						</a>
						<a href="#" target="_blank" class="pl">
							<div class="num">0</div>
							<div class="text">红包</div>
						</a>
						<a href="#" target="_blank" class="pl money">
							<div class="num">￥0</div>
							<div class="text">余额</div>
						</a>
					</div>

				</div>
				<div id="foot-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						足迹
					</div>
				</div>
				<div id="brand-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						收藏
					</div>
				</div>
				<div id="broadcast-content" class="nav-content">
					<div class="nav-con-close">
						<i class="am-icon-angle-right am-icon-fw"></i>
					</div>
					<div>
						充值
					</div>
				</div>
			</div>

	</body>

</html>