
<?php echo $__env->make('templates.admin.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('templates.admin.left_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('templates.admin.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


<?php echo $__env->make('templates.admin.right_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>