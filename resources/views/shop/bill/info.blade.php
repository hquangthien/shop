@extends('templates.shop.master')
@section('title')
    Xác nhận thông tin
@endsection
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('shop.index.index') }}">Trang chủ</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            <div>
                <a href="javascript:void(0)">Xác nhận thông tin <i class="fa fa-chevron-right"></i></a>
                Chọn hình thức thanh toán
                <i class="fa fa-chevron-right"></i>
                Đặt hàng
            </div>
            <br />
            @if(!Auth::check())
            <div class="register-req">
                <p>Đăng ký trước khi mua hàng để dễ dàng hơn trong việc quản lý lịch sử mua hàng của bạn?
                    <a href="{{ route('register') }}">Đăng ký</a>
                </p>
            </div><!--/register-req-->
            @endif

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="shopper-info">
                            <?php  $objInfo = null; ?>
                            @if(session('info'))
                                <?php
                                    $objInfo = session('info');
                                ?>
                            @elseif(Auth::check())
                                <?php
                                    $objInfo = Auth::user();
                                    $objInfo['name'] = Auth::user()->fullname;
                                ?>
                            @endif
                            <p>Thông tin khách hàng</p>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('shop.bill.payment') }}" method="POST">

                                {{ csrf_field() }}
                                @if(!$objInfo == null)
                                    <input type="text" name="name" placeholder="Tên khách hàng..."
                                        value="{{ $objInfo['name'] }}"
                                    >
                                    <input type="text" value="{{ $objInfo['phone'] }}" name="phone" placeholder="Số điện thoại">
                                    <input type="text" value="{{ $objInfo['address'] }}" name="address" placeholder="Địa chỉ..">
                                    <input type="email" value="{{ $objInfo['email'] }}" name="email" placeholder="Email...">
                                @else
                                    <input type="text" name="name" placeholder="Tên khách hàng...">
                                    <input type="text" name="phone" placeholder="Số điện thoại">
                                    <input type="text" name="address" placeholder="Địa chỉ..">
                                    <input type="email" name="email" placeholder="Email...">
                                @endif
                                    <textarea name="note" cols="30" placeholder="Ghi chú..." rows="10">@if(session('info')){{ session('info')['note'] }}@endif</textarea>
                                <button class="btn btn-primary" type="submit">Tiếp tục</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection