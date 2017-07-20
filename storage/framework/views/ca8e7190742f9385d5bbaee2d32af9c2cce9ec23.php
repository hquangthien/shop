<?php $__env->startSection('title'); ?>
    Quản lý thành viên
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Quản lý thành viên
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách người dùng</h4>
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
                                    <th>Username</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Quyền</th>
                                    <th>Tình trạng</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $objUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th><?php echo e($userItem->id); ?></th>
                                    <td><?php echo e($userItem->username); ?></td>
                                    <td><?php echo e($userItem->fullname); ?></td>
                                    <td><?php echo e($userItem->email); ?></td>
                                    <td><?php echo e($userItem->name_role); ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="changeActive(<?php echo e($userItem->id); ?>)">
                                        <?php if($userItem->active_user == 1): ?>
                                                <img id="user<?php echo e($userItem->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/1.gif">
                                        <?php else: ?>
                                            <img id="user<?php echo e($userItem->id); ?>" src="<?php echo e($adminUrl); ?>assets/images/0.gif">
                                        <?php endif; ?>
                                        </a>
                                    </td>
                                    <td class="actions">
                                        <?php if(Auth::user()->role == 1): ?>
                                        <a href="<?php echo e(route('admin.guest.destroy', ['id' => $userItem->id])); ?>" onclick="return confirm('Bạn có chắc chắn xóa người dùng này?')" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
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
                            <?php echo e($objUser->links()); ?>

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
            updateActive('user/active_user', id,
                function (data) {
                    $('#user'+id).attr('src', '<?php echo e($adminUrl); ?>assets/images/'+ data.active +'.gif');
                },
                function (error) {
                    console.log(error);
                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>