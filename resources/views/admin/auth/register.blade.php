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
    <title>Trang đăng ký</title>

    <!-- App CSS -->
    <link href="{{ $adminUrl }}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="{{ $adminUrl }}assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="{{ $adminUrl }}assets/js/modernizr.min.js"></script>

</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="text-center">
        <a href="index.html" class="logo"><span>VN EXPRESS</span></a>
    </div>
    <div class="m-t-40 card-box">
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">Đăng ký</h4>
        </div>
        <div class="panel-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('msg'))
                <p class="alert alert-danger">{{ session('msg') }}</p>
            @endif
            <form class="form-horizontal m-t-20" action="{{ route('register') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="username" type="text" placeholder="Nhập tên tài khoản (*)...">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="email" type="email" placeholder="Nhập email (*)...">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="confirm_email" type="text" placeholder="Nhập lại email (*)...">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="password" type="password" placeholder="Nhập mật khẩu (*)...">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="confirm_password" type="password" placeholder="Nhập lại mật khẩu (*)...">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="fullname" type="text" placeholder="Nhập họ tên (*)...">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="phone" type="text" placeholder="Nhập số điện thoại...">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="address" type="text" placeholder="Nhập địa chỉ...">
                    </div>
                </div>

                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Đăng ký</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="javascript:void(0)" onclick="alert('comming soon!!!')" class="text-muted"><i class="fa fa-lock m-r-5"></i> Quên mật khẩu?</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- end card-box-->

</div>
<!-- end wrapper page -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{ $adminUrl }}assets/js/jquery.min.js"></script>
<script src="{{ $adminUrl }}assets/js/bootstrap.min.js"></script>
<script src="{{ $adminUrl }}assets/js/detect.js"></script>
<script src="{{ $adminUrl }}assets/js/fastclick.js"></script>
<script src="{{ $adminUrl }}assets/js/jquery.slimscroll.js"></script>
<script src="{{ $adminUrl }}assets/js/jquery.blockUI.js"></script>
<script src="{{ $adminUrl }}assets/js/waves.js"></script>
<script src="{{ $adminUrl }}assets/js/wow.min.js"></script>
<script src="{{ $adminUrl }}assets/js/jquery.nicescroll.js"></script>
<script src="{{ $adminUrl }}assets/js/jquery.scrollTo.min.js"></script>

<!-- App js -->
<script src="{{ $adminUrl }}assets/js/jquery.core.js"></script>
<script src="{{ $adminUrl }}assets/js/jquery.app.js"></script>

</body>
</html>