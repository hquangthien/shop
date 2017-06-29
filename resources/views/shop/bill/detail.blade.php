<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Chi tiết hóa đơn</h4>
        </div>
        <div class="modal-body">
            <div class="row card-box">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>{{ $objShop->name }}</strong>
                        <br>
                        {{ $objShop->address }}
                        <br />
                        <abbr title="Phone">Điện thoại:</abbr> {{ $objShop->phone }}
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Ngày mua: {{ $objShop->created_at }}</em>
                    </p>
                    <p>
                        <em>Mã hóa đơn: #{{ $objBill->id }}</em>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="text-center">
                    <h1>Hóa đơn</h1>
                    <h5> (Đơn hàng đã được gửi đi) </h5>
                </div>

                <div class="text-left" style="padding-left:20px">
                    Tên khách hàng: {{ $objBill->name }}<br>
                    Address: {{ $objBill->address }}<br>
                    Phone: {{ $objBill->phone }}<br>
                    Email: {{ $objBill->email }}<br>
                    Ghi chú: {{ $objBill->note }}<br>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th class="text-center">Giá</th>
                        <th class="col-md-2 text-center">Tổng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0 ?>
                    @foreach($objDetail as $item)
                        <tr>
                            <td class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <em>{{ $item->product_name }}</em>
                                    </div>
                                    <div class="col-md-6">
                                        <img width="150px" src="{{ Storage::url('app/files/') }}{{ $item->product_picture }}" alt="">
                                    </div>
                                </div>

                            </td>
                            <td class="col-md-1 text-center">{{ $item->quantity }}</td>
                            <td class="col-md-2" style="text-align: center"> {{ number_format($item->price) }}</td>
                            <td class="col-md-2 text-center">{{ number_format($item->price * $item->quantity) }}</td>
                        </tr>
                        <?php $total = $total + $item->price * $item->quantity?>
                    @endforeach
                    <tr>
                        <td> &nbsp; </td>
                        <td colspan="2" class="text-right"><h4><strong>Tổng thanh toán:</strong></h4></td>
                        <td class="text-center text-danger" colspan="3"><h4><strong>&nbsp;{{ number_format($total) }}</strong></h4></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            Cảm ơn bạn đã đặt hàng tại trang web của chúng tôi. Đơn hàng của bạn đã được gửi đi, vui lòng kiểm tra email để biết thông tin chi tiết. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-md-6 pull-left">
                    <?php
                        $product_name = '';
                        $id = $objBill->id;
                        $business = 'hquangthien@gmail.com';
                        foreach ($objDetail as $item){
                            $product_name .= $item->product_name.' -';
                        }
                        $product_price = $total;
                        $product_quantity = 1;
                        $total_amount = $total;
                        $url_detail = route('blank.page.bill.detail', ['shop_id' => $objShop->id, 'bill_id' => $objBill->id]);
                        $url_success = route('shop.index.index');
                        $url_cancel = route('shop.index.index');
                        $order_description = $objBill->note;

                    ?>
                    @if($objBill->payment == 2)
                        <a target="_blank" href="https://www.baokim.vn/payment/product/version11?business={{ urlencode($business) }}&product_name={{ urlencode($product_name) }}&product_price={{ urlencode($product_price) }}&product_quantity={{ urlencode($product_quantity) }}&total_amount={{ urlencode($total_amount) }}&url_detail={{ urlencode($url_detail) }}&url_success={{ urlencode($url_success) }}&url_cancel={{ urlencode($url_cancel) }}&order_description={{ urlencode($order_description) }}">
                            <img src="https://www.baokim.vn/cdn/x_developer/module/baokim_btn/thanhtoan-m.png">
                        </a>
                    @elseif($objBill->payment == 3)
                        <a target="_blank" href="https://www.nganluong.vn/button_payment.php?receiver={{ urlencode($business) }}&product_name={{ urlencode($product_name) }}&price={{ urlencode($product_price) }}&return_url={{ urlencode($url_detail) }}&comments={{ urlencode($order_description) }}">
                            <img src="https://www.nganluong.vn/css/newhome/img/button/pay-sm.png"border="0" />
                        </a>
                    @elseif($objBill->payment == 1)
                            <img width="150px" src="https://zencommerce.in/wp-content/themes/zencommercein/img/en/cod.png" alt="">
                    @endif
                </div>
                <div class="col-md-6">
                    <a href="javascript:void(0)" onclick="alert('comming soon!')" class="btn btn-info btn-rounded w-lg waves-effect waves-light m-b-20 m-t-30" data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200" data-overlaycolor="#36404a"><i class="fa fa-print"></i>In</a>
                    <a href="javascript:void(0)" class="btn btn-default btn-rounded w-lg waves-effect waves-light m-b-20 m-t-30" data-dismiss="modal" data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200" data-overlaycolor="#36404a">Đóng</a>
                </div>
            </div>
        </div>
    </div>
</div>
