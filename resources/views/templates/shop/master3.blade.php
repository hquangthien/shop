@include('templates.shop.header')
@yield('slider')
<section>
    <div class="row">
        @yield('nvarbar')
    </div>
    <div class="container">
        <div class="row">
            @yield('left_bar')
            @yield('content')
        </div>
    </div>
</section>

@include('templates.shop.footer')