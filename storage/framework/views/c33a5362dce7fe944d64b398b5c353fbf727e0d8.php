<?php $__env->startSection('title'); ?>
    <?php echo e($objShop->name); ?> | Đánh giá phản hồi
<?php $__env->stopSection(); ?>
<?php $__env->startSection('nvarbar'); ?>
    <div class="container">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo e(route('subshop.index', ['slug' => str_slug($objShop->name), 'id' => $objShop->id])); ?>">Trang
                    chủ shop <?php echo e($objShop->name); ?></a></li>
            <li class="active"><a
                        href="<?php echo e(route('subshop.feedback', ['slug' => str_slug($objShop->name), 'id' => $objShop->id])); ?>">Đánh
                    giá - Phản hồi</a></li>
            <li><a href="<?php echo e(route('subshop.contact', ['slug' => str_slug($objShop->name), 'id' => $objShop->id])); ?>">Liên
                    hệ shop <?php echo e($objShop->name); ?></a></li>
        </ul>
    </div>
    <br/><br/><br/><br/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left_bar'); ?>
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Danh mục</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                <?php $__currentLoopData = $objSuperCatOfShop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $superCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="<?php echo e(route('subshop.cat', ['slug' => str_slug($objShop->name), 'id' => $objShop->id, 'cat_name' => str_slug($superCat->name), 'cat_id' => $superCat->id])); ?>">
                                    <?php echo e($superCat->name); ?>

                                </a>
                                <?php if(isset($objSubCatOfShop[$superCat->id])): ?>
                                    <a data-toggle="collapse" href="#<?php echo e(str_slug($superCat->name)); ?>">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    </a>
                                <?php endif; ?>

                            </h4>
                        </div>
                        <?php if(isset($objSubCatOfShop[$superCat->id])): ?>
                            <div id="<?php echo e(str_slug($superCat->name)); ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <?php $__currentLoopData = $objSubCatOfShop[$superCat->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(route('subshop.cat', ['slug' => str_slug($objShop->name), 'id' => $objShop->id, 'cat_name' => str_slug($subCat1->name), 'cat_id' => $subCat1->id])); ?>">
                                                    <?php echo e($subCat1->name); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div><!--/category-products-->

            <div class="shipping text-center"><!--shipping-->
                <img src="<?php echo e(Storage::url('app/files/')); ?><?php echo e($objRightAdv[0]->image); ?>" alt="">
            </div><!--/shipping-->

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-9 padding-right">
        <h2 class="title text-center">Bình luận đánh giá về cửa hàng "<?php echo e($objShop->name); ?>"</h2>
        <div class="col-md-12" id="comment-box">
                <ul id="list_cmt">
                    <?php if(sizeof($objCmt) == 0): ?>
                        <p class="alert alert-warning">Chưa có bình luận, đánh giá về shop này</p>
                    <?php else: ?>
                    <?php $__currentLoopData = $objCmt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a style="color: #B2B2B2" href="javascript:void(0)">
                                            <i class="fa fa-user"></i> <?php echo e($cmt->name_cmt); ?>

                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a style="color: #B2B2B2" href="javascript:void(0)">
                                            <i class="fa fa-clock-o"></i> <?php echo e($cmt->created_at); ?></a>
                                    </div>
                                </div>
                                <br/>
                                <p><?php echo e($cmt->content); ?></p>
                                <hr/>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>

        </div>
        <div class="col-md-12">
            <p><b>Viết bình luận của bạn</b></p>
            <form id="cmtBox" action="javascript:void(0)">
                <input type="hidden" class="form-control" id="shop_id" value="<?php echo e($objShop->id); ?>">
                <input type="hidden" class="form-control" id="user_id"
                       value="<?php if(Auth::check()): ?><?php echo e(Auth::user()->id); ?><?php endif; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" required id="name"
                               value="<?php if(Auth::check()): ?><?php echo e(Auth::user()->fullname); ?><?php endif; ?>" name="name"
                               placeholder="Nhập tên của bạn...">
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" required id="email"
                               value="<?php if(Auth::check()): ?><?php echo e(Auth::user()->email); ?><?php endif; ?>"
                               placeholder="Nhập địa chỉ email...">
                    </div>
                </div>
                <br>
                <textarea name="content" class="form-control" rows="6" required id="content"
                          placeholder="Nhập bình luận..."></textarea>
                <br>
                <button type="submit" onclick="comment()" class="btn btn-default pull-right">
                    Bình luận
                </button>
            </form>
        </div>
        <hr/>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
        function comment() {
            var name = ($('#name').val());
            var shop_id = ($('#shop_id').val());
            var email = ($('#email').val());
            var content = ($('#content').val());
            var user_id = ($('#user_id').val());
            if (name != '' && email != '' && content != '') {
                data = {
                    name_cmt: name,
                    shop_id: shop_id,
                    email: email,
                    content: content,
                    user_id: user_id
                };
                commentPublic('cua-hang/<?php echo e(str_slug($objShop->name)); ?>-<?php echo e($objShop->id); ?>/comment', data,
                    function (data) {
                        $('#content').val('');
                        $('#list_cmt').empty();
                        $('#list_cmt').append(data);
                    },
                    function (error) {
                        alert('Có lỗi');
                    }
                );
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.shop.master3', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>