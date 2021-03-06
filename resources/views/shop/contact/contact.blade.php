@extends('templates.shop.master')
@section('title')
    Eshoper | Liên hệ
@endsection
@section('content')
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Liên hệ</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Nhập thông tin liên hệ</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form row" action="{{ route('shop.page.contact') }}" name="contact-form" method="post">
                            {{ csrf_field() }}
                            @if ($errors->any())
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
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Họ tên">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" class="form-control" required="required" placeholder="Chủ đề">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="detail" id="message" required="required" class="form-control" rows="8" placeholder="Nội dung"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Thông tin về chúng tôi</h2>
                        <address>
                            <p>E-Shopper Inc.</p>
                            <p>183/19 Phan Thanh - Thạc Gián - Thanh Khê - Đà Nẵng</p>
                            <p>Mobile: +841639817671</p>
                            <p>Email: hquangthien@gmail.com</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Mạng xã hội</h2>
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/hquangthien.dtu"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection