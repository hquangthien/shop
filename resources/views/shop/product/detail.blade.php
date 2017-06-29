@extends('templates.shop.master2')

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product iitem">
                    <img src="{{ Storage::url('app/files/') }}{{ $product->picture }}" alt="">
                    <button id="detail-add-to-card" class="hidden add-to-cart"></button>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    @if($product->new == 'new')
                        <img src="{{ $publicUrl }}images/home/new.png" class="new" alt=""/>
                    @elseif($product->promotion_price != null)
                        <img src="{{ $publicUrl }}images/home/sale.png" class="new" alt=""/>
                    @endif
                    <h2>{{ $product->name }}</h2>
                    <span>
                        <div class="pull-left">
                            <span>{{ number_format($product->price - ($product->price * $product->promotion_price)/100) }}</span>
                            @if($product->promotion_price != 0) <p style="display: inline; text-decoration: line-through;">{{ number_format($product->price) }}</p> @endif
                            <strong>VND</strong>
                        </div>
                        {{--{{ dd(session('cart.items.3.qty')) }}--}}
                        <div class="pull-right">
                            <label>Số lượng:</label>
                            <input id="qty_detail" type="text" onkeypress='return event.charCode >= 49 && event.charCode <= 57' value="@if(session('cart.items.'.$product->id)){{ session('cart.items.'.$product->id.'.qty') }}@else{{ 1 }}@endif">
                            <button onclick="addToCartWithQty({{ $product->id }})" type="button" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Thêm giỏ hàng
                            </button>
                        </div>
                    </span>
                    <p><b>Shop đăng bán:</b> <a href="{{ route('subshop.index', ['slug' => str_slug($product->shop_name), 'id' => $product->shop_id]) }}">{{ $product->shop_name }}</a></p>
                    <p><b>Tình trạng:</b> {{ $product->new }}@if(is_numeric($product->new)) % @endif</p>
                    <p><b>Thẻ:</b> |
                        @foreach($objTag as $tag)
                            <a href="{{ route('shop.product.tag', ['slug' => str_slug($tag->tag_name), 'id' => $tag->id]) }}">{{ $tag->tag_name }}</a> |
                        @endforeach
                    </p>
                    <a href="javascript:void(0)"><img src="{{ $publicUrl }}images/product-details/share.png" class="share img-responsive"
                                    alt=""></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->

        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
                    <li class=""><a href="#reviews" data-toggle="tab">Bình luận</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade in card-box active" id="details">
                    {!! $product->description !!}
                </div>

                <div class="tab-pane fade in" id="reviews">
                    <div class="col-md-12">
                        <ul id="list_cmt">
                            @foreach($objCmt as $cmt)
                            <li>
                                <div class="col-md-12">
                                <ul>
                                    <li><a href="javascript:void(0)"><i class="fa fa-user"></i>{{ $cmt->name_cmt }}</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-clock-o"></i>{{ $cmt->created_at }}</a></li>
                                </ul>
                                <p>{{ $cmt->content }}</p>
                                <br />
                                <hr />
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <p><b>Viết bình luận của bạn</b></p>
                        <form id="cmtBox" action="javascript:void(0)">
                            <span>
                                <input type="hidden" id="shop_id"  value="{{ $product->shop_id }}" >
                                <input type="hidden" id="product_id"  value="{{ $product->id }}" >
                                <input type="hidden" id="user_id"  value="@if(Auth::check()){{Auth::user()->id}}@endif" >
                                <input type="text" required id="name" value="@if(Auth::check()){{Auth::user()->fullname}}@endif"  name="name" placeholder="Nhập tên của bạn...">
                                <input type="email" required id="email" value="@if(Auth::check()){{Auth::user()->email}}@endif"  placeholder="Nhập địa chỉ email...">
                            </span>
                            <textarea name="content" required id="content" placeholder="Nhập bình luận..."></textarea>
                            <button type="submit" onclick="comment()" class="btn btn-default pull-right">
                                Bình luận
                            </button>
                        </form>
                    </div>
                    <hr />

                </div>

            </div>
        </div><!--/category-tab-->

        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Có thể bạn thích</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach($relativeProduct as $product)
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
                        <hr />
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
@section('js')
    <script>
        function comment() {
            var name = ($('#name').val());
            var product_id = ($('#product_id').val());
            var shop_id = ($('#shop_id').val());
            var email = ($('#email').val());
            var content = ($('#content').val());
            var user_id = ($('#user_id').val());
            if (name != '' && email != '' && content != '')
            {
                data = {
                    name_cmt: name,
                    product_id: product_id,
                    shop_id: shop_id,
                    email: email,
                    content: content,
                    user_id: user_id
                };
                commentPublic('binh-luan-bai-viet', data,
                    function (data) {
                        $('#content').val('');
                        $('#list_cmt').empty();
                        $('#list_cmt').append(data);
                    },
                    function (error) {
                        alert('Có lỗi');
                    }
                );
            }
        }

        function addToCartWithQty(id) {
            $('#detail-add-to-card').click();
            var qty = $('#qty_detail').val();
            if (qty >= 1) {
                addToCartQty('add_cart_qty', id, qty,
                    function (data) {
                        $('.qty').html('' + data.total);
                    },
                    function (error) {
                        console.log(error);
                    }
                );
            }
        }

    </script>
@endsection