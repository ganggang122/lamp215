<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>付款成功页面</title>
<link rel="stylesheet"  type="text/css" href="/h/AmazeUI-2.4.2/assets/css/amazeui.css"/>
<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />

<link href="/h/css/sustyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/h/basic/js/jquery-1.7.min.js"></script>

</head>

<body>


<!--顶部导航条 -->
@include('home.public.information.header')
<!--悬浮搜索框-->





<div class="take-delivery">
 <div class="status">
   <h2>您已成功付款</h2>
   <div class="successInfo">
     <ul>
       <li>付款金额<em>{{$zongji}}</em></li>
       <div class="user-info">
         <p>收货人：{{$address->uname}}</p>
         <p>联系电话：{{$address->phone}}</p>
         <p>收货地址：{{$address->address}}</p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服
                               
     </ul>
   
    </div>
  </div>
</div>


<div class="footer" >
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


</body>
</html>
