<?php $__env->startSection('title'); ?>
    Trang thông tin shop
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Trang thông tin shop
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Thêm sản phẩm</h4>

                        <div class="row">
                            <div class="col-lg-12">
                                <?php if(count($errors) > 0): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <?php if(session('msg')): ?>
                                    <p class="alert alert-success"><?php echo e(session('msg')); ?></p>
                                <?php endif; ?>
                                <form class="form-horizontal m-t-20" action="<?php echo e(route('ban.info.update')); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" name="name" type="text" value="<?php echo e($objShop->name); ?>" placeholder="Nhập tên shop...">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" name="phone" type="text" value="<?php echo e($objShop->phone); ?>" placeholder="Nhập số điện thoại của shop...">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" name="address" value="<?php echo e($objShop->address); ?>" type="text" placeholder="Nhập địa chỉ của shop...">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" name="website" value="<?php echo e($objShop->website); ?>" type="text" placeholder="Nhập website của shop...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="payment">Chọn hình thức thanh toán</label>
                                        <div class="col-xs-12">
                                            <?php $__currentLoopData = $objPayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input class="" value="<?php echo e($payment->id); ?>" <?php if($payment->shop_id != null): ?> checked <?php endif; ?> name="payment[]" type="checkbox"> <?php echo e($payment->name); ?> <br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>


                                    <div class="form-group text-center m-t-30">
                                        <div class="col-xs-3 col-xs-offset-5">
                                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Cập nhật</button>
                                        </div>
                                    </div>

                                </form>
                            </div><!-- end col -->

                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e($adminUrl); ?>assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo e($adminUrl); ?>assets/css/bootstrap-tagsinput.css">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.ban.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>