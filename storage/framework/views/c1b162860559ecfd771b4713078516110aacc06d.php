<?php $__env->startComponent('mail::message'); ?>
<?php $__env->startComponent('mail::panel'); ?>
    <?php echo e($title); ?>

<?php echo $__env->renderComponent(); ?>

<?php echo e($email['detail']); ?>


<?php $__env->startComponent('mail::button', ['url' => $email['links']]); ?>
Chi tiết đơn hàng
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
Hoàng Quang Thiên
<?php echo $__env->renderComponent(); ?>
