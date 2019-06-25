<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>地址管理</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/h/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/h/css/stepstyle.css" rel="stylesheet" type="text/css">

		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
		<link rel="stylesheet" href="/layui-v2.4.5/layui/css/layui.css">
	    <script src="/layui-v2.4.5/layui/layui.js"></script>
		<meta name="csrf-token" content="{{ csrf_token() }}">

	</head>
     
<script>
//一般直接写在一个js文件中
layui.use(['layer', 'form'], function(){
  var layer = layui.layer
 
 
});
</script> 
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

					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
					</div>
					<hr/>
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
                            </span>
							<span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
							<span class="u-progress-placeholder"></span>
						</div>
						<div class="u-progress-bar total-steps-2">
							<div class="u-progress-bar-inner"></div>
						</div>
					</div>
					<form class="am-form am-form-horizontal">
						<div class="am-form-group">
							<label for="user-old-password" class="am-form-label">原密码</label>
							<div class="am-form-content">
								<input type="password" id="user-old-password" placeholder="请输入原登录密码">
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-new-password" class="am-form-label">新密码</label>
							<div class="am-form-content">
								<input type="password" id="user-new-password" placeholder="由数字、字母组合">
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-confirm-password" class="am-form-label">确认密码</label>
							<div class="am-form-content">
								<input type="password" id="user-confirm-password" placeholder="请再次输入上面的密码">
							</div>
						</div>
						<div class="info-btn">
							<div class="am-btn am-btn-danger"  onclick="update()">保存修改</div>
						</div>

					</form>

				</div>
				<!--底部-->
			        <div class="footer ">
						@include('home.public.footer')
						
					</div>
			</div>

			<script  type="text/javascript">
				$.ajaxSetup({
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    }
				});
				  function  update(){
				  	  let oldupass =  $('#user-old-password').eq(0).val();
				  	  let newupass =  $('#user-new-password').eq(0).val();
				  	  let reupass  =  $('#user-confirm-password').eq(0).val();

				  	 var upwd_value =  {
							regMobile : /^[\w]{6,18}$/,
					 } 
					 flag1=upwd_value.regMobile.test(oldupass);

					if(!flag1){
			          layer.msg('密码格式不对');
			          return  false;
				      }

				     var upwd_val =  {
							regMobile : /^[\w]{6,18}$/,
					 } 
					 flag2=upwd_val.regMobile.test(newupass);

					if(!flag2){
			          layer.msg('新密码格式不对');
			          return  false;
				      }

				   if(newupass == ''){
			      	 layer.msg('密码不能为空');
		             return  false;
			       }

			        if(reupass == ''){
			      	 layer.msg('密码不能为空');
		             return  false;
			       }


                      

			      if(newupass != reupass){
			      	 layer.msg('两次密码不一致');
		             return  false;
			      }     

			     
				    
 

				  	  $.post('/home/safe/update', {oldupass,newupass},function(res){
                             if(res.msg = 'error'){
                             	layer.msg(res.info)
                             }else{
                             	alert(res.info)
                             }
				  	  },'json');
				  }
                 
			</script>
@include('home.public.information.footer')