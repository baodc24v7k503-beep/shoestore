<!DOCTYPE html>
<html>
<head>
<title>Super Market an Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Super Market Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('frontend/css/font-awesome.css') }}" rel="stylesheet"> 
<script src="{{ asset('frontend/js/jquery-1.11.1.min.js') }}"></script>
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="{{ asset('frontend/js/move-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/easing.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){     
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>

<!-- CSS TÙY CHỈNH TÌM KIẾM & FOOTER -->
<style>
    /* Custom Search Form */
    .custom-search-form {
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 320px;
        margin: 0 auto;
    }
    .custom-search-input {
        width: 100% !important;
        height: 40px !important;
        padding: 8px 15px !important;
        border: 2px solid #fe980f !important;
        border-right: none !important;
        border-radius: 4px 0 0 4px !important;
        outline: none !important;
        font-size: 14px;
        box-sizing: border-box;
    }
    .custom-search-btn {
        height: 40px !important;
        width: 48px !important;
        background-color: #fe980f !important;
        border: 2px solid #fe980f !important;
        color: #ffffff !important;
        border-radius: 0 4px 4px 0 !important;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .custom-search-btn:hover {
        background-color: #e08306 !important;
        border-color: #e08306 !important;
    }

    /* Custom Modern Footer */
    .modern-footer {
        background-color: #242424;
        color: #b0b0b0;
        padding: 50px 0 20px 0;
    }
    .modern-footer h3 {
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 25px;
        position: relative;
        letter-spacing: 0.5px;
    }
    .modern-footer h3::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -8px;
        width: 35px;
        height: 2px;
        background-color: #fe980f;
    }
    .footer-address {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-address li {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-size: 14px;
    }
    .footer-address li i {
        color: #fe980f;
        font-size: 15px;
        width: 32px;
        height: 32px;
        border: 1px solid #fe980f;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
    }
    .footer-address li a {
        color: #b0b0b0;
        text-decoration: none;
        transition: color 0.3s;
    }
    .footer-address li a:hover {
        color: #fe980f;
    }
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-links li {
        margin-bottom: 12px;
    }
    .footer-links li a {
        color: #b0b0b0;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-block;
    }
    .footer-links li a i {
        color: #fe980f;
        font-size: 11px;
        margin-right: 8px;
        transition: transform 0.3s ease;
    }
    .footer-links li a:hover {
        color: #fe980f;
        padding-left: 5px;
    }
    .footer-links li a:hover i {
        transform: translateX(3px);
    }
    .footer-bottom-copy {
        border-top: 1px solid #333333;
        margin-top: 40px;
        padding-top: 20px;
        text-align: center;
        font-size: 13px;
    }
    .footer-bottom-copy a {
        color: #fe980f;
        text-decoration: none;
    }
    .footer-botm-custom {
        background-color: #1a1a1a;
        padding: 15px 0;
        border-top: 1px solid #2a2a2a;
    }
    .social-icons-custom {
        padding: 0;
        margin: 0;
        list-style: none;
        display: flex;
        align-items: center;
    }
    .social-icons-custom li {
        margin-right: 10px;
    }
    .social-icons-custom li a {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #333333;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: background-color 0.3s;
    }
    .social-icons-custom li a:hover {
        background-color: #fe980f;
    }
</style>
</head>
    
<body>
    <div class="agileits_header">
        <div class="container">
            <div class="w3l_offers">
                <p>Giảm giá đến 70%. Nhanh tay mua sắm. <a href="{{ route('/') }}">Mua ngay</a></p>
            </div>
            <div class="agile-login">
                <ul>
                    <li><a href="{{ route('lien-he') }}">Liên hệ</a></li>
                    @guest
                        @if (Route::has('dang-nhap'))
                            <li><a href="{{ route('dang-nhap') }}">Đăng nhập</a></li>
                        @endif
            
                        @if (Route::has('dang-ky'))
                            <li><a href="{{ route('dang-ky') }}">Đăng ký</a></li>
                        @endif
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                @if(Auth::user()->role == 1)
                                    <li>
                                        <a class="dropdown-item text-primary" style="color: #333 !important;" href="{{ route('admin.dashboard') }}">
                                            <i class="fa fa-user-secret mr-1"></i> Trang quản trị
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <a href="{{ route('profile.show') }}" style="color: #333 !important;">
                                        <i class="fa fa-user" aria-hidden="true"></i> Thông tin cá nhân
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('logout') }}" style="color: #333 !important;"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest 
                </ul>
            </div>
            <div class="product_list_header">
                <a href="{{ route('gio-hang') }}" style="color: #ffffff; text-decoration: none;">
                    <i class="fa fa-shopping-cart" aria-hidden="true" style="color: #ffffff; font-size: 20px;"></i>
                </a>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

    <div class="logo_products">
        <div class="container">
            <div class="w3ls_logo_products_left1">
                <ul class="phone_email">
                    <li><i class="fa fa-phone" aria-hidden="true"></i>Đặt hàng online hoặc liên hệ hotline: (+0123) 234 567 </li>
                </ul>
            </div>
            <div class="w3ls_logo_products_left">
                <h1><a href="{{ route('/') }}">shoe store</a></h1>
            </div>
            <div class="w3ls_search">
                <form action="{{ route('product.search') }}" method="GET" class="custom-search-form">
                    <input type="search" 
                           name="keywords" 
                           value="{{ request('keywords') }}" 
                           placeholder="Tìm kiếm sản phẩm..." 
                           required=""
                           class="custom-search-input">
                    <button type="submit" class="custom-search-btn" aria-label="Search">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

    <div class="navigation-agileits">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="navbar-header nav_2">
                    <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ route('/') }}" class="act">Trang chủ</a></li>    
                        <!-- Mega Menu -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sản phẩm<b class="caret"></b></a>
                            <ul class="dropdown-menu multi-column columns-3">
                                <div class="row">
                                    <div class="multi-gd-img">
                                        <ul class="multi-column-dropdown">
                                            @foreach($categories as $key => $cate)
                                                <li><a href="{{ route('danh-muc', ['id' => $cate->id]) }}">{{ $cate->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>  
                                </div>
                            </ul>
                        </li>
                        @auth
                            <li>
                                <a href="{{ route('user.orders') }}">
                                    Đơn hàng
                                </a>
                            </li>
                        @endauth
                        <li><a href="{{ route('lien-he') }}">Liên hệ</a></li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>

    @yield('slider')

    <!-- VÙNG NỘI DUNG CHÍNH -->
    <div class="main-content-wrapper" style="min-height: 500px; padding: 40px 0; background-color: #f9f9f9;">
        @yield('content')
    </div>

    <!-- FOOTER MỚI -->
    <div class="footer modern-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 w3_footer_grid">
                    <h3>Liên hệ</h3>
                    <ul class="footer-address">
                        <li>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>123 Đường ABC, Phường X, TP. Hồ Chí Minh</span>
                        </li>
                        <li>
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <a href="mailto:info@example.com">info@example.com</a>
                        </li>
                        <li>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>(+0123) 234 567</span>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6 w3_footer_grid">
                    <h3>Thông tin</h3>
                    <ul class="footer-links"> 
                        <li><a href="{{ route('/') }}"><i class="fa fa-chevron-right"></i>Trang chủ</a></li>
                        <li><a href="{{ route('lien-he') }}"><i class="fa fa-chevron-right"></i>Liên hệ</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i>Về chúng tôi</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i>Chính sách bảo mật</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6 w3_footer_grid">
                    <h3>Danh mục</h3>
                    <ul class="footer-links"> 
                        @foreach($categories as $key => $cate)
                            <li>
                                <a href="{{ route('danh-muc', ['id' => $cate->id]) }}">
                                    <i class="fa fa-chevron-right"></i>{{ $cate->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6 w3_footer_grid">
                    <h3>Tài khoản</h3>
                    <ul class="footer-links"> 
                        <li><a href="{{ route('gio-hang') }}"><i class="fa fa-chevron-right"></i>Giỏ hàng</a></li>
                        @guest
                            <li><a href="{{ route('dang-nhap') }}"><i class="fa fa-chevron-right"></i>Đăng nhập</a></li>
                            <li><a href="{{ route('dang-ky') }}"><i class="fa fa-chevron-right"></i>Đăng ký</a></li>
                        @else
                            <li><a href="{{ route('profile.show') }}"><i class="fa fa-chevron-right"></i>Thông tin cá nhân</a></li>
                            <li><a href="{{ route('user.orders') }}"><i class="fa fa-chevron-right"></i>Đơn hàng của tôi</a></li>
                        @endguest
                    </ul>
                </div>
            </div>

            <div class="footer-bottom-copy">
                <p>© Shoe Store. All rights reserved | Designed for Shoe Store</p>
            </div>
        </div>
    </div>  

    <div class="footer-botm-custom">
        <div class="container">
            <div class="row" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                <div class="col-md-6 col-sm-6">
                    <ul class="social-icons-custom">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6 text-right">  
                    <img src="{{ asset('frontend/images/card.png') }}" alt="Card" class="img-responsive" style="display: inline-block; max-height: 28px;">
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $().UItoTop({ easingType: 'easeOutQuart' });
    });
</script>
<script src="{{ asset('frontend/js/minicart.min.js') }}"></script>
<script>
    paypal.minicart.render({
        action: '#'
    });

    if (~window.location.search.indexOf('reset=true')) {
        paypal.minicart.reset();
    }
</script>
<script src="{{ asset('frontend/js/skdslider.min.js') }}"></script>
<link href="{{ asset('frontend/css/skdslider.css') }}" rel="stylesheet">
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
                
        jQuery('#responsive').change(function(){
            $('#responsive_wrapper').width(jQuery(this).val());
        });
    });
</script>   
</body>
</html>