@include('home.public.header')
	<div class="clear"></div>
			</div>
			<div class="banner">
                      <!--轮播 -->


						<div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">


							<ul class="am-slides">


								@foreach($banners as $k=>$v)
									<li class="banner1"><a href="javascript:;"><img src="/uploads/{{$v->url}}"  /></a></li>
									
								@endforeach

							</ul>
						</div>
						<div class="clear"></div>	

						<div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">
                        
                        <ul class="am-slides">
                            @foreach($banners as $k=>$v)
                            <li class="banner1"><a href="/home/list/index/{{$v->cid}}/n"><img src="/uploads/{{ $v->url }}" /></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="clear"></div>  

			</div>
			<div class="shopNav">
				<div class="slideall">
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
		        		
						<!--侧边导航 -->
						<div id="nav" class="navfull">
							<div class="area clearfix">
								<div class="category-content" id="guide_2">
									
									<div class="category">
										<ul class="category-list" id="js_climit_li">
											@foreach($common_cate_data as $k=>$v)
											<li class="appliance js_toggle relative first">
												<div class="category-info">
													<h3 class="category-name b-category-name"><i><img src="/h/images/cake.png"></i><a class="ml-22" title="点心">{{$v->cname}}</a></h3>
													<em>&gt;</em></div>
												<div class="menu-item menu-in top">
													<div class="area-in">
														<div class="area-bg">
															<div class="menu-srot">
																<div class="sort-side">
																	@foreach($v->sub as $kk=>$vv)
																	<dl class="dl-sort">
																		<dt><span title="{{$vv->cname}}">{{$vv->cname}}</span></dt>
																		@foreach($vv->sub as $kkk=>$vvv)
																		<dd><a title="{{$vvv->cname}}" href="/home/list/index/{{$vvv->id}}/n"><span>{{$vvv->cname}}</span></a></dd>
																		@endforeach
																	</dl>
																	
																	@endforeach

																</div>
																
															</div>
														</div>
													</div>
												</div>
											<b class="arrow"></b>	
											</li>
											@endforeach
										</ul>
									</div>
								</div>

							</div>
						</div>
						
						
						<!--轮播-->
						
						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block")
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});
							})
						</script>



					<!--小导航 -->
					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="/h/images/navsmall.jpg" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/h/images/huismall.jpg" />
								<div class="title">大聚惠</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="/home/personal"><img src="/h/images/mansmall.jpg" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/h/images/moneysmall.jpg" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div>

					<!--走马灯 -->

					<div class="marqueen">
						<span class="marqueen-title">商城头条</span>
						<div class="demo">

							<ul>
								@foreach($headline1 as $v)
								<li class="title-first"><a target="_blank" href="/home/blog/{{ $v->id }}">
									{{ $v->title }}
								     <img src="/h/images/TJ.jpg"></img>
								     <p>XXXXXXXXXXXXXXXXXX</p>
							    </a></li>
							    @endforeach
						<div class="mod-vip">
							@if(session('home_usersinfo'))
							<div class="m-baseinfo">
								<a href="/home/personal">
									@if(session('home_usersinfo')->home->profile)
									<img src="/uploads/{{ session('home_usersinfo')->home->profile }}">
									@else
									<img src="/h/images/getAvatar.do.jpg">
									@endif
								</a>
								<em>
									Hi,<span class="s-name" title="{{session('home_usersinfo')->home->nickname }}">@if(!empty( session('home_usersinfo')->home->nickname ))
									{{ session('home_usersinfo')->home->nickname }}
									@else
								    {{ str_random(5) }}
								    @endif</span>
									<a href="/home/logout">退出</a>			
									&nbsp;&nbsp;&nbsp;
								    						
								</em>
							</div>
							@else
							<div class="m-baseinfo">
								<a href="person/index.html">
									<img src="/h/images/getAvatar.do.jpg">
								</a>
								<em>
									Hi,<span class="s-name">小叮当</span>
									<a href="#"><p>点击更多优惠活动</p></a>									
								</em>
							</div>
							<div class="member-logout">
								<a class="am-btn-warning btn" href="/home/login/index">登录</a>
								<a class="am-btn-warning btn" href="/home/register">注册</a>
							</div>
							@endif
							<div class="member-login">
								<a href="#"><strong>0</strong>待收货</a>
								<a href="#"><strong>0</strong>待发货</a>
								<a href="#"><strong>0</strong>待付款</a>
								<a href="#"><strong>0</strong>待评价</a>
							</div>
							<div class="clear"></div>	
						</div>																	    
							    @foreach($headline2 as $v)
								<li><a target="_blank" href="/home/blog/{{ $v->id }}">{{ $v->title }}</a></li>
								@endforeach
							</ul>
                        <div class="advTip"><img src="/h/images/advTip.jpg"/></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script>
			</div>
			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->

					<div class="am-g am-g-fixed recommendation">
						<div class="clock am-u-sm-3" >
							<img src="/h/images/2016.png "></img>
							<p>今日<br>推荐</p>
						</div>
						@foreach($recommends as $v)
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>{{ $v->big }}</h3>
								<h4>{{ $v->small }}</h4>
							</div>
							<div class="recommendationMain one">
								<a href="/home/list/index/{{ $v->cid }}/n"><img src="/uploads/{{ $v->profile }}" style='width:120px;border-radius:5%'></img></a>
							</div>
						</div>						
						@endforeach

					</div>
					<div class="clear "></div>
					<!--热门活动 -->

					<div class="am-container activity ">
						<div class="shopTitle ">
							<h4>活动</h4>
							<h3>每期活动 优惠享不停 </h3>
							<span class="more ">
                              <a href="# ">全部活动<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					  <div class="am-g am-g-fixed ">
						<div class="am-u-sm-3 ">
							<div class="icon-sale one "></div>	
								<h4>秒杀</h4>							
							<div class="activityMain ">
								<img src="/uploads/{{ $seckills[0]->profile }} "></img>
							</div>
							<div class="info ">
								<h3>{{ $seckills[0]->seckill }}</h3>
							</div>														
						</div>
						
						<div class="am-u-sm-3 ">
						  <div class="icon-sale two "></div>	
							<h4>秒杀</h4>
							<div class="activityMain ">
								<img src="/uploads/{{ $seckills[1]->profile }} "></img>
							</div>
							<div class="info ">
								<h3>{{ $seckills[1]->seckill }}</h3>								
							</div>							
						</div>						
						
						<div class="am-u-sm-3 ">
							<div class="icon-sale three "></div>
							<h4>秒杀</h4>
							<div class="activityMain ">
								<img src="/uploads/{{ $seckills[2]->profile }} "></img>
							</div>
							<div class="info ">
								<h3>{{ $seckills[2]->seckill }}</h3>
							</div>							
						</div>						

						<div class="am-u-sm-3 last ">
							<div class="icon-sale "></div>
							<h4>秒杀</h4>
							<div class="activityMain ">
								{{--<img src="/uploads/{{ $seckills[3]->profile }} " />--}}
							</div>
							<div class="info ">
								{{--<h3>{{ $seckills[3]->seckill }}</h3>--}}
							</div>													
						</div>

					  </div>
                   </div>
					<div class="clear "></div>
        
                    <div id="f3">
					<!--甜点-->
				@foreach($common_cate_data as $k=>$v)
					<div class="am-container ">
						<div class="shopTitle ">
							<h4>{{$v->cname}}</h4>
							
							<div class="today-brands ">
								@foreach($v['sub'] as $kk=>$vv)
									@foreach($vv['sub'] as $kkk=>$vvv)
								<a href="/home/list/index/{{$vvv->id}}/n">{{$vvv->cname}}</a>
									@endforeach
								@endforeach
							</div>
							<span class="more ">
                    <a href="# ">更多<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					</div>
					
					<div class="am-g am-g-fixed floodFour">
						<div class="am-u-sm-5 am-u-md-4 text-one list ">
							<div class="word">		
							</div>
							<a href="# ">
								<div class="outer-con ">
									<div class="title ">
									开抢啦！
									</div>
																		
								</div>
                                  <img src="/h/images/act1.png " />								
							</a>
							<div class="triangle-topright"></div>						
						</div>
						@foreach($v['sub'] as $kk=>$vv)
							@foreach($vv['sub'] as $kkk=>$vvv)
								@foreach($id[$vvv->id] as $kkkk=>$vvvv)
							<div class="am-u-sm-7 am-u-md-4 text-two big">
								<div class="outer-con ">
									<div class="title ">
										{{$vvvv->goodsName}}
									</div>									
									<div class="sub-title ">
										¥{{$vvvv->shopPrice}}
									</div>
									
								</div>
								<a href="/home/good/info/{{$vvvv->id}}"><img src="{{$vvvv->goodsinfo['goodsPhotoinfo1']}}" /></a>
							</div>
								@endforeach
							@endforeach
						@endforeach


						
					</div>
                 <div class="clear "></div>                 
                 </div>
  

                    <div id="f4">
   				@endforeach
   
   
					<div class="footer ">
						@include('home.public/footer')
						
					</div>

		</div>
		</div>
		<!--引导 -->
		<div class="navCir">
			<li class="active"><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>


		<!--菜单 -->
		<div class=tip>
			<div id="sidebar">
				<div id="wrap">
					<div id="prof" class="item ">
						<a href="# ">
							<span class="setting "></span>
						</a>
						<div class="ibar_login_box status_login ">
							<div class="avatar_box ">
								@if(session('home_usersinfo'))
								<p class="avatar_imgbox ">
									@if(session('home_usersinfo')->home->profile)
									<img src="/uploads/{{ session('home_usersinfo')->home->profile }}">
									@else
									<img src="/h/images/getAvatar.do.jpg">
									@endif
								    </p>
								    @endif
								<ul class="user_info ">
									<li>用户名&nbsp;
								@if(!empty( session('home_usersinfo')->home->nickname ))
								{{ session('home_usersinfo')->home->nickname }}
								@else
							    {{ str_random(5) }}
							    @endif</li>
									<li>级&nbsp;别普通会员</li>
								</ul>
							</div>
							<div class="login_btnbox ">
								<a href="# " class="login_order ">我的订单</a>
								<a href="/home/collect/index" class="login_favorite ">我的收藏</a>
							</div>
							<i class="icon_arrow_white "></i>
						</div>

					</div>
					<div id="shopCart " class="item ">
						<a href="# ">
							<span class="message "></span>
						</a>
						<p>
							购物车
						</p>
						<p class="cart_num ">0</p>
					</div>
					<div id="asset " class="item ">
						<a href="# ">
							<span class="view "></span>
						</a>
						<div class="mp_tooltip ">
							我的资产
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="foot " class="item ">
						<a href="# ">
							<span class="zuji "></span>
						</a>
						<div class="mp_tooltip ">
							我的足迹
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="brand " class="item ">
						<a href="/home/collect/index">
							<span class="wdsc "><img src="/h/images/wdsc.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我的收藏
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="broadcast " class="item ">
						<a href="# ">
							<span class="chongzhi "><img src="/h/images/chongzhi.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我要充值
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div class="quick_toggle ">
						<li class="qtitem ">
							<a href="# "><span class="kfzx "></span></a>
							<div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
						</li>
						<!--二维码 -->
						<li class="qtitem ">
							<a href="#none "><span class="mpbtn_qrcode "></span></a>
							<div class="mp_qrcode " style="display:none; "><img src="/h/images/weixin_code_145.png " /><i class="icon_arrow_white "></i></div>
						</li>
						<li class="qtitem ">
							<a href="#top " class="return_top "><span class="top "></span></a>
						</li>
					</div>

					<!--回到顶部 -->
					<div id="quick_links_pop " class="quick_links_pop hide "></div>

				</div>

			</div>
			<div id="prof-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					我
				</div>
			</div>
			<div id="shopCart-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					购物车
				</div>
			</div>
			<div id="asset-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					资产
				</div>

				<div class="ia-head-list ">
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">优惠券</div>
					</a>
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">红包</div>
					</a>
					<a href="# " target="_blank " class="pl money ">
						<div class="num ">￥0</div>
						<div class="text ">余额</div>
					</a>
				</div>

			</div>
			<div id="foot-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					足迹
				</div>
			</div>
			<div id="brand-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					收藏
				</div>
			</div>
			<div id="broadcast-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					充值
				</div>
			</div>
		</div>
		<script>
			window.jQuery || document.write('<script src="/h/basic/js/jquery.min.js "><\/script>');
		</script>
		<script type="text/javascript " src="/h/basic/js/quick_links.js "></script>
	</body>

</html>