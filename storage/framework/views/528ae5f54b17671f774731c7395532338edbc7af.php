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