<div class="row card-box">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <address>
            <strong><?php echo e($objShop->name); ?></strong>
            <br>
            <?php echo e($objShop->address); ?>

            <br />
            <abbr title="Phone">Điện thoại:</abbr> <?php echo e($objShop->phone); ?>

        </address>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
        <p>
            <em>Ngày mua: <?php echo e($objShop->created_at); ?></em>
        </p>
        <p>
            <em>Mã hóa đơn: #<?php echo e($objBill->id); ?></em>
        </p>
    </div>
</div>

<div class="row">
    <div class="text-center">
        <h1>Hóa đơn</h1>
    </div>

    <div class="text-left" style="padding-left:20px">
        Tên khách hàng: <?php echo e($objBill->name); ?><br>
        Address: <?php echo e($objBill->address); ?><br>
        Phone: <?php echo e($objBill->phone); ?><br>
        Email: <?php echo e($objBill->email); ?><br>
        Ghi chú: <?php echo e($objBill->note); ?><br>
        Hình thức thanh toán:
        <?php if($objBill->payment == 2): ?>
            <img src="https://www.baokim.vn/cdn/x_developer/module/baokim_btn/thanhtoan-m.png">
        <?php elseif($objBill->payment == 3): ?>
            <img src="https://www.nganluong.vn/css/newhome/img/button/pay-sm.png"border="0" />
        <?php elseif($objBill->payment == 1): ?>
            <img width="150px" src="https://zencommerce.in/wp-content/themes/zencommercein/img/en/cod.png" alt="">
        <?php endif; ?>
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
        <?php $__currentLoopData = $objDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <em><?php echo e($item->product_name); ?></em>
                        </div>
                        <div class="col-md-6">
                            <img width="150px" src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($item->product_picture); ?>" alt="">
                        </div>
                    </div>

                </td>
                <td class="col-md-1 text-center"><?php echo e($item->quantity); ?></td>
                <td class="col-md-2" style="text-align: center"> <?php echo e(number_format($item->price)); ?></td>
                <td class="col-md-2 text-center"><?php echo e(number_format($item->price * $item->quantity)); ?></td>
            </tr>
            <?php $total = $total + $item->price * $item->quantity?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td> &nbsp; </td>
            <td> &nbsp; </td>
            <td class="text-right"><h4><strong>Tổng thanh toán:</strong></h4></td>
            <td class="text-center text-danger" colspan="3"><h4><strong>&nbsp;<?php echo e(number_format($total)); ?></strong></h4></td>
        </tr>
        </tbody>
    </table>
</div>