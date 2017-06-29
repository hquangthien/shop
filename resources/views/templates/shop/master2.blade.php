@include('templates.shop.header')
@yield('slider')
<section>
    <div class="container">
        <div class="row">
            @include('templates.shop.left_bar')
            @yield('content')
        </div>
    </div>
</section>

@include('templates.shop.footer')