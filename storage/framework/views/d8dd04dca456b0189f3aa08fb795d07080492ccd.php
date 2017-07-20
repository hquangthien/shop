<?php $__env->startSection('title'); ?>
    Chọn hình thức giao hàng
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(route('shop.index.index')); ?>">Trang chủ</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            <div>
                <a href="<?php echo e(route('shop.bill.confirm_info')); ?>">Xác nhận thông tin <i class="fa fa-chevron-right"></i></a>
                <a href="javascript:void(0)">Chọn hình thức thanh toán <i class="fa fa-chevron-right"></i></a>
                Đặt hàng
            </div>
            <br />

            <div class="row">
                <div class="col-xs-12">
                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if(session('payment')): ?>
                        <?php
                            $paymentCurrent = session('payment');
                        ?>
                    <?php else: ?>
                        <?php
                            $paymentCurrent = null;
                        ?>
                    <?php endif; ?>
                    <form action="<?php echo e(route('shop.bill.post_checkout')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                    <?php $__currentLoopData = $objPayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input class="" value="<?php echo e($payment->id); ?>" <?php if($paymentCurrent == $payment->id): ?> checked <?php endif; ?> name="payment" type="radio"> <?php echo e($payment->name); ?> <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <input type="submit" class="btn btn-primary" value="Tiếp tục">
                    </form>
                </div>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>