<?php $__env->startSection('title'); ?>
    Cập nhật quảng cáo
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Cập nhật quảng cáo
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Cập nhật thông tin quảng cáo</h4>

                        <div class="row">
                            <div class="col-lg-12">
                                <?php if(count($errors) > 0): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <form class="form-horizontal" action="<?php echo e(route('admin.adv.update', ['id' => $objAdv->id])); ?>" enctype="multipart/form-data" role="form" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tên quảng cáo (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" name="name" class="form-control" value="<?php echo e($objAdv->name); ?>" placeholder="Nhập tên quảng cáo...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Link (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" name="link" class="form-control" value="<?php echo e($objAdv->link); ?>" placeholder="Nhập link quảng cáo...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Vị trí (*)</label>
                                        <div class="col-md-10">
                                            <select name="position" class="form-control">
                                                <?php if($objAdv->position == 1): ?>
                                                    <option value="1" selected>header</option>
                                                <?php else: ?>
                                                    <option value="1">header</option>
                                                <?php endif; ?>
                                                <?php if($objAdv->position == 2): ?>
                                                    <option value="2" selected>right_bar</option>
                                                <?php else: ?>
                                                    <option value="2">right_bar</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Ảnh cũ</label>
                                        <div class="col-md-3">
                                            <img width="100%" src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($objAdv->image); ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Chọn ảnh (*)</label>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="submit" name="submit" value="Cập nhật" class="btn btn-lg btn-primary">
                                        <input type="reset" name="reset" value="Nhập lại" class="btn btn-lg btn-default">
                                    </div>
                                </form>
                            </div><!-- end col -->

                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
<?php $__env->stopSection(); ?>



<?php echo $__env->make('templates.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>