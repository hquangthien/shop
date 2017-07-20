<?php $__env->startSection('title'); ?>
    <?php echo e(Auth::user()->fullname); ?> | Lịch sử mua hàng
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-8">
        <div id="contact-page" class="container">
            <div class="bg">
                <div class="row">
                    <div class="col-sm-9">
                        <?php if(sizeof($objBill) == 0): ?>
                            <p class="alert alert-warning text-center"> Bạn chưa có đơn hàng nào </p>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-box">
                                        <h4 class="header-title m-t-0 m-b-30">Danh sách đơn hàng</h4>
                                        <div class="table-responsive">
                                            <table class="table m-0 text-center table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Ngày tạo</th>
                                                    <th>Người nhận</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Chú thích</th>
                                                    <th>Tình trạng</th>
                                                    <th>Chức năng</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if(sizeof($objBill) == 0): ?>
                                                    <tr>
                                                        <td colspan="9" class="text-center">Không có đơn hàng nào</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $objBill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($bill->created_at); ?></td>
                                                            <td><?php echo e($bill->name); ?></td>
                                                            <td><?php echo e($bill->phone); ?></td>
                                                            <td><?php echo e($bill->address); ?></td>
                                                            <td><?php echo e(number_format($bill->total)); ?> VND</td>
                                                            <td><?php echo e($bill->note); ?></td>
                                                            <td><?php echo e($bill->name_status); ?></td>
                                                            <td>
                                                                <a href="javascript:void(0)" type="button" onclick="getItem(<?php echo e($bill->id); ?>)" class="edit-modal mrg" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center">
                                            <?php echo e($objBill->links()); ?>

                                        </div>
                                    </div>
                                </div><!-- end col -->

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="detail-bill-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Chi tiết hóa đơn</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" onclick="alert('comming soon!')" class="btn btn-primary btn-rounded w-lg waves-effect waves-light m-b-20 m-t-30" data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200" data-overlaycolor="#36404a"><i class="fa fa-print"></i>In</a>
                    <a href="javascript:void(0)" class="btn btn-default btn-rounded w-lg waves-effect waves-light m-b-20 m-t-30" data-dismiss="modal" data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200" data-overlaycolor="#36404a">Đóng</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
        function getItem(id) {
            showItemPublic('chi-tiet-hoa-don-user', id,
                function (data) {
                    $('.modal-body').html(data);
                    $('#detail-bill-modal').modal('toggle');
                },
                function (error) {
                    alert('Có lỗi khi cập nhật');
                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.shop.master2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>