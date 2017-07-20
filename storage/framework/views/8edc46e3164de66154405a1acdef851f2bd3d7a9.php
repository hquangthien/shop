<?php $__env->startComponent('mail::message'); ?>
<?php $__env->startComponent('mail::panel'); ?>
    <?php echo e($title); ?>

<?php echo $__env->renderComponent(); ?>
Chào bạn, <strong><?php echo e($objBill->name); ?></strong>. <br>
Cảm ơn bạn đã tin tưởng và giao dịch tại E-shopper.
Dưới đây là chi tiết đơn hàng bạn vừa đặt. Vui lòng kiểm tra email và điện thoại thường xuyên.
Chúng tôi sẽ chuyển hàng đến trong thời gian sớm nhất


<?php $__env->startComponent('mail::table'); ?>
    | Sản phẩm       | Giá         | Số lượng  | Thành tiền |
    | :-------------: |:-------------:| :--------:|--------:|
    <?php $total = 0 ?>
    <?php $__currentLoopData = $objProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    |<?php echo e($product->product_name); ?>|<?php echo e(number_format($product->price)); ?>|<?php echo e($product->quantity); ?>|<?php echo e(number_format($product->price * $product->quantity)); ?>|
    <?php $total = $total + $product->price * $product->quantity?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    | | | Tổng thanh toán: | <?php echo e(number_format($total)); ?>

<?php echo $__env->renderComponent(); ?>
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
<?php $__env->startComponent('mail::button', ['url' => $url, 'color: green']); ?>
    Thanh toán
<?php echo $__env->renderComponent(); ?>
Thanks,<br>
E-Shopper
<?php echo $__env->renderComponent(); ?>
