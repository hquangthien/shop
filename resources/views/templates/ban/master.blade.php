
@include('templates.ban.header')

    @include('templates.ban.left_bar')


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        @yield('content')

        @include('templates.ban.footer')

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


@include('templates.ban.right_bar')