<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>个人资料</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/h/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/h/css/infstyle.css" rel="stylesheet" type="text/css">
		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
			
	</head>
	<style  type="text/css">
	 .am-form-group~img{
	   	 position: absolute;
         margin-top: 5px;
        
         width:90px;

	   }

	    
    </style>
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

					<div class="user-info">
						           @if (count($errors) > 0)
								    <div class="alert alert-danger">
								        <ul>
								            @foreach ($errors->all() as $error)
								                <li style="color:red;margin:auto">*{{ $error }}</li>
								            @endforeach
								        </ul>
								    </div>
								    @endif

						            @if(session('error'))
									   <script  type="text/javascript">   
									    alert("{{ session('error') }}")
									   </script>
									@endif
									 @if(session('success'))
									   <script  type="text/javascript">   
									    alert("{{ session('success') }}")
									   </script>
									@endif
							
						<hr/>

						<!--头像 -->
						<div class="user-infoPic">

							<div class="filePic">

								<input type="file" name="profile" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
								@if(session('home_usersinfo')->home->profile)
							    <img class="am-circle am-img-thumbnail" src="/uploads/{{session('home_usersinfo')->home->profile }}" alt="" />
							    @else
								<img class="am-circle am-img-thumbnail" src="/h/	images/getAvatar.do.jpg" alt="" />
								@endif
							</div>

							<p class="am-form-help">头像</p>

							<div class="info-m">
								<div><b>用户名：<i>
								@if(!empty( session('home_usersinfo')->home->nickname ))
								{{ session('home_usersinfo')->home->nickname }}
								@else
							    {{ str_random(5) }}
							    @endif
								</i></b></div>
								<div class="u-level">
									<span class="rank r2">
							             <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
						            </span>
								</div>
								<div class="u-safety">
									<a href="safety.html">
									 账户安全
									<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
									</a>
								</div>
							</div>
						</div>

						<!--个人信息 -->
						<div class="info-main">
							@if (count($errors) > 0)
								    <div class="alert alert-danger">
								        <ul>
								            @foreach ($errors->all() as $error)
								               <script>alert('{{ $error }}')</script>
								            @endforeach
								        </ul>
								    </div>
								@endif
								@if(session('error'))
									   <script  type="text/javascript">   
									    alert('{{ session('error') }}')
									   </script>
									@endif	
							<form class="am-form am-form-horizontal"  action="/home/information/create"  method="post" enctype="multipart/form-data">
                                     {{ csrf_field() }}
								<div class="am-form-group">
									<label for="user-name2" class="am-form-label">昵称</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" placeholder="nickname" value="{{ session('home_usersinfo')->home->nickname}}"  name="nickname">

									</div>
								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">登录名</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" placeholder="请使用拼音"  value="{{$users_data->uname}}" name="uname" >

									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="m" data-am-ucheck> 男
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="f" data-am-ucheck> 女
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="secret" data-am-ucheck> 保密
										</label>
									</div>
								</div>
                              <script type="text/javascript" src="/riqi.js"></script>
								<div class="am-form-group">
									<label for="user-birth" class="am-form-label">生日</label>
									<div class="am-form-content birth" >
										<div class="birth-select" >
										<select id ="year" name="year" onclick="getYear()" >
  		                                   <option value="year">年</option>
  	                                  </select>
											<em>年</em>
										</div>
										<div class="birth-select2">
										 <select id="month" name="moth" onclick="getMonth()" >
  		                                    <option  value="moth">月</option>

  	                                     </select>
                                          <em>月</em></div>
										<div class="birth-select2">
											<select   name="day" id="day">
  		                                           <option  value="day">日</option>
  	                                         </select>

											<em>日</em></div>
									</div>
							
								</div>
								@if(!session('home_usersinfo')->phone)
								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">电子邮箱</label>
									<div class="am-form-content">
										<input id="user-phone" placeholder="telephonenumber" type="tel"  value="{{$users_data->email}}" name="phone"  disabled>

									</div>
								</div>
								<img   src="/h/images/shouji.jpg"><a style="position:absolute;margin-left:100px;font-size:15px;margin-top:30px"  href="/home/email/phone">绑定手机</a>
								@endif
								@if(!session('home_usersinfo')->email)
								<div class="am-form-group">
									<label for="user-email" class="am-form-label">电话</label>
									<div class="am-form-content">
										<input id="user-email" placeholder="Email" type="email" value="{{$users_data->phone}}" name="email"  disabled>

									</div>
								</div>
								<img  src="/h/images/youxiang.jpg">
								<a href="/home/email/index" style="position:absolute;margin-left:100px;font-size:15px;margin-top:30px">绑定邮箱</a>
								@endif
								<div class="am-form-group"  style="margin-top:100px">
									<label for="user-email" class="am-form-label">头像</label>
									<div class="am-form-content">
										<input  id="user-email" type="file" name="profile"  >

									</div>
								</div>
								

								
								<div class="info-btn">
									<input  type="submit" class="am-btn am-btn-danger"  value="保存修改">
								</div>

							</form>
						</div>

					</div>

				</div>
			   <script language="javascript">
			    getBirthday();
		      </script>
				<!--底部-->
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

@include('home.public.information.footer')