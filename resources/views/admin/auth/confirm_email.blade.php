
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
    <title>Trang đăng nhập</title>

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
        <a href="index.html" class="logo"><span>VN EXPRESS<span></span></span></a>
    </div>
    <div class="m-t-40 card-box">
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">Đăng nhập</h4>
        </div>
        @if(session('msg'))
            <p class="alert alert-danger">{{ session('msg') }}</p>
        @endif
        <div class="panel-body text-center">
            <img src="{{ $adminUrl }}assets/images/mail_confirm.png" alt="img" class="thumb-lg m-t-20 center-block">
            <form class="form-horizontal m-t-20" action="{{ route('register.store') }}" method="POST">
                {{ csrf_field() }}
                <p class="text-muted font-13 m-t-20"> Mã xác nhận đã được gửi đến
                    <b>{{ $email }}</b>. Vui lòng check email và điền mã xác nhận tại đây để hoàn tất đăng ký tài khoản.
                </p>
                <input class="form-control" name="username" type="hidden" value="{{ $username }}">
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="confirm" type="text" placeholder="Mã xác nhận...">
                    </div>
                </div>

                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Xác nhận</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="javascript:void(0)" onclick="alert('comming soon!!!')" class="text-muted"><i class="fa fa-lock m-r-5"></i> Gửi lại mã xác nhân</a>
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