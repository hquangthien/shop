<?php $__env->startSection('title'); ?>
    Giỏ hàng
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(route('shop.index.index')); ?>">Trang chủ</a></li>
                    <li class="active">Giỏ hàng</li>
                </ol>
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
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!session('cart')): ?>
                        <tr>
                            <td colspan="6" class="text-center"> Không có sản phẩm nào </td>
                        </tr>
                    <?php else: ?>
                        <?php
                            $objProduct = session('cart')->items;
                            $total = 0;
                        ?>
                        <?php $__currentLoopData = $objProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="product-item" id="pro_<?php echo e($product['item']->id); ?>">
                                <td class="cart_product">
                                    <a href="javascript:void(0)"><img style="width: 100px;" src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($product['item']->picture); ?>" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h5><a href="<?php echo e(route('shop.product.detail', ['slug' => str_slug($product['item']->name), 'id' => $product['item']->id])); ?>"><?php echo e($product['item']->name); ?></a></h5>
                                </td>
                                <td class="cart_price">
                                    <p id="product_price_<?php echo e($product['item']->id); ?>"><?php echo e(number_format($product['item']->price*(1- $product['item']->promotion_price/100))); ?></p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a onclick="downItem('<?php echo e($product['item']->id); ?>')" class="cart_quantity_down" href="javascript:void(0)"> - </a>
                                        <input id="product_<?php echo e($product['item']->id); ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="cart_quantity_input" type="text" name="quantity" value="<?php echo e($product['qty']); ?>" autocomplete="off" size="2">
                                        <a onclick="upItem('<?php echo e($product['item']->id); ?>')" class="cart_quantity_up" href="javascript:void(0)"> + </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <?php
                                        $total += $product['price'];
                                    ?>
                                    <p class="cart_total_price" id="cart_total_<?php echo e($product['item']->id); ?>"><?php echo e(number_format($product['price'])); ?></p>
                                </td>
                                <td class="cart_delete">
                                    <a class="detail-add-to-card" onclick="addToCartWithQty(<?php echo e($product['item']->id); ?>)" href="javascript:void(0)"><i style="color: #0eac5c" class="fa fa-save"></i></a>
                                    <a class="cart_quantity_delete" onclick="removeItemInCart(<?php echo e($product['item']->id); ?>)" href="javascript:void(0)"><i style="color: red" class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tbody><tr>
                                        <td><strong> Tổng thanh toán: </strong></td>
                                        <td id="super_total" class="cart_total_price"><?php echo e(number_format($total)); ?></td>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
            <a href="<?php echo e(route('shop.bill.checkout')); ?>" class="btn btn-primary pull-right btn-lg">Checkout</a>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e($publicUrl); ?>js/numberformat.js"></script>
    <script>
        $('.cart_quantity_up').on('click', function() {
            var btn = $(this);
            var input = btn.closest('.cart_quantity').find('input');
            input.val(parseInt(input.val()) + 1);

            $(this).parent('.product-item').html('abc');
        });

        $('.cart_quantity_down').on('click', function() {
            var btn = $(this);
            var input = btn.closest('.cart_quantity').find('input');
            if (parseInt(input.val()) > 1) {
                input.val(parseInt(input.val(), 10) - 1);
            } else {
                btn.prev("disabled", true);
            }
        });

        function downItem(id)
        {
            var qty = parseInt($('#product_'+id).val());
            if (qty > 1){
                qty--;
                var price = numeral($('#product_price_'+id).text()).value();
                var total = qty * price;
                var current_total = numeral($('#cart_total_'+id).text()).value();
                var super_total = numeral($('#super_total').text()).value() - current_total + total;
                $('#cart_total_'+id).text(numeral(total).format('0,0'));
                addToCartWithQty2(id, qty);
                $('#super_total').text(numeral(super_total).format('0,0'))
            }
        }

        function upItem(id)
        {
            var qty = parseInt($('#product_'+id).val()) + 1;
            var price = numeral($('#product_price_'+id).text()).value();
            var current_total = numeral($('#cart_total_'+id).text()).value();
            var total = qty * price;
            var super_total = numeral($('#super_total').text()).value() - current_total + total;
            $('#cart_total_'+id).text(numeral(total).format('0,0'));
            addToCartWithQty2(id, qty);
            $('#super_total').text(numeral(super_total).format('0,0'))
        }

        function addToCartWithQty2(id, qty) {
            if (qty >= 1) {
                addToCartQty('add_cart_qty', id, qty,
                    function (data) {
                        showAlertSuccess();
                        $('.qty').html('' + data.total);
                    },
                    function (error) {
                        showAlertDanger();
                        console.log(error);
                    }
                );
            }
        }

        function addToCartWithQty(id) {
            var price = numeral($('#product_price_'+id).text()).value();
            var current_total = numeral($('#cart_total_'+id).text()).value();
            var qty = $('#product_'+id).val();
            var total = qty * price;
            var super_total = numeral($('#super_total').text()).value() - current_total + total;
            $('#super_total').text(numeral(super_total).format('0,0'));
            $('#cart_total_'+id).text(numeral(total).format('0,0'));
            if (qty >= 1) {
                addToCartQty('add_cart_qty', id, qty,
                    function (data) {
                        showAlertSuccess();
                        $('.qty').html('' + data.total);
                    },
                    function (error) {
                        showAlertDanger();
                        console.log(error);
                    }
                );
            }
        }

        function removeItemInCart(id) {
            updateActivePublic('remove_cart', id,
                function (data) {
                    showAlertSuccess();
                    var current_total = numeral($('#cart_total_'+id).text()).value();
                    var super_total = numeral($('#super_total').text()).value() - current_total;
                    $('#super_total').text(numeral(super_total).format('0,0'))
                    $('#pro_'+id).fadeOut("slow", function () {
                        $('#pro_'+id).remove();
                    });
                    if (data.total == null)
                    {
                        $('.qty').html(0);
                    } else{
                        $('.qty').html('' + data.total);
                    }
                },
                function (error) {
                    showAlertDanger();
                    console.log(error);
                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>