@extends('templates.ban.master')
@section('title')
    Trang quản lý tin tức
@endsection
@section('h1')
    Trang quản lý tin tức
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Thêm sản phẩm</h4>

                        <div class="row">
                            <div class="col-lg-12">
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
                                    <p class="alert alert-success">{{ session('msg') }}</p>
                                @endif
                                <form class="form-horizontal m-t-20" action="{{ route('ban.info.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" name="name" type="text" value="{{ $objShop->name }}" placeholder="Nhập tên shop...">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" name="phone" type="text" value="{{ $objShop->phone }}" placeholder="Nhập số điện thoại của shop...">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" name="address" value="{{ $objShop->address }}" type="text" placeholder="Nhập địa chỉ của shop...">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" name="website" value="{{ $objShop->website }}" type="text" placeholder="Nhập website của shop...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="payment">Chọn hình thức thanh toán</label>
                                        <div class="col-xs-12">
                                            @foreach($objPayment as $payment)
                                                <input class="" value="{{ $payment->id }}" @if($payment->shop_id != null) checked @endif name="payment[]" type="checkbox"> {{ $payment->name }} <br>
                                            @endforeach
                                        </div>
                                    </div>


                                    <div class="form-group text-center m-t-30">
                                        <div class="col-xs-3 col-xs-offset-5">
                                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Cập nhật</button>
                                        </div>
                                    </div>

                                </form>
                            </div><!-- end col -->

                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
@section('css')
    <link rel="stylesheet" href="{{ $adminUrl }}assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="{{ $adminUrl }}assets/css/bootstrap-tagsinput.css">
@endsection
