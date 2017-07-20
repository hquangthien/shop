<?php $__env->startSection('title'); ?>
    Quản lý bình luận
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Quản lý bình luận
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách bình luận</h4>
                        <?php if(session('msg')): ?>
                            <p class="alert alert-success"> <?php echo e(session('msg')); ?> </p>
                        <?php endif; ?>
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Nội dung</th>
                                    <th>Tình trạng</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $objComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($commentItem->id); ?></th>
                                        <td><?php echo e($commentItem->name_cmt); ?></td>
                                        <td><?php echo e($commentItem->email); ?></td>
                                        <td><?php echo e($commentItem->content); ?></td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="changeActive(<?php echo e($commentItem->id); ?>)">
                                                <?php if($commentItem->active_cmt == 1): ?>
                                                    <img id="cmt<?php echo e($commentItem->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/1.gif">
                                                <?php else: ?>
                                                    <img id="cmt<?php echo e($commentItem->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/0.gif">
                                                <?php endif; ?>
                                            </a>
                                        </td>
                                        <td class="actions">
                                            <a href="<?php echo e(route('ban.comment.destroy', ['id' => $commentItem->id])); ?>" onclick="return confirm('Bạn có chắc chắn xóa bình luận này?')" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <?php echo e($objComment->links()); ?>

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
            updateActiveBan('comment/active_cmt', id,
                function (data) {
                    $('#cmt'+id).attr('src', '<?php echo e($adminUrl); ?>assets/images/'+ data.active +'.gif');
                },
                function (error) {
                    console.log(error);
                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.ban.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>