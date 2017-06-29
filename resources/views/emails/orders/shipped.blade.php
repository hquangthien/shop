@component('mail::message')
@component('mail::panel')
    {{ $title }}
@endcomponent
Chào bạn, <strong>{{ $objBill->name }}</strong>. <br>
Cảm ơn bạn đã tin tưởng và giao dịch tại E-shopper.
Dưới đây là chi tiết đơn hàng bạn vừa đặt. Vui lòng kiểm tra email và điện thoại thường xuyên.
Chúng tôi sẽ chuyển hàng đến trong thời gian sớm nhất


@component('mail::table')
    | Sản phẩm       | Giá         | Số lượng  | Thành tiền |
    | :-------------: |:-------------:| :--------:|--------:|
    <?php $total = 0 ?>
    @foreach($objProduct as $product)
    |{{ $product->product_name }}|{{ number_format($product->price) }}|{{ $product->quantity }}|{{ number_format($product->price * $product->quantity) }}|
    <?php $total = $total + $product->price * $product->quantity?>
    @endforeach
    | | | Tổng thanh toán: | {{ number_format($total) }}
@endcomponent
<?php
    $product_name = '';
    $id = $objBill->id;
    $business = 'hquangthien@gmail.com';
    foreach ($objProduct as $item){
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
<?php
    switch ($objBill->payment){
        case 1:
            $url = "javascript:void(0)";
            break;
        case 2:
            $url = 'https://www.baokim.vn/payment/product/version11?business='.urlencode($business).'&product_name='.urlencode($product_name).'&product_price='.urlencode($product_price).'&product_quantity='.urlencode($product_quantity).'&total_amount='.urlencode($total_amount).'&url_detail='.urlencode($url_detail).'&url_success='.urlencode($url_success).'&url_cancel='.urlencode($url_cancel).'&order_description='.urlencode($order_description);
            break;
        case 3:
            $url = 'https://www.nganluong.vn/button_payment.php?receiver='.urlencode($business).'&product_name='.urlencode($product_name).'&price='.urlencode($product_price).'&return_url='.urlencode($url_detail).'&comments='.urlencode($order_description);
            break;
    }
?>
@component('mail::button', ['url' => $url, 'color: green'])
    Thanh toán
@endcomponent
Thanks,<br>
E-Shopper
@endcomponent
