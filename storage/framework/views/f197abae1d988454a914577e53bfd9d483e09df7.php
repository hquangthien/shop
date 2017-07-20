<?php $__env->startSection('title'); ?>
    <?php echo e($objShop->name); ?> | <?php echo e($objCurrentCat->name); ?>

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
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->

            <h2 class="title text-center"><?php echo e($objCurrentCat->name); ?></h2>
            <hr/>
            <?php if(sizeof($objProduct) == 0): ?>
                <p class="alert alert-warning text-center"> Chưa có sản phẩm nào thuộc danh mục này được đăng bán </p>
            <?php else: ?>
                <div id="list-product">
                    <?php $__currentLoopData = $objProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center fader iitem">
                                        <div class="fix-with" style="height: 191px;">
                                            <a href="<?php echo e(route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id])); ?>">
                                                <img src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($product->picture); ?>"
                                                     alt=""/>
                                            </a>
                                        </div>
                                        <br/>
                                        <h5>
                                            <span <?php if($product->promotion_price != 0): ?> style="text-decoration: line-through" <?php endif; ?>><?php echo e(number_format($product->price)); ?></span>
                                            <?php if($product->promotion_price != 0): ?> <?php echo e(number_format($product->price - ($product->price * $product->promotion_price)/100)); ?> <?php endif; ?>
                                            <strong>VND</strong></h5>
                                        <a href="<?php echo e(route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id])); ?>">
                                            <p><?php echo e(str_limit($product->name, 20)); ?></p>
                                        </a>
                                        <a href="javascript:void(0)" onclick="addCart(<?php echo e($product->id); ?>)"
                                           class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                            giỏ hàng</a>
                                    </div>
                                    <?php if($product->new == 'new'): ?>
                                        <img src="<?php echo e($publicUrl); ?>images/home/new.png" class="new" alt=""/>
                                    <?php endif; ?>
                                    <?php if($product->promotion_price != null): ?>
                                        <img src="<?php echo e($publicUrl); ?>images/home/sale.png" class="sale" alt=""/>
                                    <?php endif; ?>
                                </div>
                                <div class="choose row">
                                    <div class="col-xs-6 pull-left">
                                        <a style="color: #b3afa8; font-size: 13px;" href="<?php echo e(route('subshop.index', ['slug' => str_slug($product->shop_name), 'id' => $product->shop_id])); ?>">
                                            <i style="color: green" class="fa fa-home"></i> <?php echo e($product->shop_name); ?>

                                        </a>
                                    </div>
                                    <div class="col-xs-6 pull-right">
                                        <a style="color: #b3afa8; font-size: 13px;" onclick="changeActive(<?php echo e($product->id); ?>)" href="javascript:void(0)">
                                            <i id="pro_fav_<?php echo e($product->id); ?>"
                                               <?php if(in_array($product->id, $arFavorite)): ?>style="color: red"
                                               <?php endif; ?> class="fa fa-heart"></i> Yêu thích
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            <div style="clear: both"></div>
            <div class="row text-center">
                <?php echo e($objProduct->links()); ?>

            </div>
        </div><!--features_items-->
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master3', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>