<?php $__env->startSection('title'); ?>
    Trang chủ E-shopper | Mua bán trở nên thật dễ dàng
<?php $__env->stopSection(); ?>
<?php $__env->startSection('slider'); ?>
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php $__currentLoopData = $objPinProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li data-target="#slider-carousel" data-slide-to="<?php echo e($key); ?>" <?php if($key==0): ?>class="active"<?php endif; ?>></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>

                        <div class="carousel-inner">
                            <?php $__currentLoopData = $objPinProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item <?php if($key == 0): ?> active <?php endif; ?>">
                                    <div class="col-sm-6">
                                        <h1><?php echo e($product->shop_name); ?></h1>
                                        <h2><?php echo e(str_limit($product->name, 30)); ?></h2>
                                        <p>
                                            <strong>Giá: </strong>
                                            <span <?php if($product->promotion_price != 0): ?> style="text-decoration: line-through" <?php endif; ?>><?php echo e(number_format($product->price)); ?></span>
                                            <?php if($product->promotion_price != 0): ?> <?php echo e(number_format(($product->price * $product->promotion_price)/100)); ?> <?php endif; ?>
                                            <strong>VND</strong>
                                        </p>
                                        <a href="<?php echo e(route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id])); ?>"
                                           type="button" class="btn btn-default get">Mua ngay</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($product->picture); ?>"
                                             class="girl img-responsive" alt=""/>
                                        <img src="<?php echo e($publicUrl); ?>images/home/pricing.png" class="pricing" alt=""/>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Sản phẩm bán chạy nhất</h2>
            <?php $__currentLoopData = $objHotProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center fader iitem">
                                <div class="fix-with" style="height: 237px;">
                                    <a href="<?php echo e(route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id])); ?>">
                                        <img src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($product->picture); ?>" alt=""/>
                                    </a>
                                </div>
                                <br/><br/><br/>
                                <h4>
                                    <span <?php if($product->promotion_price != 0): ?> style="font-size: 14px; text-decoration: line-through" <?php endif; ?>><?php echo e(number_format($product->price)); ?></span>
                                    <?php if($product->promotion_price != 0): ?> <?php echo e(number_format($product->price - ($product->price * $product->promotion_price)/100)); ?> <?php endif; ?>
                                    <strong>VND</strong></h4>
                                <p>
                                    <a href="<?php echo e(route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id])); ?>">
                                        <?php echo e(str_limit($product->name, 30)); ?>

                                    </a>
                                </p>
                                <a href="javascript:void(0)" onclick="addCart(<?php echo e($product->id); ?>)"
                                   class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                            </div>
                            <?php if($product->new == 'new'): ?>
                                <img src="<?php echo e($publicUrl); ?>images/home/new.png" class="new" alt=""/>
                            <?php endif; ?>
                            <?php if($product->promotion_price != null): ?>
                                <img src="<?php echo e($publicUrl); ?>images/home/sale.png" class="sale" alt=""/>
                            <?php endif; ?>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li>
                                    <a href="<?php echo e(route('subshop.index', ['slug' => str_slug($product->shop_name), 'id' => $product->shop_id])); ?>">
                                        <i style="color: green" class="fa fa-home"></i> <?php echo e($product->shop_name); ?>

                                    </a>
                                <li>
                                    <a href="javascript:void(0)" onclick="favoriteHotProduct(<?php echo e($product->id); ?>)">
                                        <i id="hotpro_fav_<?php echo e($product->id); ?>" <?php if(in_array($product->id, $arFavorite)): ?>style="color: red"<?php endif; ?> class="fa fa-heart"></i>Yêu thích
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div><!--features_items-->
        <?php $__currentLoopData = $arProductInRemainCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $objProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $tmp = explode('|', $key);
            $idParrentCat = array_first($tmp);
            $nameParrentCat = end($tmp);
            ?>
            <div class="category-tab"><!--category-tab-->
                <h2 class="title text-center">
                    <a style="color: #FE980F"
                       href="<?php echo e(route('shop.product.cat', ['slug' => str_slug($nameParrentCat), 'id' => $idParrentCat])); ?>">
                        <?php echo e($nameParrentCat); ?>

                    </a>
                </h2>
                <div class="col-sm-12">
                    <?php if(isset($objSubCat1[$idParrentCat])): ?>
                        <ul class="nav nav-tabs">
                            <?php for($i = 0; $i <= 3; $i++): ?>
                                <?php if(!isset($objSubCat1[$idParrentCat][$i])): ?>
                                    <?php break; ?>
                                <?php endif; ?>
                                <?php $subCat1 = $objSubCat1[$idParrentCat][$i]; ?>
                                <li><a href="<?php echo e(route('shop.product.cat', ['slug' => str_slug($subCat1->name), 'id' => $subCat1->id])); ?>"><?php echo e($subCat1->name); ?></a></li>
                            <?php endfor; ?>
                            <?php if(isset($objSubCat1[$idParrentCat][$i])): ?>
                                <li class="pull-right">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Khác
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <?php while(true): ?>
                                            <?php if(!isset($objSubCat1[$idParrentCat][$i])): ?>
                                                <?php break; ?>
                                            <?php endif; ?>
                                            <?php $subCat1 = $objSubCat1[$idParrentCat][$i]; $i++; ?>
                                            <li><a href="<?php echo e(route('shop.product.cat', ['slug' => str_slug($subCat1->name), 'id' => $subCat1->id])); ?>"><?php echo e($subCat1->name); ?></a></li>
                                        <?php endwhile; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in">
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
                    </div>
                </div>
            </div><!--/category-tab-->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Có thể bạn thích</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <?php $__currentLoopData = $objNewProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <a href="<?php echo e(route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id])); ?>"
                                           class="productinfo text-center">
                                            <img src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($product->picture); ?>" alt="">
                                            <h2><?php echo e(number_format($product->price)); ?> <small>VND</small></h2>
                                            <p><?php echo e($product->name); ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div><!--/recommended_items-->

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>