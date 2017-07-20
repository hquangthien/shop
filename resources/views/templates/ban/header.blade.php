<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{ $adminUrl }}assets/images/favicon.ico">

    <!-- App title -->
    <title>@yield('title')</title>

    <!-- App CSS -->
    <link href="{{ $adminUrl }}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/responsive.css" rel="stylesheet" type="text/css" />
    @yield('css')
    <![endif]-->

    <script src="{{ $adminUrl }}assets/js/modernizr.min.js"></script>

</head>


<body class="fixed-left">
<div class="se-pre-con"></div>
<div id="spin"></div>
<div id="messages-success-alert" class="card-box">
    <i class="fa fa-info-circle" aria-hidden="true"></i>
    <span id="message-success-ajax">Thao tác thành công!!!</span>
</div>
<div id="messages-error-alert" class="alert alert-danger"><i class="fa fa-info-circle" aria-hidden="true"></i>
    <span id="message-success-ajax">Thao tác thất bại!!!</span>
</div>
<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="index.html" class="logo"><span>GREEN MARKET<span>admin</span></span><i class="zmdi zmdi-layers"></i></a>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">

                <!-- Page title -->
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <button class="button-menu-mobile open-left">
                            <i class="zmdi zmdi-menu"></i>
                        </button>
                    </li>
                    <li>
                        <h4 class="page-title">@yield('h1')</h4>
                    </li>
                </ul>

            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->