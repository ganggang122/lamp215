<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>物流</title>

    <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

    <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/h/css/lostyle.css" rel="stylesheet" type="text/css">

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
            <div class="user-logistics">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">物流跟踪</strong> / <small>Logistics&nbsp;History</small></div>
                </div>
                <hr/>
                <div class="package-title">
                    <div class="m-item">
                        <div class="item-pic">
                            <img src="{{$courier_img}}" class="itempic J_ItemImg">
                        </div>
                        <div class="item-info">
                            <p class="log-status">物流状态:<span>已签收</span> </p>
                            <p>承运公司：{{$courier_company}}</p>
                            <p>快递单号：{{$courier_num}}</p>
                            <p>官方电话：{{$courier_phone}}</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="package-status">
                    <ul class="status-list">
                        @foreach($courier_data as $k=>$v)
                        <li class="latest">
                            <p class="text">{{$v['context']}}
                                <br>
                            </p>
                            <br>
                            <div class="time-list">

                                {{--<span class="date">2015-12-19</span><span class="week">周六</span><span class="time">15:35:42</span>--}}
                                <span class="date"><span class="time">{{$v['time']}}</span></span>

                            </div>
                        </li>
                        @endforeach


                    </ul>
                </div>
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