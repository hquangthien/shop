<?php $__env->startSection('title'); ?>
    Quản lý danh mục sản phẩm
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Quản lý danh mục sản phẩm
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách danh mục sản phẩm</h4>
                        <?php if(session('msg')): ?>
                            <p class="alert alert-success"> <?php echo e(session('msg')); ?> </p>
                        <?php endif; ?>
                        <?php if(session('msg_dlt')): ?>
                            <p class="alert alert-danger"> <?php echo e(session('msg_dlt')); ?> </p>
                        <?php endif; ?>
                        <?php if(Auth::user()->role == 1): ?>
                            <a href="<?php echo e(route('admin.cat.create')); ?>" class="btn btn-primary">Tạo mới</a>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table m-0 table-bordered">
                                <thead>
                                <tr>
                                    <th>Tên danh mục</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $objSuperCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $superCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><strong><?php echo e($superCat->name); ?></strong></td>
                                        <td class="actions text-center">
                                            <?php if(Auth::user()->role == 1): ?>
                                                <a href="<?php echo e(route('admin.cat.edit', ['id' => $superCat->id])); ?>" class="on-default edit-row"><i class="fa fa-pencil"></i></a> ||
                                                <a href="<?php echo e(route('admin.cat.delete', ['id' => $superCat->id])); ?>"
                                                   onclick="return confirm('Bạn có muốn xóa danh mục này không? ')"
                                                   class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                            <?php else: ?>
                                                No action
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php if(isset($objSubCat1[$superCat->id])): ?>
                                        <?php $__currentLoopData = $objSubCat1[$superCat->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td> &nbsp;&nbsp; - <?php echo e($subCat1->name); ?></td>
                                                <td class="actions text-center">
                                                    <?php if(Auth::user()->role == 1): ?>
                                                        <a href="<?php echo e(route('admin.cat.edit', ['id' => $subCat1->id])); ?>" class="on-default edit-row"><i class="fa fa-pencil"></i></a> ||
                                                        <a href="<?php echo e(route('admin.cat.delete', ['id' => $subCat1->id])); ?>"
                                                           onclick="return confirm('Bạn có muốn xóa không? ')"
                                                           class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                    <?php else: ?>
                                                        No action
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php if(isset($objSubCat2[$subCat1->id])): ?>
                                                <?php $__currentLoopData = $objSubCat2[$subCat1->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="dripicons-arrow-thin-right"></i> <?php echo e($subCat2->name); ?></td>
                                                        <td class="actions text-center">
                                                            <?php if(Auth::user()->role == 1): ?>
                                                                <a href="<?php echo e(route('admin.cat.edit', ['id' => $subCat2->id])); ?>" class="on-default edit-row"><i class="fa fa-pencil"></i></a> ||
                                                                <a href="<?php echo e(route('admin.cat.delete', ['id' => $subCat2->id])); ?>"
                                                                   onclick="return confirm('Bạn có muốn xóa không? ')"
                                                                   class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                            <?php else: ?>
                                                                No action
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
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

<?php echo $__env->make('templates.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>