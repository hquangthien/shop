<?php $__env->startSection('title'); ?>
    Xác nhận thông tin
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
                <a href="javascript:void(0)">Xác nhận thông tin <i class="fa fa-chevron-right"></i></a>
                Chọn hình thức thanh toán
                <i class="fa fa-chevron-right"></i>
                Đặt hàng
            </div>
            <br />
            <?php if(!Auth::check()): ?>
            <div class="register-req">
                <p>Đăng ký trước khi mua hàng để dễ dàng hơn trong việc quản lý lịch sử mua hàng của bạn?
                    <a href="<?php echo e(route('register')); ?>">Đăng ký</a>
                </p>
            </div><!--/register-req-->
            <?php endif; ?>

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="shopper-info">
                            <?php  $objInfo = null; ?>
                            <?php if(session('info')): ?>
                                <?php
                                    $objInfo = session('info');
                                ?>
                            <?php elseif(Auth::check()): ?>
                                <?php
                                    $objInfo = Auth::user();
                                    $objInfo['name'] = Auth::user()->fullname;
                                ?>
                            <?php endif; ?>
                            <p>Thông tin khách hàng</p>
                            <?php if(count($errors) > 0): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <form action="<?php echo e(route('shop.bill.payment')); ?>" method="POST">

                                <?php echo e(csrf_field()); ?>

                                <?php if(!$objInfo == null): ?>
                                    <input type="text" name="name" placeholder="Tên khách hàng..."
                                        value="<?php echo e($objInfo['name']); ?>"
                                    >
                                    <input type="text" value="<?php echo e($objInfo['phone']); ?>" name="phone" placeholder="Số điện thoại">
                                    <input type="text" value="<?php echo e($objInfo['address']); ?>" name="address" placeholder="Địa chỉ..">
                                    <input type="email" value="<?php echo e($objInfo['email']); ?>" name="email" placeholder="Email...">
                                <?php else: ?>
                                    <input type="text" name="name" placeholder="Tên khách hàng...">
                                    <input type="text" name="phone" placeholder="Số điện thoại">
                                    <input type="text" name="address" placeholder="Địa chỉ..">
                                    <input type="email" name="email" placeholder="Email...">
                                <?php endif; ?>
                                    <textarea name="note" cols="30" placeholder="Ghi chú..." rows="10"><?php if(session('info')): ?><?php echo e(session('info')['note']); ?><?php endif; ?></textarea>
                                <button class="btn btn-primary" type="submit">Tiếp tục</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>