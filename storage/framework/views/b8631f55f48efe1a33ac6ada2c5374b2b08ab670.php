<?php $__env->startSection('title'); ?>
    Trang thống kê
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Trang thống kê
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo e($adminUrl); ?>assets/plugins/morris/morris.css">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Sản phẩm</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <span class="badge badge-primary pull-left m-t-20"><i
                                            class="fa  fa-newspaper-o fa-2x"></i> </span>
                            </div>

                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"><span id="sum-news"></span><?php echo e($sumProduct); ?></h2>
                                <p class="text-muted">Sản phẩm đang được đăng bán</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Đơn hàng</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2">
                                <span class="badge badge-success pull-left m-t-20"><i
                                            class="fa fa-window-maximize fa-2x"></i> </span>
                                <h2 class="m-b-0"><span id="sum-views"></span><?php echo e($sumBill); ?></h2>
                                <p class="text-muted m-b-25">Đơn hàng đã hoàn tất</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Tin nhắn góp ý</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <span class="badge badge-danger pull-left m-t-20"><i class="fa  fa-envelope fa-2x"></i> </span>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"><span id="sum-messages"></span><?php echo e($sumContact); ?></h2>
                                <p class="text-muted">Tổng tin nhắn góp ý</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Bình luận</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2">
                                <span class="badge badge-warining pull-left m-t-20"><i class="fa  fa-comment fa-2x"></i> </span>
                                <h2 class="m-b-0"><span id="sum-comments"></span><?php echo e($sumComment); ?></h2>
                                <p class="text-muted m-b-25">Tổng số bình luận về shop</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Đơn hàng theo ngày</h4>
                        <div id="morris-line-example" style="background-color: #3d6983">
                        </div>
                    </div>
                </div><!-- end col-->
                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Doanh thu theo ngày</h4>
                        <div id="morris-line-example2" style="background-color: #3d6983">
                        </div>
                    </div>
                </div><!-- end col-->
            </div>
            <div class="row card-box">
                <div class="col-md-12">
                    <h4 class="header-title m-t-0">Đơn hàng mới (<span id="sum"><?php if($sumNewBill<10): ?><?php echo e($sumNewBill); ?><?php else: ?> 10 <?php endif; ?></span>/<?php echo e($sumNewBill); ?> )</h4>
                    <div class="table-responsive">
                        <table class="table m-0 text-center table-bordered">
                            <thead>
                            <tr>
                                <th>Ngày tạo</th>
                                <th>Người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
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
                                    <tr id="bill_<?php echo e($bill->id); ?>">
                                        <td><?php echo e($bill->created_at); ?></td>
                                        <td><?php echo e($bill->name); ?></td>
                                        <td><?php echo e($bill->phone); ?></td>
                                        <td><?php echo e($bill->address); ?></td>
                                        <td><?php echo e(number_format($bill->total)); ?> VND</td>
                                        <td><?php echo e($bill->name); ?></td>
                                        <td><?php echo e($bill->note); ?></td>
                                        <td>
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
                                                <?php echo e($bill->name_status); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
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
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e($adminUrl); ?>assets/plugins/morris/morris.min.js"></script>
    <script src="<?php echo e($adminUrl); ?>assets/plugins/raphael/raphael-min.js"></script>
    <script type="text/javascript">
        Morris.Line({
            element: 'morris-line-example',
            data: [
                <?php if(sizeof($sttBills)): ?>
                <?php $__currentLoopData = $sttBills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    { y: '<?php echo e($bill->date); ?>', a: '<?php echo e($bill->count_bill); ?>' },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Đơn hàng']
        });

        Morris.Line({
            element: 'morris-line-example2',
            data: [
                <?php if(sizeof($sttRevenue)): ?>
                <?php $__currentLoopData = $sttRevenue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    { y: '<?php echo e($bill->date); ?>', a: '<?php echo e($bill->total); ?>' },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Danh thu']
        });

        function changeStatus(id, bill_id) {
            updateStatus('bill/status_bill', bill_id, id,
                function (data) {
                    $('#sum').text(parseInt($('#sum').text()) - 1);
                    $('#bill_'+bill_id).fadeOut("slow", function () {
                        $('#bill_'+bill_id).remove();
                    });
                },
                function (error) {

                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.ban.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>