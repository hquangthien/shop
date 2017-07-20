<?php $__env->startSection('title'); ?>
    Trang quản lý tin tức
<?php $__env->stopSection(); ?>
<?php $__env->startSection('h1'); ?>
    Trang quản lý tin tức
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Thêm sản phẩm</h4>

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
                                <form id="create_news" class="form-horizontal" action="<?php echo e(route('ban.product.update', ['id' => $objProduct->id])); ?>" method="POST" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tên sản phẩm (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="<?php echo e($objProduct->name); ?>" name="name" placeholder="Nhập tên sản phẩm...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chọn danh mục sản phẩm (*)</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="cat_id">
                                                <option value="<?php echo e(null); ?>">-- Không có --</option>
                                                <?php $__currentLoopData = $objSuperCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $superCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($objProduct->cat_id == $superCat->id): ?> selected <?php endif; ?> value="<?php echo e($superCat->id); ?>"><?php echo e($superCat->name); ?></option>
                                                    <?php if(isset($objSubCat1[$superCat->id])): ?>
                                                        <?php $__currentLoopData = $objSubCat1[$superCat->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($objProduct->cat_id == $subCat1->id): ?> selected <?php endif; ?> value="<?php echo e($subCat1->id); ?>"> + <?php echo e($subCat1->name); ?></option>
                                                            <?php if(isset($objSubCat2[$subCat1->id])): ?>
                                                                <?php $__currentLoopData = $objSubCat2[$subCat1->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option <?php if($objProduct->cat_id == $subCat2->id): ?> selected <?php endif; ?> value="<?php echo e($subCat2->id); ?>"> &nbsp;&nbsp;&nbsp; - <?php echo e($subCat2->name); ?></option>

                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Giá sản phẩm (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" id="price" value="<?php echo e($objProduct->price); ?>" name="price" class="form-control" placeholder="Nhập giá sản phẩm...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="">Tình trạng sản phẩm (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" name="new" value="<?php echo e($objProduct->new); ?>" class="form-control" placeholder="Tình trạng sản phẩm (mới, cũ, like new ...)">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Từ khóa</label>
                                        <div class="col-md-10">
                                            <input type="text" name="tags" value="<?php $__currentLoopData = $objTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tags): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($tags->content); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>"  data-role="tagsinput" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="picture">Ảnh cũ</label>
                                        <div class="col-md-10">
                                            <img src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($objProduct->picture); ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="picture">Ảnh sản phẩm</label>
                                        <div class="col-md-10">
                                            <input type="file" name="picture" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chi tiết sản phẩm</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="description" id="editor" rows="5"><?php echo $objProduct->description; ?></textarea>
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
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e($adminUrl); ?>assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo e($adminUrl); ?>assets/css/bootstrap-tagsinput.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e($adminUrl); ?>assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="/public/plugins/ckeditor/ckeditor.js" language="javascript" type="text/javascript"></script>
    <script src="/public/plugins/ckfinder/ckfinder.js" language="javascript" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#create_news').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });


        CKEDITOR.replace('editor', {
            filebrowserBrowseUrl : '/public/plugins/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '/public/plugins/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '/public/plugins/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '/public/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '/public/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '/public/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            height  : '500px',
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.ban.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>