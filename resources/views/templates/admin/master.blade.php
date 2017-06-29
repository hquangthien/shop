
@include('templates.admin.header')

    @include('templates.admin.left_bar')


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        @yield('content')

        @include('templates.admin.footer')

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


@include('templates.admin.right_bar')