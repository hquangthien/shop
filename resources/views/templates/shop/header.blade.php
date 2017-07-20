<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="{{ $adminUrl }}assets/images/favicon.ico">
        <title>@yield('title')</title>
        <link href="{{ $publicUrl }}css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ $publicUrl }}css/font-awesome.min.css" rel="stylesheet">
        <link href="{{ $publicUrl }}css/prettyPhoto.css" rel="stylesheet">
        <link href="{{ $publicUrl }}css/price-range.css" rel="stylesheet">
        <link href="{{ $publicUrl }}css/animate.css" rel="stylesheet">
        <link href="{{ $publicUrl }}css/main.css" rel="stylesheet">
        <link href="{{ $publicUrl }}css/custom.css" rel="stylesheet">
        <link href="{{ $publicUrl }}css/responsive.css" rel="stylesheet">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ $publicUrl }}images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ $publicUrl }}images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ $publicUrl }}images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="{{ $publicUrl }}images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->

    <body>
    <div id="spin"></div>
    <div id="messages-success-alert" class="card-box">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        <span id="message-success-ajax">Thành công!!!</span>
    </div>
    <div id="messages-error-alert" class="alert alert-danger"><i class="fa fa-info-circle" aria-hidden="true"></i>
        <span id="message-success-ajax">Thất bại!!!</span>
    </div>
    <div class="box_1" id="shopping-cart">
        <a class="to_cart" href="{{ route('shop.bill.cart') }}">
            <h3> <div class="total">
                    <span class="simpleCart_total"></span></div>
                <img src="{{ $publicUrl }}images/ca.png" alt="" width="45px"></h3>
            <span class="qty">
                @if(session('cart'))
                    {{ session('cart')->totalQty }}
                    @else
                    0
                @endif
            </span>
        </a>
    </div>
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="{{ route('shop.index.index') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                                    <li><a href="{{ route('shop.page.contact') }}"><i class="fa fa-envelope"></i> Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="#"><i class="fa fa-phone"></i> +01639817671</a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i> hquangthien@gmail.com</a></li>
                                    <li><a href="https://www.facebook.com/hquangthien.dtu"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->

            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="{{ route('shop.index.index') }}"><img src="{{ $publicUrl }}images/home/logo.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    @if(Auth::check())
                                    <li>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"><i class="fa fa-user"></i>  {{ Auth::user()->fullname }} <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu" style="width: 200px">
                                                <li>
                                                    <a href="{{ route('shop.profile.index', ['slug' => str_slug(Auth::user()->fullname)]) }}">
                                                        <i class="fa fa-user"></i> Thông tin cá nhân
                                                    </a>
                                                </li>
                                                @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                                                    <li>
                                                        <a href="{{ route('admin.index.index') }}">
                                                            <i class="fa fa-home"></i> Trang quản trị
                                                        </a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="{{ route('ban.index.index') }}">
                                                        <i class="fa fa-home"></i> Mở shop
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('shop.profile.history', ['slug' => str_slug(Auth::user()->fullname)]) }}">
                                                        <i class="fa fa-clock-o"></i> Lịch sử mua hàng
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('shop.profile.favorite', ['slug' => str_slug(Auth::user()->fullname)]) }}">
                                                        <i class="fa fa-heart-o"></i> Yêu thích
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('logout') }}">
                                                        <i class="fa fa-power-off"></i> Đăng xuất
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>


                                    </li>
                                    @else
                                        <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse pull-left">
                                    <li><a href="{{ route('shop.index.index') }}">Trang chủ</a></li>
                                    <li class="dropdown"><a href="javascript:void(0)">Danh mục<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            @foreach($objSuperCat as $superCat)
                                                <li><a href="{{ route('shop.product.cat', ['slug' => str_slug($superCat->name), 'id' => $superCat->id]) }}">{{ $superCat->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('shop.page.contact') }}">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="search_box pull-right">
                                <form action="{{ route('shop.search') }}" method="GET">
                                    <input type="text" id="key_search" value="@if(isset($key_search)){{$key_search}}@endif" name="key_search" placeholder="Tìm kiếm">
                                </form>
                                <div style="position: relative">
                                    <div id="result-search">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->
