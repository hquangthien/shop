@extends('templates.shop.master3')
@section('title')
    {{ $objShop->name }} | Liên hệ
@endsection
@section('nvarbar')
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a href="{{ route('subshop.index', ['slug' => str_slug($objShop->name), 'id' => $objShop->id]) }}">Trang chủ shop {{ $objShop->name }}</a></li>
            <li><a href="{{ route('subshop.feedback', ['slug' => str_slug($objShop->name), 'id' => $objShop->id]) }}">Đánh giá - Phản hồi</a></li>
            <li><a href="{{ route('subshop.contact', ['slug' => str_slug($objShop->name), 'id' => $objShop->id]) }}">Liên hệ shop {{ $objShop->name }}</a></li>
        </ul>
    </div>
    <br /><br /><br /><br />
@endsection
@section('left_bar')
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Danh mục</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                @foreach($objSuperCatOfShop as $superCat)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="{{ route('subshop.cat', ['slug' => str_slug($objShop->name), 'id' => $objShop->id, 'cat_name' => str_slug($superCat->name), 'cat_id' => $superCat->id]) }}">
                                    {{ $superCat->name }}
                                </a>
                                @if(isset($objSubCatOfShop[$superCat->id]))
                                    <a data-toggle="collapse" href="#{{ str_slug($superCat->name) }}">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    </a>
                                @endif

                            </h4>
                        </div>
                        @if(isset($objSubCatOfShop[$superCat->id]))
                            <div id="{{ str_slug($superCat->name) }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        @foreach($objSubCatOfShop[$superCat->id] as $subCat1)
                                            <li>
                                                <a href="{{ route('subshop.cat', ['slug' => str_slug($objShop->name), 'id' => $objShop->id, 'cat_name' => str_slug($subCat1->name), 'cat_id' => $subCat1->id]) }}">
                                                    {{ $subCat1->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div><!--/category-products-->

            <div class="shipping text-center"><!--shipping-->
                <img src="{{ Storage::url('app/files/') }}{{ $objRightAdv[0]->image }}" alt="">
            </div><!--/shipping-->

        </div>
    </div>
@endsection
@section('content')
    <div class="col-md-9">
        <div class="row text-center">
            <div class="col-sm-12">
                <div class="contact-info">
                    <h2 class="title text-center">Thông tin về chúng tôi</h2>
                    <address>
                        <p>{{ $objShop->name }}</p>
                        <p>{{ $objShop->address }}</p>
                        <p>Mobile: {{ $objShop->phone }}</p>
                        <p>Email: {{ $objShop->email }}</p>
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
        <div class="row">
            <div class="col-sm-12 padding-right">
                <div class="features_items"><!--features_items-->
                    <div class="contact-form">
                        <h2 class="title text-center">Nhập thông tin liên hệ</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form row" action="{{ route('subshop.contact', ['slug' => str_slug($objShop->name), 'id' => $objShop->id]) }}" name="contact-form" method="post">
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
                                <input type="hidden" name="shop_id" class="form-control" value="{{ $objShop->id }}">
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

                </div><!--features_items-->
            </div>
        </div>
    </div>
@endsection