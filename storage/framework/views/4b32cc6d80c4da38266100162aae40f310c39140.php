<?php $__env->startSection('title'); ?>
    Trang thống kê
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Trang thống kê
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Shop</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <span class="badge badge-primary pull-left m-t-20"><i
                                            class="fa  fa-handshake-o fa-2x"></i> </span>
                            </div>

                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"><span id="sum-news"></span><?php echo e($countShop); ?></h2>
                                <p class="text-muted">Shop đăng ký bán hàng</p>
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
                                            class="fa  fa-window-maximize fa-2x"></i> </span>
                                <h2 class="m-b-0"><span id="sum-views"></span><?php echo e($sumBill); ?></h2>
                                <p class="text-muted m-b-25">Tổng số đơn hàng đã hoàn tất</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Đơn hàng</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <span class="badge badge-warning pull-left m-t-20"><i class="fa  fa-window-maximize fa-2x"></i> </span>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"><span id="sum-messages"></span><?php echo e($sumBillPending); ?></h2>
                                <p class="text-muted">Tổng số đơn hàng đang chờ xử lý</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Mặt hàng</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2">
                                <span class="badge badge-success pull-left m-t-20"><i class="zmdi zmdi-collection-item zmdi-hc-2x"></i> </span>
                                <h2 class="m-b-0"><span id="sum-comments"></span><?php echo e($sumProduct); ?></h2>
                                <p class="text-muted m-b-25">Tổng số mặt hàng đang được bán</p>
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
                    <h4 class="header-title m-t-0">Sản phẩm chờ duyệt (<span id="sum"><?php if($sumNewPro<10): ?><?php echo e($sumNewPro); ?><?php else: ?> 10 <?php endif; ?></span>/<?php echo e($sumNewPro); ?> ) </h4>
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
                            <?php if(sizeof($objNewProduct) == 0): ?>
                                <tr>
                                    <td colspan="8" class="text-center"> Không có sản phẩm nào </td>
                                </tr>
                            <?php endif; ?>
                            <?php $__currentLoopData = $objNewProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="product<?php echo e($product->id); ?>">
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
                                    <td>
                                        <a href="javascript:void(0)" onclick="changeActive(<?php echo e($product->id); ?>)" class="btn btn-success">Duyệt</a>
                                        <a href="javascript:void(0)" onclick="cancelProduct(<?php echo e($product->id); ?>)" class="btn btn-danger">Từ chối</a>
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
                                        <?php if(Auth::user()->role == 1): ?>
                                        <a href="<?php echo e(route('admin.product.delete', ['id' => $product->id])); ?>"
                                           onclick="return confirm('Bạn có muốn xóa không? ')"
                                           class="on-default remove-row"><i class="fa fa-trash-o"></i>
                                        </a>
                                        <?php else: ?>
                                            No action
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

        function changeActive(product_id) {
            updateActive('product/active_product', product_id,
                function (data) {
                    $('#sum').text(parseInt($('#sum').text()) - 1);
                    $('#product'+product_id).fadeOut("slow", function () {
                        $('#product'+product_id).remove();
                    });
                },
                function (error) {

                }
            );
        }

        function cancelProduct(product_id) {
            updateActive('product/cancel_product', product_id,
                function (data) {
                    $('#sum').text(parseInt($('#sum').text()) - 1);
                    $('#product'+product_id).fadeOut("slow");
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
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>