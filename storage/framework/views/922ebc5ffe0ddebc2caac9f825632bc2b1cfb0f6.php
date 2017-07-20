<?php $__env->startSection('title'); ?>
    <?php echo e($product->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product iitem">
                    <img src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($product->picture); ?>" alt="">
                    <button id="detail-add-to-card" class="hidden add-to-cart"></button>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <?php if($product->new == 'new'): ?>
                        <img src="<?php echo e($publicUrl); ?>images/home/new.png" class="new" alt=""/>
                    <?php elseif($product->promotion_price != null): ?>
                        <img src="<?php echo e($publicUrl); ?>images/home/sale.png" class="new" alt=""/>
                    <?php endif; ?>
                    <h2><?php echo e($product->name); ?></h2>
                    <span>
                        <div class="pull-left">
                            <span><?php echo e(number_format($product->price - ($product->price * $product->promotion_price)/100)); ?></span>
                            <?php if($product->promotion_price != 0): ?> <p style="display: inline; text-decoration: line-through;"><?php echo e(number_format($product->price)); ?></p> <?php endif; ?>
                            <strong>VND</strong>
                        </div>
                        
                        <div class="pull-right">
                            <label>Số lượng:</label>
                            <input id="qty_detail" type="text" onkeypress='return event.charCode >= 49 && event.charCode <= 57' value="<?php if(session('cart.items.'.$product->id)): ?><?php echo e(session('cart.items.'.$product->id.'.qty')); ?><?php else: ?><?php echo e(1); ?><?php endif; ?>">
                            <button onclick="addToCartWithQty(<?php echo e($product->id); ?>)" type="button" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Thêm giỏ hàng
                            </button>
                        </div>
                    </span>
                    <p><b>Shop đăng bán:</b> <a href="<?php echo e(route('subshop.index', ['slug' => str_slug($product->shop_name), 'id' => $product->shop_id])); ?>"><?php echo e($product->shop_name); ?></a></p>
                    <p><b>Tình trạng:</b> <?php echo e($product->new); ?><?php if(is_numeric($product->new)): ?> % <?php endif; ?></p>
                    <p><b>Thẻ:</b> |
                        <?php $__currentLoopData = $objTag; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('shop.product.tag', ['slug' => str_slug($tag->tag_name), 'id' => $tag->id])); ?>"><?php echo e($tag->tag_name); ?></a> |
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                    <a href="javascript:void(0)"><img src="<?php echo e($publicUrl); ?>images/product-details/share.png" class="share img-responsive"
                                    alt=""></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->

        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
                    <li class=""><a href="#reviews" data-toggle="tab">Bình luận</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade in card-box active" id="details">
                    <?php echo $product->description; ?>

                </div>

                <div class="tab-pane fade in" id="reviews">
                    <div class="col-md-12">
                        <ul id="list_cmt">
                            <?php $__currentLoopData = $objCmt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="col-md-12">
                                <ul>
                                    <li><a href="javascript:void(0)"><i class="fa fa-user"></i><?php echo e($cmt->name_cmt); ?></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-clock-o"></i><?php echo e($cmt->created_at); ?></a></li>
                                </ul>
                                <p><?php echo e($cmt->content); ?></p>
                                <br />
                                <hr />
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <p><b>Viết bình luận của bạn</b></p>
                        <form id="cmtBox" action="javascript:void(0)">
                            <span>
                                <input type="hidden" id="shop_id"  value="<?php echo e($product->shop_id); ?>" >
                                <input type="hidden" id="product_id"  value="<?php echo e($product->id); ?>" >
                                <input type="hidden" id="user_id"  value="<?php if(Auth::check()): ?><?php echo e(Auth::user()->id); ?><?php endif; ?>" >
                                <input type="text" required id="name" value="<?php if(Auth::check()): ?><?php echo e(Auth::user()->fullname); ?><?php endif; ?>"  name="name" placeholder="Nhập tên của bạn...">
                                <input type="email" required id="email" value="<?php if(Auth::check()): ?><?php echo e(Auth::user()->email); ?><?php endif; ?>"  placeholder="Nhập địa chỉ email...">
                            </span>
                            <textarea name="content" required id="content" placeholder="Nhập bình luận..."></textarea>
                            <button type="submit" onclick="comment()" class="btn btn-default pull-right">
                                Bình luận
                            </button>
                        </form>
                    </div>
                    <hr />

                </div>

            </div>
        </div><!--/category-tab-->

        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Có thể bạn thích</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <?php $__currentLoopData = $relativeProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <hr />
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
<?php $__env->startSection('js'); ?>
    <script>
        function comment() {
            var name = ($('#name').val());
            var product_id = ($('#product_id').val());
            var shop_id = ($('#shop_id').val());
            var email = ($('#email').val());
            var content = ($('#content').val());
            var user_id = ($('#user_id').val());
            if (name != '' && email != '' && content != '')
            {
                data = {
                    name_cmt: name,
                    product_id: product_id,
                    shop_id: shop_id,
                    email: email,
                    content: content,
                    user_id: user_id
                };
                commentPublic('binh-luan-bai-viet', data,
                    function (data) {
                        $('#content').val('');
                        $('#list_cmt').empty();
                        $('#list_cmt').append(data);
                    },
                    function (error) {
                        alert('Có lỗi');
                    }
                );
            }
        }

        function addToCartWithQty(id) {
            $('#detail-add-to-card').click();
            var qty = $('#qty_detail').val();
            if (qty >= 1) {
                addToCartQty('add_cart_qty', id, qty,
                    function (data) {
                        $('.qty').html('' + data.total);
                    },
                    function (error) {
                        console.log(error);
                    }
                );
            }
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>