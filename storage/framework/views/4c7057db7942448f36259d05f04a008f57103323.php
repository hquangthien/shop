<?php echo $__env->make('templates.shop.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('slider'); ?>
<section>
    <div class="container">
        <div class="row">
            <?php echo $__env->make('templates.shop.left_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</section>

<?php echo $__env->make('templates.shop.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>