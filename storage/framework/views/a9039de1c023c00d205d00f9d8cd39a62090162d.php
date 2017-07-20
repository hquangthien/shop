<?php $__env->startSection('title'); ?>
    <?php echo e($objShop->name); ?> | Liên hệ
<?php $__env->stopSection(); ?>
<?php $__env->startSection('nvarbar'); ?>
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a href="<?php echo e(route('subshop.index', ['slug' => str_slug($objShop->name), 'id' => $objShop->id])); ?>">Trang chủ shop <?php echo e($objShop->name); ?></a></li>
            <li><a href="<?php echo e(route('subshop.feedback', ['slug' => str_slug($objShop->name), 'id' => $objShop->id])); ?>">Đánh giá - Phản hồi</a></li>
            <li><a href="<?php echo e(route('subshop.contact', ['slug' => str_slug($objShop->name), 'id' => $objShop->id])); ?>">Liên hệ shop <?php echo e($objShop->name); ?></a></li>
        </ul>
    </div>
    <br /><br /><br /><br />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left_bar'); ?>
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Danh mục</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                <?php $__currentLoopData = $objSuperCatOfShop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $superCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="<?php echo e(route('subshop.cat', ['slug' => str_slug($objShop->name), 'id' => $objShop->id, 'cat_name' => str_slug($superCat->name), 'cat_id' => $superCat->id])); ?>">
                                    <?php echo e($superCat->name); ?>

                                </a>
                                <?php if(isset($objSubCatOfShop[$superCat->id])): ?>
                                    <a data-toggle="collapse" href="#<?php echo e(str_slug($superCat->name)); ?>">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    </a>
                                <?php endif; ?>

                            </h4>
                        </div>
                        <?php if(isset($objSubCatOfShop[$superCat->id])): ?>
                            <div id="<?php echo e(str_slug($superCat->name)); ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <?php $__currentLoopData = $objSubCatOfShop[$superCat->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(route('subshop.cat', ['slug' => str_slug($objShop->name), 'id' => $objShop->id, 'cat_name' => str_slug($subCat1->name), 'cat_id' => $subCat1->id])); ?>">
                                                    <?php echo e($subCat1->name); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div><!--/category-products-->

            <div class="shipping text-center"><!--shipping-->
                <img src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($objRightAdv[0]->image); ?>" alt="">
            </div><!--/shipping-->

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-9">
        <div class="row text-center">
            <div class="col-sm-12">
                <div class="contact-info">
                    <h2 class="title text-center">Thông tin về chúng tôi</h2>
                    <address>
                        <p><?php echo e($objShop->name); ?></p>
                        <p><?php echo e($objShop->address); ?></p>
                        <p>Mobile: <?php echo e($objShop->phone); ?></p>
                        <p>Email: <?php echo e($objShop->email); ?></p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Mạng xã hội</h2>
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/hquangthien.dtu"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 padding-right">
                <div class="features_items"><!--features_items-->
                    <div class="contact-form">
                        <h2 class="title text-center">Nhập thông tin liên hệ</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form row" action="<?php echo e(route('subshop.contact', ['slug' => str_slug($objShop->name), 'id' => $objShop->id])); ?>" name="contact-form" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php if($errors->any()): ?>
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
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Họ tên">
                                <input type="hidden" name="shop_id" class="form-control" value="<?php echo e($objShop->id); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" class="form-control" required="required" placeholder="Chủ đề">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="detail" id="message" required="required" class="form-control" rows="8" placeholder="Nội dung"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>
                    </div>

                </div><!--features_items-->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master3', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>