@extends('templates.shop.master')

@section('content')
    {{--{{ dd(Session::all()) }}--}}
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('shop.index.index') }}">Trang chủ</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="shopper-informations">

            <div>
                <a href="{{ route('shop.bill.confirm_info') }}"> Xác nhận thông tin <i class="fa fa-chevron-right"></i></a>
                <a href="{{ route('shop.bill.get_payment') }}"> Chọn hình thức thanh toán <i class="fa fa-chevron-right"></i></a>
                <a href="javascript:void(0)"> Đặt hàng</a>
            </div>

            <div id="list_shop">
                @foreach($objShop as $shop)
                <div id="shop_{{ $shop->id }}">
                    <div class="review-payment">
                        <h2>{{ $shop->name }}</h2>
                    </div>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed table-responsive">
                            <thead>
                            <tr class="cart_menu">
                                <td class="image">Sản phẩm</td>
                                <td class="description"></td>
                                <td class="price">Giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Tổng</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!session('cart'))
                                <tr>
                                    <td colspan="6"> Không có sản phẩm nào </td>
                                </tr>
                            @else
                                <?php
                                $objProduct = session('cart')->items;
                                $total = 0;
                                $sumQty = 0;
                                ?>
                                @foreach($objProduct as $product)
                                    @if($product['item']->shop_id == $shop->id)
                                    <tr>
                                        <td class="cart_product">
                                            <a href="javascript:void(0)"><img style="width: 100px;" src="{{ Storage::url('app/files/') }}{{ $product['item']->picture }}" alt=""></a>
                                        </td>
                                        <td class="cart_description">
                                            <h5><a href="{{ route('shop.product.detail', ['slug' => str_slug($product['item']->name), 'id' => $product['item']->id]) }}">{{ $product['item']->name }}</a></h5>
                                        </td>
                                        <td class="cart_price">
                                            <?php  $price = $product['item']->price - ($product['item']->price*$product['item']->promotion_price)/100; ?>
                                            <p>{{ number_format($price) }} đ</p>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">{{ $product['qty'] }}</p>
                                        </td>
                                        <td class="cart_total">
                                            <?php $sum = $product['qty'] * $price ?>
                                            <p class="cart_total_price">{{ number_format($sum) }}</p>
                                            <?php
                                                $total += $sum;
                                                $sumQty += $product['qty'];
                                            ?>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                <input type="hidden" value="{{ $sumQty }}" id="qty_pro_{{ $shop->id }}">
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="2">
                                        <table class="table table-condensed total-result">
                                            <tbody><tr>
                                                <td><strong> Tổng thanh toán: </strong></td>
                                                <td>{{ number_format($total) }} đ</td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <a href="javascript:void(0)" type="button" onclick="getItem({{ $shop->id }})" class="btn btn-success btn-lg pull-right"> Đặt hàng </a>
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
    <div id="detail-bill-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function getItem(id) {
            var removeQty = parseInt($('#qty_pro_'+id).val());
            var totalQty = parseInt($('.qty').text());
            $('.qty').text(totalQty - removeQty);
            showItemPublic('mua-hang/order', id,
                function (data) {
                    $('#detail-bill-modal').html(data);
                    $('#detail-bill-modal').modal('toggle');
                    $('#shop_'+id).remove();
                },
                function (error) {
                    alert('Có lỗi khi cập nhật');
                }
            );
        }
    </script>
@endsection