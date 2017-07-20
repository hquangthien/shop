<?php $__env->startSection('title'); ?>
    Quản lý shop
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Quản lý shop
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách shop</h4>
                        <?php if(session('msg')): ?>
                            <p class="alert alert-success"> <?php echo e(session('msg')); ?> </p>
                        <?php endif; ?>
                        <?php if(session('msg_dlt')): ?>
                            <p class="alert alert-danger"> <?php echo e(session('msg_dlt')); ?> </p>
                        <?php endif; ?>
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tài khoản sở hữu</th>
                                    <th>Tên shop</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Tình trạng</th>
                                    <th>Ngày mở</th>
                                    <th>Hoạt động lần cuối</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $objShop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($shop->id); ?></td>
                                        <td><?php echo e($shop->username); ?></td>
                                        <td><?php echo e($shop->name); ?></td>
                                        <td><?php echo e($shop->address); ?></td>
                                        <td><?php echo e($shop->email); ?></td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="changeActive(<?php echo e($shop->id); ?>)">
                                                <?php if($shop->active_shop == 1): ?>
                                                    <img id="cmt<?php echo e($shop->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/1.gif">
                                                <?php else: ?>
                                                    <img id="cmt<?php echo e($shop->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/0.gif">
                                                <?php endif; ?>
                                            </a>
                                        </td>
                                        <td><?php echo e($shop->created_at); ?></td>
                                        <td>
                                            <?php if($shop->last_activity != null): ?>
                                                <?php echo e($shop->last_activity); ?>

                                            <?php else: ?>
                                                Shop này chưa hoạt động
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(Auth::user()->role == 1): ?>
                                            <a href="<?php echo e(route('admin.shop.delete', ['id' => $shop->id])); ?>" onclick="return confirm('Bạn có chắc chắn xóa shop này?')" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                <?php else: ?>
                                                No action
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <?php echo e($objShop->links()); ?>

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
        function changeActive(id) {
            updateActive('shop/active_shop', id,
                function (data) {
                    $('#cmt'+id).attr('src', '<?php echo e($adminUrl); ?>assets/images/'+ data.active +'.gif');
                },
                function (error) {

                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>