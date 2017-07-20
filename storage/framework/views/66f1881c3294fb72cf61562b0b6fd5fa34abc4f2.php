<?php $__env->startSection('title'); ?>
    Quản lý email
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Quản lý email
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách email</h4>
                        <?php if(session('msg')): ?>
                            <p class="alert alert-success"> <?php echo e(session('msg')); ?> </p>
                        <?php endif; ?>
                        <?php if(session('msg_dlt')): ?>
                            <p class="alert alert-danger"> <?php echo e(session('msg_dlt')); ?> </p>
                        <?php endif; ?>
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table m-0 table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên người gửi</th>
                                    <th>Tên chủ đề</th>
                                    <th>Email</th>
                                    <th>Tình trạng</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $objContact; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contactItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr <?php if($contactItem->readed == 0): ?> style="font-weight: bold; background-color: #ebeff2" <?php endif; ?>>
                                        <td><?php echo e($contactItem->id); ?></td>
                                        <td><?php echo e($contactItem->name); ?></td>
                                        <td><?php echo e($contactItem->subject); ?></td>
                                        <td><?php echo e($contactItem->email); ?></td>
                                        <td>
                                            <?php if($contactItem->readed == 0): ?>
                                                Chưa đọc
                                            <?php else: ?>
                                                Đã đọc
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('ban.contact.show', ['id' => $contactItem->id])); ?>" class="on-default edit-row"><i class="fa fa-paper-plane"></i></a> ||
                                            <a href="<?php echo e(route('ban.contact.delete', ['id' => $contactItem->id])); ?>"
                                               onclick="return confirm('Bạn có muốn xóa không? ')"
                                               class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        </td>

                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.ban.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>