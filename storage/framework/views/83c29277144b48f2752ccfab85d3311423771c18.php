<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                <img src="<?php echo e($adminUrl); ?>assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                <div class="user-status online"><i class="zmdi zmdi-dot-circle"></i></div>
            </div>
            <?php
                $shopModel = new \App\Model\Shop();
                $objCurrentShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
            ?>
            <h5><a href="javascript:void(0)"><?php echo e($objCurrentShop->name); ?></a> </h5>
            <ul class="list-inline">
                <li>
                    <a href="<?php echo e(route('logout')); ?>" class="text-custom">
                        <i class="zmdi zmdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End User -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">Bảng điều khiển</li>

                <li>
                    <a href="<?php echo e(route('ban.index.index')); ?>" class="waves-effect <?php if(Request::segment(2)== ''): ?> active <?php endif; ?>"><i class="zmdi zmdi-view-dashboard"></i> <span> Thống kê </span> </a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo e(route('ban.bill.index')); ?>" class="waves-effect <?php if(Request::segment(2)== 'bill'): ?> active <?php endif; ?>"><i class="fa fa-window-maximize"></i><span> Đơn hàng </span> </a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo e(route('ban.product.index')); ?>" class="waves-effect <?php if(Request::segment(2)== 'product'): ?> active <?php endif; ?>"><i class="zmdi zmdi-collection-item"></i><span> Sản phẩm </span> </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0)" class="waves-effect <?php if(Request::segment(2)== 'comment'): ?> active subdrop <?php endif; ?>"><i class="fa fa-comment"></i><span>Bình luận </span><span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="">
                        <li><a href="<?php echo e(route('ban.comment.product')); ?>">Bình luận về sản phẩm</a></li>
                        <li><a href="<?php echo e(route('ban.comment.shop')); ?>">Bình luận về shop</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="<?php echo e(route('ban.contact.index')); ?>" class="waves-effect <?php if(Request::segment(2)== 'contact'): ?> active <?php endif; ?>"><i class="fa fa-envelope"></i><span>Liên hệ </span></a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo e(route('ban.info.edit')); ?>" class="waves-effect <?php if(Request::segment(2)== 'info'): ?> active <?php endif; ?>"><i class="fa fa-info-circle"></i><span>Thông tin shop </span></a>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->