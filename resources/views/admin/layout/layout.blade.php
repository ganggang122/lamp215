<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>


<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/d/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/Huploadify/Huploadify.css">
<link rel="stylesheet" href="/layui/css/layui.css">
<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/d/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/d/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/d/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/d/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/d/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/css/themer.css" media="screen">
<link href="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>xin-shop</title>
@section('css')

@show
</head>

<body>

    <!-- Header -->
    <div id="mws-header" class="clearfix">
    
        <!-- Logo Container -->
        <div id="mws-logo-container">
        
            <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
            <div id="mws-logo-wrap">
                <img src="/d/images/mws-logo.png" alt="mws admin">
            </div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            
                <!-- User Photo -->
                <div id="mws-user-photo">
                    <img src="/d/example/profile.jpg" alt="User Photo">
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello, {{ 0?session('admin_user_info')->uname  :2 }}
                    </div>
                    <ul>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Change Password</a></li>
                        <li><a href="/admin/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
        <!-- Necessary markup, do not remove -->
        <div id="mws-sidebar-stitch"></div>
        <div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <!-- Searchbox -->
            <div id="mws-searchbox" class="mws-inset">
                <form action="typography.html">
                    <input type="text" class="mws-search-input" placeholder="Search...">
                    <button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
                </form>
            </div>
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                    <li>
                        <a href="#"><i class="icon-user"></i> 用户管理</a>
                        <ul>
                            <li><a href="/admin/users/create">添加用户</a></li>
                            <li><a href="/admin/users">用户列表</a></li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#"><i class="icon-align-justify"></i> 栏目管理</a>
                        <ul>
                            <li><a href="/admin/cates/create">添加栏目</a></li>
                            <li><a href="/admin/cates">栏目列表</a></li>
                        </ul>
                    </li>
                </ul>

                   <ul>
                    <li>
                        <a href="#"><i class="icon-align-justify"></i> 轮播图管理</a>
                        <ul>
                            <li><a href="/admin/banners/create">添加轮播图</a></li>
                            <li><a href="/admin/banners">轮播图列表</a></li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#"><i class="icon-align-justify"></i> 链接管理</a>
                        <ul>
                            <li><a href="/admin/links/create">添加链接</a></li>
                            <li><a href="/admin/links">链接列表</a></li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li class="active">
                        <a href="#"><i class="icon-add-contact"></i>管理员</a>
                        <ul>
                            <li><a href="/admin/adminuser">管理员列表</a></li>
                            <li><a href="/admin/adminuser/create">添加管理员</a></li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li class="active">
                        <a href="#"><i class="icon-add-contact"></i>岗位管理</a>
                        <ul>
                            <li><a href="/admin/role">岗位列表</a></li>
                            <li><a href="/admin/role/create">添加岗位</a></li>
                        </ul>
                    </li>
                </ul>                
                <ul>
                    <li class="active">
                        <a href="#"><i class="icon-tags"></i>权限管理</a>
                        <ul>
                            <li><a href="/admin/node">权限列表</a></li>
                            <li><a href="/admin/node/create">添加权限</a></li>
                        </ul>
                    </li>
                </ul>
                 <ul>
                    <li>
                        <a href="#"><i class="icon-align-justify"></i> 收货地址管理</a>
                        <ul>
                            <li><a href="/admin/address">收货地址列表</a></li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#"><i class="icon-align-justify"></i> 新闻管理</a>
                        <ul>
                            <li><a href="/admin/news/create">添加新闻</a></li>
                            <li><a href="/admin/news">新闻列表</a></li>
                        </ul>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a href="#"><i class="icon-dribbble"></i>品牌管理</a>
                        <ul>
                            <li><a href="/admin/brands/create">添加品牌</a></li>
                            <li><a href="/admin/brands">品牌列表</a></li>

                        </ul>
                    </li>
                </ul>


                 <ul>
                    <li>
                        <a href="#"><i class="icon-align-justify"></i>商品规格管理</a>
                        <ul>
                            <li><a href="/admin/specific/create">添加规格</a></li>
                            <li><a href="/admin/specific">规格列表</a></li>

                        </ul>
                    </li>
                </ul>
                  <ul>
                    <li>
                        <a href="#"><i class="icon-align-justify"></i>商品管理</a>
                        <ul>
                            <li><a href="/admin/goods/create">添加商品</a></li>
                            <li><a href="/admin/goods">商品列表</a></li>
                        </ul>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a href="#"><i class="layui-icon layui-icon-tree"></i>商品管理</a>
                        <ul>
                            <li><a href="/admin/goods/create">添加商品</a></li>
                            <li><a href="/admin/goods">商品列表</a></li>

                        </ul>
                    </li>
                </ul>

    
                <ul>

                    <li>
                        <a href="#"><i class="icon-dribbble"></i>商城头条</a>
                        <ul>
                            <li><a href="/admin/blog/create">添加头条</a></li>
                            <li><a href="/admin/blog">头条列表</a></li>

                        </ul>
                    </li>
                </ul>                
            </div>
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
            <!-- 内容开始 -->
            <div class="container">
                @if(session('error'))
                <div class="mws-form-message error">
                    {{session('error')}}
                </div>
                @endif
                 @if(session('success'))
                <div class="mws-form-message success">
                    {{session('success')}}
                </div>
                @endif
                @section('content')

                @show
            </div>
            <!-- 内容结束 -->
                       
            <!-- Footer -->
            <div id="mws-footer">
                Copyright Your Website 2012. All Rights Reserved.
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->


    <script src="/Huploadify/jquery.Huploadify.js"></script>
    <script src="/layui/layui.all.js"></script>
    <script src="/d/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/d/js/libs/jquery.placeholder.min.js"></script>
    <script src="/d/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/d/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/d/jui/jquery-ui.custom.min.js"></script>
    <script src="/d/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/d/plugins/colorpicker/colorpicker-min.js"></script>

    <!-- Core Script -->
    <script src="/d/bootstrap/js/bootstrap.min.js"></script>
    <script src="/d/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/d/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->


</body>
</html>
