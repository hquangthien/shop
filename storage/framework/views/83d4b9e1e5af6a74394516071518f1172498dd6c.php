<?php $__env->startSection('title'); ?>
    Đặt hàng
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

            <div class="shopper-informations">

            <div>
                <a href="<?php echo e(route('shop.bill.confirm_info')); ?>"> Xác nhận thông tin <i class="fa fa-chevron-right"></i></a>
                <a href="<?php echo e(route('shop.bill.get_payment')); ?>"> Chọn hình thức thanh toán <i class="fa fa-chevron-right"></i></a>
                <a href="javascript:void(0)"> Đặt hàng</a>
            </div>

            <div id="list_shop">
                <?php $__currentLoopData = $objShop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div id="shop_<?php echo e($shop->id); ?>">
                    <div class="review-payment">
                        <h2><?php echo e($shop->name); ?></h2>
                    </div>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed table-responsive">
                            <thead>
                            <tr class="cart_menu">
                                <td class="image">Sản phẩm</td>
                                <td class="description"></td>
                                <td class="price">Giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Tổng</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!session('cart')): ?>
                                <tr>
                                    <td colspan="6"> Không có sản phẩm nào </td>
                                </tr>
                            <?php else: ?>
                                <?php
                                $objProduct = session('cart')->items;
                                $total = 0;
                                $sumQty = 0;
                                ?>
                                <?php $__currentLoopData = $objProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($product['item']->shop_id == $shop->id): ?>
                                    <tr>
                                        <td class="cart_product">
                                            <a href="javascript:void(0)"><img style="width: 100px;" src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($product['item']->picture); ?>" alt=""></a>
                                        </td>
                                        <td class="cart_description">
                                            <h5><a href="<?php echo e(route('shop.product.detail', ['slug' => str_slug($product['item']->name), 'id' => $product['item']->id])); ?>"><?php echo e($product['item']->name); ?></a></h5>
                                        </td>
                                        <td class="cart_price">
                                            <?php  $price = $product['item']->price - ($product['item']->price*$product['item']->promotion_price)/100; ?>
                                            <p><?php echo e(number_format($price)); ?> đ</p>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price"><?php echo e($product['qty']); ?></p>
                                        </td>
                                        <td class="cart_total">
                                            <?php $sum = $product['qty'] * $price ?>
                                            <p class="cart_total_price"><?php echo e(number_format($sum)); ?></p>
                                            <?php
                                                $total += $sum;
                                                $sumQty += $product['qty'];
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" value="<?php echo e($sumQty); ?>" id="qty_pro_<?php echo e($shop->id); ?>">
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="2">
                                        <table class="table table-condensed total-result">
                                            <tbody><tr>
                                                <td><strong> Tổng thanh toán: </strong></td>
                                                <td><?php echo e(number_format($total)); ?> đ</td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <a href="javascript:void(0)" type="button" onclick="getItem(<?php echo e($shop->id); ?>)" class="btn btn-success btn-lg pull-right"> Đặt hàng </a>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        </div>
    </section>
    <div id="detail-bill-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
        function getItem(id) {
            $('#spin').show();
            var removeQty = parseInt($('#qty_pro_'+id).val());
            var totalQty = parseInt($('.qty').text());
            $('.qty').text(totalQty - removeQty);
            showItemPublic('mua-hang/order', id,
                function (data) {
                    $('#spin').hide();
                    showAlertSuccess();
                    $('#detail-bill-modal').html(data);
                    $('#detail-bill-modal').modal('toggle');
                    $('#shop_'+id).remove();
                },
                function (error) {
                    $('#spin').hide();
                    showAlertDanger();
                    alert('Có lỗi khi cập nhật');
                }
            );
        }
        $("#detail-bill-modal").on("hide.bs.modal", function () {
            if (parseInt($('.qty').text()) == 0)
            {
                window.location.replace('<?php echo e(route('shop.index.index')); ?>');
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>