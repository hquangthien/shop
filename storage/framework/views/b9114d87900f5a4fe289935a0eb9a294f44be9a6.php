<?php $__env->startSection('title'); ?>
    Trang quản lý sản phẩm
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Trang quản lý sản phẩm
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách sản phẩm</h4>
                        <?php if(session('msg')): ?>
                            <p class="alert alert-success"> <?php echo e(session('msg')); ?> </p>
                        <?php endif; ?>
                        <?php if(session('msg_dlt')): ?>
                            <p class="alert alert-danger"> <?php echo e(session('msg_dlt')); ?> </p>
                        <?php endif; ?>
                        <form action="<?php echo e(route('admin.product.filter')); ?>" method="GET">
                            <div class="row card-box">
                                <div class="col-md-4">
                                    <?php if(isset($name_filter)): ?>
                                        <input type="text" name="name_filter" class="form-control border-input"
                                               value="<?php echo e($name_filter); ?>" placeholder="Tên sản phẩm...">
                                    <?php else: ?>
                                        <input type="text" name="name_filter" class="form-control border-input"
                                               placeholder="Tên sản phẩm...">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-2">
                                    <?php if(isset($date_filter)): ?>
                                        <input type="date" name="created_at" class="form-control border-input"
                                               value="<?php echo e($date_filter); ?>" placeholder="Ngày tạo">
                                    <?php else: ?>
                                        <input type="date" name="created_at" class="form-control border-input"
                                               placeholder="Ngày tạo">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-2">
                                    <select name="status" class="form-control">
                                        <option value="<?php echo e(null); ?>">-- Tình trạng --</option>
                                        <option <?php if(isset($status_filter)): ?>
                                                <?php if($status_filter == 2): ?>
                                                selected
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                value="2">Đang chờ duyệt</option>
                                        <option <?php if(isset($status_filter)): ?>
                                                    <?php if($status_filter == 0): ?>
                                                    selected
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                    value="0">Vô hiệu</option>
                                        <option
                                                <?php if(isset($status_filter)): ?>
                                                    <?php if($status_filter == 1): ?>
                                                    selected
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                value="1">Đang đăng bán</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="shop" class="form-control js-example-basic-single">
                                        <option value="<?php echo e(null); ?>">-- Shop --</option>
                                        <?php if(isset($shop_filter)): ?>
                                            <?php $__currentLoopData = $objShop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($shop->id); ?>"
                                                        <?php if($shop->id == $shop_filter): ?>
                                                        selected
                                                        <?php endif; ?>
                                                ><?php echo e($shop->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <?php $__currentLoopData = $objShop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($shop->id); ?>"><?php echo e($shop->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-primary" value="Lọc">
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ngày đăng</th>
                                    <th>TT sản phẩm</th>
                                    <th>Shop đăng bán</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th>Ghim top</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $objProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($product->id); ?></td>
                                        <td><?php echo e($product->created_at); ?></td>
                                        <td>
                                            <p>
                                                <a href="<?php echo e(route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id])); ?>"><?php echo e($product->name); ?></a>
                                            </p>
                                            <img width="150px" src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($product->picture); ?>" alt="">
                                        </td>
                                        <td><?php echo e($product->name_shop); ?></td>
                                        <td><?php echo e(number_format($product->price)); ?> VND</td>
                                        <td id="cancel<?php echo e($product->id); ?>">
                                            <?php if($product->active_product == 2): ?>
                                                <a href="javascript:void(0)" onclick="changeActive(<?php echo e($product->id); ?>)" class="btn btn-success">Duyệt</a>
                                                <a href="javascript:void(0)" onclick="cancelProduct(<?php echo e($product->id); ?>)" class="btn btn-danger">Từ chối</a>
                                            <?php else: ?>
                                            <a id="product<?php echo e($product->id); ?>" href="javascript:void(0)" onclick="changeActive(<?php echo e($product->id); ?>)">
                                                <?php if($product->active_product == 1): ?>
                                                    <img id="cmt<?php echo e($product->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/1.gif" />
                                                <?php else: ?>
                                                    <img id="cmt<?php echo e($product->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/0.gif">
                                                <?php endif; ?>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="changePin(<?php echo e($product->id); ?>)">
                                                <?php if($product->pin == 1): ?>
                                                    <img id="pin<?php echo e($product->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/1.gif" />
                                                <?php else: ?>
                                                    <img id="pin<?php echo e($product->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/0.gif">
                                                <?php endif; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.product.delete', ['id' => $product->id])); ?>"
                                               onclick="return confirm('Bạn có muốn xóa không? ')"
                                               class="on-default remove-row"><i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <?php echo e($objProduct->links()); ?>

                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e($adminUrl); ?>assets/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e($adminUrl); ?>assets/plugins/select2/dist/css/select2-bootstrap.css" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e($adminUrl); ?>assets/plugins/select2/dist/js/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".js-example-basic-single").select2();
        });
        function changeActive(product_id) {
            updateActive('product/active_product', product_id,
                function (data) {
                    $('#cancel'+product_id).html(
                        '<a id="product'+ product_id +'" href="javascript:void(0)" onclick="changeActive('+ product_id +')">'+
                        '<img id="cmt'+ product_id +'" src="<?php echo e($adminUrl); ?>assets/images/'+ data.active +'.gif">'+
                        '</a>'
                    );
                },
                function (error) {

                }
            );
        }

        function changePin(product_id) {
            updateActive('product/pin_product', product_id,
                function (data) {
                    $('#pin'+product_id).attr('src', '<?php echo e($adminUrl); ?>assets/images/'+ data.active +'.gif');

                },
                function (error) {

                }
            );
        }

        function cancelProduct(product_id) {
            updateActive('product/cancel_product', product_id,
                function (data) {
                    $('#cancel'+product_id).html(
                        '<a id="product'+ product_id +'" href="javascript:void(0)" onclick="changeActive('+ product_id +')">'+
                        '<img id="cmt'+ product_id +'" src="<?php echo e($adminUrl); ?>assets/images/'+ data.active +'.gif">'+
                        '</a>'
                    );

                },
                function (error) {

                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>