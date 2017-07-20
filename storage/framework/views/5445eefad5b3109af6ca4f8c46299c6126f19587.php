<?php $__env->startSection('title'); ?>
    Trang quản lý tin tức
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Trang quản lý tin tức
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
                        <form action="<?php echo e(route('ban.product.filter')); ?>" method="GET">
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
                                        <option value="<?php echo e(null); ?>">-- Trạng thái --</option>
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
                                    <input type="submit" class="btn btn-primary" value="Lọc">
                                </div>
                            </div>
                        </form>
                        <a href="<?php echo e(route('ban.product.create')); ?>" class="btn btn-primary">Tạo mới</a>
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ngày đăng</th>
                                    <th>TT sản phẩm</th>
                                    <th>Giá gốc</th>
                                    <th>Giảm giá</th>
                                    <th>Lượt mua</th>
                                    <th>Hình thức</th>
                                    <th>Tình trạng</th>
                                    <th>Trạng thái</th>
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
                                    <td><?php echo e(number_format($product->price)); ?> VND</td>
                                    <td width="100px">
                                        <select class="form-control chosen-select" id="promotion_price"
                                                    onchange="changePromotion($(this).val(), '<?php echo e($product->id); ?>')" tabindex="2">
                                            <?php for($i = 0; $i <= 100; $i = $i + 5): ?>
                                                <?php if($i == $product->promotion_price): ?>
                                                    <option selected value="<?php echo e($i); ?>"><?php echo e($i); ?> %</option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?> %</option>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td><?php echo e($product->count_sales); ?></td>
                                    <td><?php echo e($product->new); ?></td>
                                    <td width="150px">
                                        <select class="form-control chosen-select" id="promotion_price"
                                                onchange="changeStatus($(this).val(), '<?php echo e($product->id); ?>')" tabindex="2">
                                                <?php if($product->status == 1): ?>
                                                    <option selected value="1">Còn hàng</option>
                                                    <option value="0">Hết hàng</option>
                                                <?php else: ?>
                                                <option value="1">Còn hàng</option>
                                                <option selected value="0">Hết hàng</option>
                                                <?php endif; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <?php if($product->active_product == 1): ?>
                                            <p class="btn btn-success">Đã duyệt</p>
                                        <?php elseif($product->active_product == 0): ?>
                                            <p class="btn btn-danger">Từ chối</p>
                                        <?php elseif($product->active_product == 2): ?>
                                            <p class="btn btn-primary">Chờ duyệt</p>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('ban.product.edit', ['id' => $product->id])); ?>" class="on-default edit-row"><i class="fa fa-pencil"></i></a> ||
                                        <a href="<?php echo e(route('ban.product.delete', ['id' => $product->id])); ?>"
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
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
        function changePromotion(promotion, product_id) {
            updateStatus('product/promotion_product', product_id, promotion,
                function (data) {
                },
                function (error) {
                }
            );
        }

        function changeStatus(status, product_id) {
            updateStatus('product/status_product', product_id, status,
                function (data) {
                },
                function (error) {

                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.ban.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>