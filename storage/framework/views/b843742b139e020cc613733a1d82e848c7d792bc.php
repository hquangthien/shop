<?php $__env->startSection('content'); ?>
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->

            <h2 class="title text-center">Kết quả tìm kiếm cho từ khóa <strong>"<?php echo e($key_search); ?>"</strong></h2>
            <div class="row">
                <div class="col-md-3">
                    <select id="cat_filter"  class="filter form-control">
                        <option value="<?php echo e(null); ?>">-- Chọn danh mục --</option>
                        <option value="<?php echo e(null); ?>">Tất cả danh mục</option>
                        <?php $__currentLoopData = $objSuperCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $superCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($superCat->id); ?>"><?php echo e($superCat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="price_filter" class="filter form-control">
                        <option value="<?php echo e(null); ?>">-- Chọn mức giá --</option>
                        <option value="<?php echo e(null); ?>">Tất cả mức giá</option>
                        <option value="1">Dưới 1 triệu</option>
                        <option value="2">Từ 1 triệu đến 2 triệu</option>
                        <option value="3">Từ 2 triệu đến 3 triệu</option>
                        <option value="4">Từ 3 triệu đến 5 triệu</option>
                        <option value="5">Từ 5 triệu đến 8 triệu</option>
                        <option value="6">Từ 8 triệu đến 12 triệu</option>
                        <option value="7">Trên 12 triệu</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="status_filter" class="filter form-control">
                        <option value="<?php echo e(null); ?>">Tình trạng</option>
                        <option value="1">Mới</option>
                        <option value="2">Cũ</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="form-control">
                        <input type="checkbox" class="filter" id="promotion_filter" data-toggle="toggle"
                               data-on="Giảm giá" data-off="Không"> Giảm giá
                    </div>
                </div>
                <div class="col-md-2">
                    <select id="order_filter" class="filter form-control">
                        <option value="ASC">Tăng dần</option>
                        <option value="DESC">Giảm dần</option>
                    </select>
                </div>
            </div>
            <hr/>
            <?php if(sizeof($objProduct) == 0): ?>
                <p class="alert alert-warning text-center"> Không có kết quả nào phù hợp với từ khóa <?php echo e($key_search); ?> </p>
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
            <?php endif; ?>
            <div style="clear: both"></div>
            <div class="row text-center">
                <?php echo e($objProduct->links()); ?>

            </div>
        </div><!--features_items-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).on('change', '.filter', function () {
            $('#spin').show();
            var cat_filter = $('#cat_filter').find(':selected').val();
            var price_filter = $('#price_filter ').find(':selected').val();
            var status_filter = $('#status_filter').find(':selected').val();
            var order_filter = $('#order_filter').find(':selected').val();
            var promotion_filter;
            if ($('#promotion_filter').is(':checked')) {
                promotion_filter = 1;
            } else {
                promotion_filter = 0;
            }
            data = {
                key_search: '<?php echo e($key_search); ?>',
                cat_filter: cat_filter,
                price_filter: price_filter,
                status_filter: status_filter,
                promotion_filter: promotion_filter,
                order_filter: order_filter
            };
            commentPublic('search_filter', data,
                function (data) {
                    $('#spin').hide();
                    $('#list-product').html(data);
                },
                function (error) {
                    $('#spin').hide();
                    console.log(error);
                }
            );
        });
        function getProduct(key_search, cat_filter, price_filter, status_filter, promotion_filter, page, order_filter) {
            $('#spin').show();
            data = {
                key_search: '<?php echo e($key_search); ?>',
                cat_filter: cat_filter,
                price_filter: price_filter,
                status_filter: status_filter,
                promotion_filter: promotion_filter,
                page: page,
                order_filter: order_filter,
            };
            commentPublic('search_filter', data,
                function (data) {
                    $('#spin').hide();
                    $('.ajax_pagination').remove();
                    $('#list-product').append(data);
                },
                function (error) {
                    $('#spin').hide();
                    console.log(error);
                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>