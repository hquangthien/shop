<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                <img src="{{ $adminUrl }}assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                <div class="user-status online"><i class="zmdi zmdi-dot-circle"></i></div>
            </div>
            <h5><a href="javascript:void(0)">{{ Auth::user()->username }}</a> </h5>
            <ul class="list-inline">
                <li>
                    <a href="{{ route('logout') }}" class="text-custom">
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
                    <a href="{{ route('admin.index.index') }}" class="waves-effect @if(Request::segment(2)== '') active @endif"><i class="zmdi zmdi-view-dashboard"></i> <span> Thống kê </span> </a>
                </li>

                <li>
                    <a href="{{ route('admin.user.index') }}" class="waves-effect @if(Request::segment(2)== 'user') active @endif"><i class="fa fa-user-circle"></i> <span> Ban quản trị </span> </a>
                </li>

                <li>
                    <a href="{{ route('admin.guest.index') }}" class="waves-effect @if(Request::segment(2)== 'guest') active @endif"><i class="fa fa-user-o"></i> <span> Thành viên </span> </a>
                </li>

                <li>
                    <a href="{{ route('admin.shop.index') }}" class="waves-effect @if(Request::segment(2)== 'shop') active @endif"><i class="fa fa-handshake-o"></i> <span> Shop hợp tác </span> </a>
                </li>

                <li class="has_sub">
                    <a href="{{ route('admin.bill.index') }}" class="waves-effect @if(Request::segment(2)== 'bill') active @endif"><i class="fa fa-window-maximize"></i><span> Đơn hàng </span> </a>
                </li>

                <li class="has_sub">
                    <a href="{{ route('admin.cat.index') }}" class="waves-effect @if(Request::segment(2)== 'cat') active @endif"><i class="zmdi zmdi-view-list"></i> <span> Danh mục sản phẩm </span> </a>
                </li>

                <li class="has_sub">
                    <a href="{{ route('admin.product.index') }}" class="waves-effect @if(Request::segment(2)== 'product') active @endif"><i class="zmdi zmdi-collection-item"></i><span> Sản phẩm </span> </a>
                </li>

                <li class="has_sub">
                    <a href="{{ route('admin.adv.index') }}" class="waves-effect @if(Request::segment(2)== 'adv') active @endif"><i class="zmdi zmdi-layers"></i><span>Quảng cáo </span></a>
                </li>

                <li class="has_sub">
                    <a href="{{ route('admin.contact.index') }}" class="waves-effect @if(Request::segment(2)== 'contact') active @endif"><i class="fa fa-envelope"></i><span>Liên hệ </span></a>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->