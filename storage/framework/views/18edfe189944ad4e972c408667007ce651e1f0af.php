<!-- Right Sidebar -->
<!-- /Right-bar -->

</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="<?php echo e($adminUrl); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/detect.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/fastclick.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/waves.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/function_custom.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/jquery.babypaunch.spinner.min.js"></script>
<script>
    $(document).ready(function () {
        $("#spin").spinner({
            color: "black"
            , background: "rgba(255,255,255,0.5)"
            , html: "<i class='fa fa-repeat' style='color: gray;'></i>"
            , spin: true
        });
    });
    $(document).ajaxStart(function () {
        $('#spin').show();
    });
    $(document).ajaxSuccess(function () {
        $('#spin').hide();
        showAlertSuccess();
    });
    $(document).ajaxError(function () {
        showAlertDanger();
        $('#spin').hide();
    });
</script>
<?php echo $__env->yieldContent('js'); ?>
<!-- App js -->
<script src="<?php echo e($adminUrl); ?>assets/js/jquery.core.js"></script>
<script src="<?php echo e($adminUrl); ?>assets/js/jquery.app.js"></script>

</body>
</html>