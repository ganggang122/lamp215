<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>发表评论</title>

    <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

    <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/h/css/appstyle.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
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

            <div class="user-comment">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">发表评论</strong> / <small>Make&nbsp;Comments</small></div>
                </div>
                <hr/>
                @foreach($orders4 as $k=>$v)
                    <form action="/home/orders/commentsotre" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <input type="hidden" name="gid" value="{{$v->gid}}">
                        <input type="hidden" name="id" value="{{$v->id}}">
                    <div class="comment-main">
                    <div class="comment-list">
                        <div class="item-pic">
                            <a href="#" class="J_MakePoint">
                                <img src="{{$v->goodsinfo['goodsPhotoinfo1']}}" class="itempic">
                            </a>
                        </div>

                        <div class="item-title">

                            <div class="item-name">
                                <a href="#">
                                    <p class="item-basic-info">{{$v->goods['goodsName']}}</p>
                                </a>
                            </div>
                            <div class="item-info">
                                <div class="info-little">
                                    <span>{{$v->specname1}}</span>
                                    <span>{{$v->specname2}}</span>
                                </div>
                                <div class="item-price">
                                    价格：<strong>{{$v->goodsprice}}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="item-comment">
                            <textarea placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！" name="content"></textarea>

                        </div>
                        <div class="filePic">
                            <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" >
                            <span>晒照片(0/5)</span>
                            <img src="/h/images/image.jpg" alt="">
                        </div>
                        <div class="item-opinion">
                            <li><i class="op1"></i>好评</li>
                            <li><i class="op2"></i>中评</li>
                            <li><i class="op3"></i>差评</li>
                        </div>
                    </div>

                    <!--多个商品评论-->

                    <div class="info-btn">
                        <button class="am-btn am-btn-danger">发表评论</button>
                    </div>
                    </form>
                    <script type="text/javascript">


                        $(document).ready(function() {
                            $(".comment-list .item-opinion li").click(function() {
                                $(this).prevAll().children('i').removeClass("active");
                                $(this).nextAll().children('i').removeClass("active");
                                $(this).children('i').addClass("active");

                            });
                        })
                    </script>



                </div>
                    @endforeach
            </div>

        </div>
        <!--底部-->
        <div class="footer">
            @include('home.public.footer')
        </div>
    </div>

    @include('home.public.information.footer')
</div>

</body>

</html>