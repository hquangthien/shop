<?php $__currentLoopData = $objCmt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li>
        <div class="col-md-12">
            <ul>
                <li><a href="javascript:void(0)"><i class="fa fa-user"></i><?php echo e($cmt->name_cmt); ?></a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-clock-o"></i><?php echo e($cmt->created_at); ?></a></li>
            </ul>
            <p><?php echo e($cmt->content); ?></p>
            <br />
        </div>
    </li>
    <br />
    <hr />
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>