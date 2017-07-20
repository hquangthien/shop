@extends('templates.shop.master')
@section('title')
    Chọn hình thức giao hàng
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
                <a href="{{ route('shop.bill.confirm_info') }}">Xác nhận thông tin <i class="fa fa-chevron-right"></i></a>
                <a href="javascript:void(0)">Chọn hình thức thanh toán <i class="fa fa-chevron-right"></i></a>
                Đặt hàng
            </div>
            <br />

            <div class="row">
                <div class="col-xs-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('payment'))
                        <?php
                            $paymentCurrent = session('payment');
                        ?>
                    @else
                        <?php
                            $paymentCurrent = null;
                        ?>
                    @endif
                    <form action="{{ route('shop.bill.post_checkout') }}" method="POST">
                        {{ csrf_field() }}
                    @foreach($objPayment as $payment)
                        <input class="" value="{{ $payment->id }}" @if($paymentCurrent == $payment->id) checked @endif name="payment" type="radio"> {{ $payment->name }} <br>
                    @endforeach
                        <input type="submit" class="btn btn-primary" value="Tiếp tục">
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection