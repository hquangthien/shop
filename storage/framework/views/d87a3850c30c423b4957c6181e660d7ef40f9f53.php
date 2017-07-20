<?php $__env->startSection('title'); ?>
    <?php echo e(Auth::user()->fullname); ?> | Sản phẩm yêu thích
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-8">
        <div id="contact-page" class="container">
            <div class="bg">
                <div class="row">
                    <div class="col-sm-9">
                        <?php if(sizeof($objProduct) == 0): ?>
                            <p class="alert alert-warning text-center"> Chưa có sản phẩm yêu thích </p>
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
                                                        <i id="pro_fav_<?php echo e($product->id); ?>" <?php if(in_array($product->id, $arFavorite)): ?>style="color: red"<?php endif; ?> class="fa fa-heart"></i> Yêu thích
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
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.shop.master2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>