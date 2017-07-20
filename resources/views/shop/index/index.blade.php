@extends('templates.shop.master2')
@section('title')
    Trang chủ E-shopper | Mua bán trở nên thật dễ dàng
@endsection
@section('slider')
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($objPinProduct as $key => $product)
                                <li data-target="#slider-carousel" data-slide-to="{{ $key }}" @if($key==0)class="active"@endif></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner">
                            @foreach($objPinProduct as $key => $product)
                                <div class="item @if($key == 0) active @endif">
                                    <div class="col-sm-6">
                                        <h1>{{ $product->shop_name }}</h1>
                                        <h2>{{ str_limit($product->name, 30) }}</h2>
                                        <p>
                                            <strong>Giá: </strong>
                                            <span @if($product->promotion_price != 0) style="text-decoration: line-through" @endif>{{ number_format($product->price) }}</span>
                                            @if($product->promotion_price != 0) {{ number_format(($product->price * $product->promotion_price)/100) }} @endif
                                            <strong>VND</strong>
                                        </p>
                                        <a href="{{ route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id]) }}"
                                           type="button" class="btn btn-default get">Mua ngay</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ Storage::url('app/files/') }}{{ $product->picture }}"
                                             class="girl img-responsive" alt=""/>
                                        <img src="{{ $publicUrl }}images/home/pricing.png" class="pricing" alt=""/>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->
@endsection
@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Sản phẩm bán chạy nhất</h2>
            @foreach($objHotProduct as $product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center fader iitem">
                                <div class="fix-with" style="height: 237px;">
                                    <a href="{{ route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id]) }}">
                                        <img src="{{ Storage::url('app/files/') }}{{ $product->picture }}" alt=""/>
                                    </a>
                                </div>
                                <br/><br/><br/>
                                <h4>
                                    <span @if($product->promotion_price != 0) style="font-size: 14px; text-decoration: line-through" @endif>{{ number_format($product->price) }}</span>
                                    @if($product->promotion_price != 0) {{ number_format($product->price - ($product->price * $product->promotion_price)/100) }} @endif
                                    <strong>VND</strong></h4>
                                <p>
                                    <a href="{{ route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id]) }}">
                                        {{ str_limit($product->name, 30) }}
                                    </a>
                                </p>
                                <a href="javascript:void(0)" onclick="addCart({{ $product->id }})"
                                   class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                            </div>
                            @if($product->new == 'new')
                                <img src="{{ $publicUrl }}images/home/new.png" class="new" alt=""/>
                            @endif
                            @if($product->promotion_price != null)
                                <img src="{{ $publicUrl }}images/home/sale.png" class="sale" alt=""/>
                            @endif
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li>
                                    <a href="{{ route('subshop.index', ['slug' => str_slug($product->shop_name), 'id' => $product->shop_id]) }}">
                                        <i style="color: green" class="fa fa-home"></i> {{ $product->shop_name }}
                                    </a>
                                <li>
                                    <a href="javascript:void(0)" onclick="favoriteHotProduct({{ $product->id }})">
                                        <i id="hotpro_fav_{{ $product->id }}" @if(in_array($product->id, $arFavorite))style="color: red"@endif class="fa fa-heart"></i>Yêu thích
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

        </div><!--features_items-->
        @foreach($arProductInRemainCat as $key => $objProduct)
            <?php
            $tmp = explode('|', $key);
            $idParrentCat = array_first($tmp);
            $nameParrentCat = end($tmp);
            ?>
            <div class="category-tab"><!--category-tab-->
                <h2 class="title text-center">
                    <a style="color: #FE980F"
                       href="{{ route('shop.product.cat', ['slug' => str_slug($nameParrentCat), 'id' => $idParrentCat]) }}">
                        {{ $nameParrentCat }}
                    </a>
                </h2>
                <div class="col-sm-12">
                    @if(isset($objSubCat1[$idParrentCat]))
                        <ul class="nav nav-tabs">
                            @for($i = 0; $i <= 3; $i++)
                                @if(!isset($objSubCat1[$idParrentCat][$i]))
                                    @break
                                @endif
                                <?php $subCat1 = $objSubCat1[$idParrentCat][$i]; ?>
                                <li><a href="{{ route('shop.product.cat', ['slug' => str_slug($subCat1->name), 'id' => $subCat1->id]) }}">{{ $subCat1->name }}</a></li>
                            @endfor
                            @if(isset($objSubCat1[$idParrentCat][$i]))
                                <li class="pull-right">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Khác
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        @while(true)
                                            @if(!isset($objSubCat1[$idParrentCat][$i]))
                                                @break
                                            @endif
                                            <?php $subCat1 = $objSubCat1[$idParrentCat][$i]; $i++; ?>
                                            <li><a href="{{ route('shop.product.cat', ['slug' => str_slug($subCat1->name), 'id' => $subCat1->id]) }}">{{ $subCat1->name }}</a></li>
                                        @endwhile
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in">
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
                                                <strong><span @if($product->promotion_price != 0) style="font-weight: normal; text-decoration: line-through" @endif>{{ number_format($product->price) }}</span></strong>
                                                @if($product->promotion_price != 0)<strong> {{ number_format($product->price - ($product->price * $product->promotion_price)/100) }}</strong> @endif
                                                <strong>VND</strong>
                                            </h5>
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
                                                <i id="pro_fav_{{ $product->id }}" @if(in_array($product->id, $arFavorite))style="color: red"@endif class="fa fa-heart"></i> Yêu thích
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div><!--/category-tab-->
        @endforeach
        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Có thể bạn thích</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach($objNewProduct as $product)
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <a href="{{ route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id]) }}"
                                           class="productinfo text-center">
                                            <img src="{{ Storage::url('app/files/') }}{{ $product->picture }}" alt="">
                                            <h2>{{ number_format($product->price) }} <small>VND</small></h2>
                                            <p>{{ $product->name }}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div><!--/recommended_items-->

    </div>
@endsection