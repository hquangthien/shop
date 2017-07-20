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
                        <form action="<?php echo e(route('admin.bill.filter')); ?>" method="GET">
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
                                    <th>Ngày tạo</th>
                                    <th>Cửa hàng</th>
                                    <th>Người nhận</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Tổng tiền</th>
                                    <th>Thanh toán</th>
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
                                        <td><?php echo e($bill->shop_name); ?></td>
                                        <td><?php echo e($bill->name); ?></td>
                                        <td><?php echo e($bill->phone); ?></td>
                                        <td><?php echo e($bill->email); ?></td>
                                        <td><?php echo e($bill->address); ?></td>
                                        <td><?php echo e(number_format($bill->total)); ?> VND</td>
                                        <td><?php echo e($bill->name); ?></td>
                                        <td class="bill_status">
                                            <?php if($bill->status == 1): ?>
                                                <p class="btn btn-info"><?php echo e($bill->name_status); ?></p>
                                            <?php elseif($bill->status == 4 || $bill->status == 5): ?>
                                                <p class="btn btn-danger"><?php echo e($bill->name_status); ?></p>
                                            <?php elseif($bill->status == 7): ?>
                                                <p class="btn btn-success"><?php echo e($bill->name_status); ?></p>
                                            <?php else: ?>
                                            <select onchange="changeStatus($(this).val(), '<?php echo e($bill->id); ?>')" class="form-control">
                                                <?php for($i = $bill->status; $i <= sizeof($objStatus); $i++): ?>
                                                    <option class="status_id_<?php echo e($objStatus[$i-1]->id); ?>" value="<?php echo e($objStatus[$i-1]->id); ?>"
                                                            <?php if($objStatus[$i-1]->id == $bill->status): ?>
                                                            selected
                                                            <?php endif; ?>
                                                    ><?php echo e($objStatus[$i-1]->name_status); ?></option>
                                                <?php endfor; ?>
                                            </select>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" type="button" onclick="getItem('<?php echo e($bill->id); ?>', '<?php echo e($bill->shop_id); ?>')" class="edit-modal mrg" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <?php if(Auth::user()->role == 1): ?>
                                            ||
                                            <a href="<?php echo e(route('admin.bill.delete', ['id' => $bill->id])); ?>"
                                               onclick="return confirm('Bạn có muốn xóa không? ')"
                                               class="on-default remove-row"><i class="fa fa-trash-o"></i>
                                            </a>
                                            <?php endif; ?>
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
    <link href="<?php echo e($adminUrl); ?>assets/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e($adminUrl); ?>assets/plugins/select2/dist/css/select2-bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        .notice {
            position:relative;
            top:20px;
            opacity:0;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e($adminUrl); ?>assets/plugins/select2/dist/js/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".js-example-basic-single").select2();
        });
        function changeStatus(id, bill_id) {
            $("#spin").show();
            updateStatusAdmin('bill/status_bill', bill_id, id,
                function (data) {
                    if (jQuery.inArray(data.id_status, ['4', '5', '7']) != -1) {
                        switch (data.id_status) {
                            case '4':
                                $('#bill_' + bill_id).find('.bill_status').html('<p class="notice btn btn-danger">' + data.name_status + '</p>');
                                break;
                            case '5':
                                $('#bill_' + bill_id).find('.bill_status').html('<p class="notice btn btn-danger">' + data.name_status + '</p>');
                                break;
                            case '7':
                                $('#bill_' + bill_id).find('.bill_status').html('<p class="notice btn btn-success">' + data.name_status + '</p>');
                                break;
                        }
                        $('.notice').animate({opacity: 1, top:0}, 500);
                    } else{
                        var i;
                        for(i = 1; i < id; i++){
                            $('#bill_' + bill_id).find('.status_id_'+i).remove();
                        }
                    }
                    $("#spin").hide();
                },
                function (error) {
                    $("#spin").hide();
                }
            );
        }

        function getItem(id, shop_id) {
            $('#messages-success-alert').remove();
            showItemAdmin('bill', id, shop_id,
                function (data) {
                    $('.modal-body').html(data);
                    $('#detail-bill-modal').modal('toggle');
                },
                function (error) {
                    alert('Có lỗi khi cập nhật');
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

<?php echo $__env->make('templates.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>