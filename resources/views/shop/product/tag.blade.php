@extends('templates.shop.master2')
@section('title')
    Các sản phẩm có từ khóa "{{ $objTag->content }}"
@endsection
@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->

            <h2 class="title text-center">Các sản phẩm thuộc {{ $objTag->content }}</h2>
            <div id="list-product">
                @if(sizeof($objProduct) == 0)
                    <p class="alert alert-warning text-center"> Chưa có sản phẩm nào thuộc thẻ tag này
                        bán </p>
                @else
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
                                        <a style="color: #b3afa8; font-size: 13px;"
                                           href="{{ route('subshop.index', ['slug' => str_slug($product->shop_name), 'id' => $product->shop_id]) }}">
                                            <i style="color: green" class="fa fa-home"></i> {{ $product->shop_name }}
                                        </a>
                                    </div>
                                    <div class="col-xs-6 pull-right">
                                        <a style="color: #b3afa8; font-size: 13px;"
                                           onclick="changeActive({{ $product->id }})" href="javascript:void(0)">
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