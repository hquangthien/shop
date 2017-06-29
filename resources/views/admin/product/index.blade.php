@extends('templates.admin.master')
@section('title')
    Trang quản lý sản phẩm
@endsection
@section('h1')
    Trang quản lý sản phẩm
@endsection
@section('content')
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách sản phẩm</h4>
                        @if(session('msg'))
                            <p class="alert alert-success"> {{ session('msg') }} </p>
                        @endif
                        <form action="{{ route('admin.product.filter') }}" method="GET">
                            <div class="row card-box">
                                <div class="col-md-2">
                                    @if(isset($date_filter))
                                        <input type="date" name="created_at" class="form-control border-input"
                                               value="{{ $date_filter }}" placeholder="Ngày tạo">
                                    @else
                                        <input type="date" name="created_at" class="form-control border-input"
                                               placeholder="Ngày tạo">
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <select name="status" class="form-control">
                                        <option value="{{ null }}">-- Tình trạng --</option>
                                        <option @if(isset($status_filter))
                                                @if($status_filter == 2)
                                                selected
                                                @endif
                                                @endif
                                                value="2">Đang chờ duyệt</option>
                                        <option @if(isset($status_filter))
                                                    @if($status_filter == 0)
                                                    selected
                                                    @endif
                                                @endif
                                                    value="0">Vô hiệu</option>
                                        <option
                                                @if(isset($status_filter))
                                                    @if($status_filter == 1)
                                                    selected
                                                    @endif
                                                @endif
                                                value="1">Đang đăng bán</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="shop" class="form-control">
                                        <option value="{{ null }}">-- Shop --</option>
                                        @if(isset($shop_filter))
                                            @foreach($objShop as $shop)
                                                <option value="{{ $shop->id }}"
                                                        @if($shop->id == $shop_filter)
                                                        selected
                                                        @endif
                                                >{{ $shop->name }}</option>
                                            @endforeach
                                        @else
                                            @foreach($objShop as $shop)
                                                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-primary" value="Lọc">
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ngày đăng</th>
                                    <th>TT sản phẩm</th>
                                    <th>Shop đăng bán</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th>Ghim top</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objProduct as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>
                                            <p>
                                                <a href="{{ route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id]) }}">{{ $product->name }}</a>
                                            </p>
                                            <img width="150px" src="{{ Storage::url('app/files/') }}{{ $product->picture }}" alt="">
                                        </td>
                                        <td>{{ $product->name_shop }}</td>
                                        <td>{{ number_format($product->price) }} VND</td>
                                        <td id="cancel{{ $product->id }}">
                                            @if($product->active_product == 2)
                                                <a href="javascript:void(0)" onclick="changeActive({{ $product->id }})" class="btn btn-success">Duyệt</a>
                                                <a href="javascript:void(0)" onclick="cancelProduct({{ $product->id }})" class="btn btn-danger">Từ chối</a>
                                            @else
                                            <a id="product{{ $product->id }}" href="javascript:void(0)" onclick="changeActive({{ $product->id }})">
                                                @if($product->active_product == 1)
                                                    <img id="cmt{{ $product->id }}" src="{{ $adminUrl }}assets/images/1.gif" />
                                                @else
                                                    <img id="cmt{{ $product->id }}" src="{{ $adminUrl }}assets/images/0.gif">
                                                @endif
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="changePin({{ $product->id }})">
                                                @if($product->pin == 1)
                                                    <img id="pin{{ $product->id }}" src="{{ $adminUrl }}assets/images/1.gif" />
                                                @else
                                                    <img id="pin{{ $product->id }}" src="{{ $adminUrl }}assets/images/0.gif">
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.product.delete', ['id' => $product->id]) }}"
                                               onclick="return confirm('Bạn có muốn xóa không? ')"
                                               class="on-default remove-row"><i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $objProduct->links() }}
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
@section('js')
    <script type="text/javascript">
        function changeActive(product_id) {
            updateActive('product/active_product', product_id,
                function (data) {
                    $('#cancel'+product_id).html(
                        '<a id="product'+ product_id +'" href="javascript:void(0)" onclick="changeActive('+ product_id +')">'+
                        '<img id="cmt'+ product_id +'" src="{{ $adminUrl }}assets/images/'+ data.active +'.gif">'+
                        '</a>'
                    );
                    alert('Cập nhật thành công');
                },
                function (error) {
                    alert('Cập nhật thất bại');
                }
            );
        }

        function changePin(product_id) {
            updateActive('product/pin_product', product_id,
                function (data) {
                    $('#pin'+product_id).attr('src', '{{ $adminUrl }}assets/images/'+ data.active +'.gif');
                    alert('Cập nhật thành công');
                },
                function (error) {
                    alert('Cập nhật thất bại');
                }
            );
        }

        function cancelProduct(product_id) {
            updateActive('product/cancel_product', product_id,
                function (data) {
                    $('#cancel'+product_id).html(
                        '<a id="product'+ product_id +'" href="javascript:void(0)" onclick="changeActive('+ product_id +')">'+
                        '<img id="cmt'+ product_id +'" src="{{ $adminUrl }}assets/images/'+ data.active +'.gif">'+
                        '</a>'
                    );
                    alert('Cập nhật thành công');
                },
                function (error) {
                    alert('Cập nhật thất bại');
                }
            );
        }
    </script>
@endsection
