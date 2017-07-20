<?php $__env->startSection('title'); ?>
    Trang quản lý đơn hàng
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Trang quản lý đơn hàng
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách đơn hàng</h4>
                        <?php if(session('msg')): ?>
                            <p class="alert alert-success"> <?php echo e(session('msg')); ?> </p>
                        <?php endif; ?>
                        <?php if(session('msg_dlt')): ?>
                            <p class="alert alert-danger"> <?php echo e(session('msg_dlt')); ?> </p>
                        <?php endif; ?>
                        <form action="<?php echo e(route('ban.bill.filter')); ?>" method="GET">
                            <div class="row card-box">
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
                                        <?php if(isset($status_filter)): ?>
                                            <?php $__currentLoopData = $objStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status->id); ?>"
                                                        <?php if($status->id == $status_filter): ?>
                                                        selected
                                                        <?php endif; ?>
                                                ><?php echo e($status->name_status); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <?php $__currentLoopData = $objStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status->id); ?>"><?php echo e($status->name_status); ?></option>
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
                                    <th>Ngày tạo</th>
                                    <th>Người nhận</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Tổng tiền</th>
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
                                    <tr id="bill_<?php echo e($bill->id); ?>">
                                        <td><?php echo e($bill->created_at); ?></td>
                                        <td><?php echo e($bill->name); ?></td>
                                        <td><?php echo e($bill->phone); ?></td>
                                        <td><?php echo e($bill->address); ?></td>
                                        <td><?php echo e($bill->email); ?></td>
                                        <td><?php echo e(number_format($bill->total)); ?> VND</td>
                                        <td class="bill_status">
                                            <?php if($bill->status == 1): ?>
                                                <a href="javascript:void(0)"
                                                   onclick="changeStatus(2, '<?php echo e($bill->id); ?>')"
                                                   class="btn btn-success"><i class="fa fa-bus"></i> Còn hàng
                                                </a>
                                                <a href="javascript:void(0)"
                                                   onclick="changeStatus(4, '<?php echo e($bill->id); ?>')"
                                                   class="btn btn-warning"><i class="fa fa-window-close"></i> Hết hàng
                                                </a>
                                            <?php else: ?>
                                                <?php if(in_array($bill->status, [2, 3, 6])): ?>
                                                    <p class="btn btn-info"><?php echo e($bill->name_status); ?></p>
                                                <?php elseif(in_array($bill->status, [4, 5])): ?>
                                                    <p class="btn btn-danger"><?php echo e($bill->name_status); ?></p>
                                                <?php else: ?>
                                                    <p class="btn btn-success"><?php echo e($bill->name_status); ?></p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" type="button" onclick="getItem(<?php echo e($bill->id); ?>)" class="edit-modal mrg" data-toggle="modal"><i class="fa fa-eye"></i></a> ||
                                            <a href="<?php echo e(route('ban.bill.delete', ['id' => $bill->id])); ?>"
                                               onclick="return confirm('Bạn có muốn xóa không? ')"
                                               class="on-default remove-row"><i class="fa fa-trash-o"></i>
                                            </a>
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
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
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
<?php $__env->startSection('css'); ?>
    <style>
        .notice {
            position:relative;
            top:20px;
            opacity:0;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
        function changeStatus(id, bill_id) {
            updateStatus('bill/status_bill', bill_id, id,
                function (data) {
                    switch (data.id_status)
                    {
                        case 2:
                            $('#bill_'+bill_id).find('.bill_status').html('<p class="notice btn btn-info"> '+ data.name_status +' </p>');
                            break;
                        case 3:
                            $('#bill_'+bill_id).find('.bill_status').html('<p class="notice btn btn-info"> '+ data.name_status +' </p>');
                            break;
                        case '4':
                            $('#bill_'+bill_id).find('.bill_status').html('<p class="notice btn btn-danger"> '+ data.name_status +' </p>');
                            break;
                    }
                    $('.notice').animate({opacity: 1, top:0}, 500);
                },
                function (error) {

                }
            );
        }

        function getItem(id) {
            $('#messages-success-alert').remove();
            showItem('bill', id,
                function (data) {
                    $('.modal-body').html(data);
                    $('#detail-bill-modal').modal('toggle');
                },
                function (error) {

                }
            );
            setTimeout(function(){
                $('#spin').after(
                    '<div id="messages-success-alert" class="card-box">'+
                    '<i class="fa fa-info-circle" aria-hidden="true"></i>'+
                    '<span id="message-success-ajax">Thao tác thành công!!!</span>'+
                    '</div>'
                );
            }, 4000);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.ban.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>