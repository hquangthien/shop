@extends('templates.shop.master3')
@section('title')
    {{ $objShop->name }} | {{ $objCurrentCat->name }}
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
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->

            <h2 class="title text-center">{{ $objCurrentCat->name }}</h2>
            <hr/>
            @if(sizeof($objProduct) == 0)
                <p class="alert alert-warning text-center"> Chưa có sản phẩm nào thuộc danh mục này được đăng bán </p>
            @else
                <div id="list-product">
                    @foreach($objProduct as $product)
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center fader iitem">
                                        <div class="fix-with" style="height: 191px;">
                                            <a href="{{ route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id]) }}">
                                                <img src="{{ Storage::url('app/files/') }}{{ $product->picture }}"
                                                     alt=""/>
                                            </a>
                                        </div>
                                        <br/>
                                        <h5>
                                            <span @if($product->promotion_price != 0) style="text-decoration: line-through" @endif>{{ number_format($product->price) }}</span>
                                            @if($product->promotion_price != 0) {{ number_format($product->price - ($product->price * $product->promotion_price)/100) }} @endif
                                            <strong>VND</strong></h5>
                                        <a href="{{ route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id]) }}">
                                            <p>{{ str_limit($product->name, 20) }}</p>
                                        </a>
                                        <a href="javascript:void(0)" onclick="addCart({{ $product->id }})"
                                           class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                            giỏ hàng</a>
                                    </div>
                                    @if($product->new == 'new')
                                        <img src="{{ $publicUrl }}images/home/new.png" class="new" alt=""/>
                                    @endif
                                    @if($product->promotion_price != null)
                                        <img src="{{ $publicUrl }}images/home/sale.png" class="sale" alt=""/>
                                    @endif
                                </div>
                                <div class="choose row">
                                    <div class="col-xs-6 pull-left">
                                        <a style="color: #b3afa8; font-size: 13px;" href="{{ route('subshop.index', ['slug' => str_slug($product->shop_name), 'id' => $product->shop_id]) }}">
                                            <i style="color: green" class="fa fa-home"></i> {{ $product->shop_name }}
                                        </a>
                                    </div>
                                    <div class="col-xs-6 pull-right">
                                        <a style="color: #b3afa8; font-size: 13px;" onclick="changeActive({{ $product->id }})" href="javascript:void(0)">
                                            <i id="pro_fav_{{ $product->id }}"
                                               @if(in_array($product->id, $arFavorite))style="color: red"
                                               @endif class="fa fa-heart"></i> Yêu thích
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div style="clear: both"></div>
            <div class="row text-center">
                {{ $objProduct->links() }}
            </div>
        </div><!--features_items-->
    </div>
@endsection