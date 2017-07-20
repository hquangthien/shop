<?php $__env->startSection('title'); ?>
    Quản lý quảng cáo
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Quản lý quảng cáo
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách quảng cáo</h4>
                        <?php if(session('msg')): ?>
                            <p class="alert alert-success"> <?php echo e(session('msg')); ?> </p>
                        <?php endif; ?>
                        <?php if(session('msg_dlt')): ?>
                            <p class="alert alert-danger"> <?php echo e(session('msg_dlt')); ?> </p>
                        <?php endif; ?>
                        <a href="<?php echo e(route('admin.adv.create')); ?>" class="btn btn-primary">Tạo mới</a>
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên quảng cáo</th>
                                    <th>Link</th>
                                    <th>Vị trí</th>
                                    <th>Tình trạng</th>
                                    <th>Hình ảnh</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $objAdv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th><?php echo e($advItem->id); ?></th>
                                    <td><?php echo e($advItem->name); ?></td>
                                    <td><?php echo e($advItem->link); ?></td>
                                    <td>
                                        <?php if($advItem->position == 1): ?>
                                            header
                                        <?php else: ?>
                                            right bar
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="changeActive(<?php echo e($advItem->id); ?>)">
                                            <?php if($advItem->active_adv == 1): ?>
                                                <img id="adv<?php echo e($advItem->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/1.gif">
                                            <?php else: ?>
                                                <img id="adv<?php echo e($advItem->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/0.gif">
                                            <?php endif; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <img width="150" src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($advItem->image); ?>" />
                                    </td>
                                    <td class="actions">
                                        <a href="<?php echo e(route('admin.adv.edit', ['id' => $advItem->id])); ?>" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                        <?php if(Auth::user()->role == 1): ?>
                                            || <a href="<?php echo e(route('admin.adv.delete', ['id' => $advItem->id])); ?>" onclick="return confirm('Bạn có muốn xóa quảng cáo này không?')" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <?php echo e($objAdv->links()); ?>

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
            updateActive('adv/active_adv', id,
                function (data) {
                    $('#adv'+id).attr('src', '<?php echo e($adminUrl); ?>assets/images/'+ data.active +'.gif');
                },
                function (error) {
                    console.log(error);
                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>