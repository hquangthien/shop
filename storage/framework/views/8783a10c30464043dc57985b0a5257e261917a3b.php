<?php if(sizeof($objProduct) == 0): ?>
    <p class="alert alert-warning text-center"> Không tìm thấy sản phẩm nào </p>
<?php else: ?>
    <?php $__currentLoopData = $objProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-3 notice">
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
                            <strong><span <?php if($product->promotion_price != 0): ?> style="font-weight: normal; text-decoration: line-through" <?php endif; ?>><?php echo e(number_format($product->price)); ?></span></strong>
                            <?php if($product->promotion_price != 0): ?><strong> <?php echo e(number_format($product->price - ($product->price * $product->promotion_price)/100)); ?></strong> <?php endif; ?>
                            <strong>VND</strong>
                        </h5>
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
    <?php if($currentPage <= $totalPage): ?>
    <br style="clear: both" />
    <div class="ajax_pagination text-center">
    <p class="btn alert alert-info" style="width: 100%" onclick="getProduct(
        '<?php echo e($filter['current_cat']); ?>',
        '<?php echo e($filter['cat_filter']); ?>',
        '<?php echo e($filter['price_filter']); ?>',
        '<?php echo e($filter['status_filter']); ?>',
        '<?php echo e($filter['promotion_filter']); ?>',
        '<?php echo e($currentPage); ?>',
        '<?php echo e($filter['order_filter']); ?>'
            )">
        Xem thêm</p>
    </div>
    <?php endif; ?>
<?php endif; ?>
