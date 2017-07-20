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

                        <h4 class="header-title m-t-0 m-b-30">Thêm tin tức</h4>

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
                                <form id="create_news" class="form-horizontal" action="<?php echo e(route('admin.product.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tiêu đề tin (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề tin...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Danh mục cha (*)</label>
                                        <div class="col-md-10">
                                            <select name="cat_parrent" id="cat_parrent" onchange="getSubCat($(this).val())" class="form-control">
                                                <option>-- Chọn danh mục tin cha --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Danh mục con (*)</label>
                                        <div class="col-md-10">
                                            <select name="cat_id" id="cat_id" class="form-control">
                                                <option>-- Chọn danh mục tin con --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Mô tả tin (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" name="preview" class="form-control" placeholder="Nhập mô tả tin...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Từ khóa</label>
                                        <div class="col-md-10">
                                            <input type="text" name="tags" value="" data-role="tagsinput" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Ảnh bìa</label>
                                        <div class="col-md-10">
                                            <input type="file" name="picture" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chi tiết tin</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="detail" id="editor" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="submit" name="submit" value="Thêm mới" class="btn btn-lg btn-primary">
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

        function getSubCat(id) {
            updateActive('news/get_sub_cat', id,
                function (data) {
                    $('#cat_id').empty();
                    data = JSON.parse(data);
                    if (data.length == 0){
                        $('#cat_id').append(
                            '<option value="">Không có danh mục tin con nào</option>'
                        );
                    } else{
                        $('#cat_id').append(
                            '<option value="">-- Chọn danh mục con --</option>'
                        );
                        var i = 0;
                        for(i; i<= data.length; i++){
                            $('#cat_id').append(
                                '<option value="'+ data[i].id +'">'+ data[i].name +'</option>'
                            );
                        }
                    }

                },
                function (error) {
                    console.log(error);
                }
            );
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>