@extends('templates.shop.master')
@section('title')
    Eshoper | Liên hệ
@endsection
@section('content')

    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Hướng dẫn đăng ký shop</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="detail-content">
                        <!-- Either there are no banners, they are disabled or none qualified for this location! -->
                        <p style="text-align: justify;">
                            <a href="{{ route('shop.index.index') }}">Bán hàng online</a> không chỉ có website hay bán hàng trên Facebook, các chủ shop hiện rất nhạy bén trong việc đa dạng hóa các kênh bán hàng và tiếp cận được thật nhiều khách hàng mới. Trong đó,
                            <strong>
                                <a href="{{ route('shop.index.index') }}">bán hàng trên ThienShop</a>
                            </strong>&nbsp;là một trong những xu hướng kinh doanh được nhiều chủ shop lựa chọn. Hiện nay, ThienShop là sàn thương mại điện tử có số lượng người mua lớn, sản phẩm đa dạng, hình thức vận chuyển hợp lý…nên thu hút được sự chú ý của nhiều người bán hàng. Cùng theo dõi những thông tin sau đây để nắm được cách tạo tài khoản để bắt đầu
                            <em>bán hàng trên ThienShop</em>.
                        </p>
                        <p style="text-align: justify;">Để bắt đầu bán hàng trên ThienShop, bạn cần có 1 tài khoản ThienShop.&nbsp;Bạn truy cập trang
                            <a href="{{ route('register') }}" target="_blank" rel="nofollow">https://thienshop.000webhostapp.com/dang-ky</a>&nbsp;để đăng ký tài khoản, điền các thông tin cần thiết. Email sẽ là email bạn cập thông tin đơn hàng, quản lý gian hàng trên ThienShop.
                        </p>
                        <p style="text-align: center;">
                            <img class="aligncenter wp-image-38368" title="Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop" src="{{ $publicUrl }}images/guide/register.png" alt="Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop" width="100%">
                        </p>
                        <p style="text-align: center;">
                            <em>Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop</em>
                        </p>
                        <p style="text-align: justify;">Sau khi điền xong thông tin, bạn nhấn "Đăng ký". Sau đó kiểm tra email để lấy mã xác nhận và điền vào ô sau để hoàn tất đăng ký tài khoản</p>
                        <p style="text-align: center;">
                            <img class="aligncenter wp-image-38368" title="Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop" src="{{ $publicUrl }}images/guide/confirm.png" alt="Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop" width="100%">
                        </p>
                        <p style="text-align: center;">
                            <em>Xác nhận email để hoàn tất đăng ký tài khoản</em>
                        </p>
                        <p style="text-align: justify;">Sau khi đăng ký thành công, tiến hành đăng nhập để mở shop.</p>
                        <p style="text-align: center;">
                            <img class="aligncenter wp-image-38368" title="Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop" src="{{ $publicUrl }}images/guide/login.png" alt="Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop" width="100%">
                        </p>
                        <p style="text-align: center;">
                            <em>Đăng nhập bằng tài khoản vừa đăng ký</em>
                        </p>
                        <p style="text-align: justify;">Tại trang chủ, nhấn vào "Mở shop" để tiến hành đăng ký shop.</p>
                        <p style="text-align: center;">
                            <img class="aligncenter wp-image-38368" title="Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop" src="{{ $publicUrl }}images/guide/home.png" alt="Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop" width="100%">
                        </p>
                        <p style="text-align: center;">
                            <em>Nhấn "Mở shop" để tiến hành đăng ký shop</em>
                        </p>
                        <p style="text-align: justify;">Tại trang đăng ký shop, nhập các thông tin cần thiết và nhấn "Đăng ký" để hoàn tất mở shop trên ThienShop</p>
                        <p style="text-align: center;">
                            <img class="aligncenter wp-image-38368" title="Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop" src="{{ $publicUrl }}images/guide/shop_register.png" alt="Hướng dẫn cách tạo tài khoản để bán hàng trên ThienShop" width="100%">
                        </p>
                        <p style="text-align: center;">
                            <em>Nhập thông tin cần thiết và nhấn "Đăng ký" để hoàn tất</em>
                        </p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection