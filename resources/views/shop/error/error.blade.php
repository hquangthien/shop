
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ $publicUrl }}css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ $publicUrl }}css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ $publicUrl }}css/prettyPhoto.css" rel="stylesheet">
    <link href="{{ $publicUrl }}css/price-range.css" rel="stylesheet">
    <link href="{{ $publicUrl }}css/animate.css" rel="stylesheet">
    <link href="{{ $publicUrl }}css/main.css" rel="stylesheet">
    <link href="{{ $publicUrl }}css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ $publicUrl }}js/html5shiv.js"></script>
    <script src="{{ $publicUrl }}js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ $publicUrl }}images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ $publicUrl }}images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ $publicUrl }}images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ $publicUrl }}images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{ $publicUrl }}images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <div class="container text-center">
        <div class="logo-404">
            <a href="{{ route('shop.index.index') }}"><img src="{{ $publicUrl }}images/home/logo.png" alt="" /></a>
        </div>
        <div class="content-404">
            <img src="{{ $publicUrl }}images/404/404.png" class="img-responsive" alt="" />
            <h1><b>OPPS!</b> Không tìm thấy</h1>
            <p>Có vẻ như trang bạn yêu cầu không tồn tại hoặc đã bị xóa.</p>
            <h2><a href="{{ route('shop.index.index') }}">Quay về trang chủ</a></h2>
        </div>
    </div>
    <br /><br />
    
    <script src="{{ $publicUrl }}js/jquery.js"></script>
    <script src="{{ $publicUrl }}js/price-range.js"></script>
    <script src="{{ $publicUrl }}js/jquery.scrollUp.min.js"></script>
    <script src="{{ $publicUrl }}js/bootstrap.min.js"></script>
    <script src="{{ $publicUrl }}js/jquery.prettyPhoto.js"></script>
    <script src="{{ $publicUrl }}js/main.js"></script>
</body>
</html>