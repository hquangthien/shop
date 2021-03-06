@extends('templates.ban.master')
@section('title')
    Trang quản lý tin tức
@endsection
@section('h1')
    Trang quản lý tin tức
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
                        @if(session('msg_dlt'))
                            <p class="alert alert-danger"> {{ session('msg_dlt') }} </p>
                        @endif
                        <form action="{{ route('ban.product.filter') }}" method="GET">
                            <div class="row card-box">
                                <div class="col-md-4">
                                    @if(isset($name_filter))
                                        <input type="text" name="name_filter" class="form-control border-input"
                                               value="{{ $name_filter }}" placeholder="Tên sản phẩm...">
                                    @else
                                        <input type="text" name="name_filter" class="form-control border-input"
                                               placeholder="Tên sản phẩm...">
                                    @endif
                                </div>
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
                                        <option value="{{ null }}">-- Trạng thái --</option>
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
                                    <input type="submit" class="btn btn-primary" value="Lọc">
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('ban.product.create') }}" class="btn btn-primary">Tạo mới</a>
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ngày đăng</th>
                                    <th>TT sản phẩm</th>
                                    <th>Giá gốc</th>
                                    <th>Giảm giá</th>
                                    <th>Lượt mua</th>
                                    <th>Hình thức</th>
                                    <th>Tình trạng</th>
                                    <th>Trạng thái</th>
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
                                    <td>{{ number_format($product->price) }} VND</td>
                                    <td width="100px">
                                        <select class="form-control chosen-select" id="promotion_price"
                                                    onchange="changePromotion($(this).val(), '{{ $product->id }}')" tabindex="2">
                                            @for($i = 0; $i <= 100; $i = $i + 5)
                                                @if($i == $product->promotion_price)
                                                    <option selected value="{{ $i }}">{{ $i }} %</option>
                                                @else
                                                    <option value="{{ $i }}">{{ $i }} %</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </td>
                                    <td>{{ $product->count_sales }}</td>
                                    <td>{{ $product->new }}</td>
                                    <td width="150px">
                                        <select class="form-control chosen-select" id="promotion_price"
                                                onchange="changeStatus($(this).val(), '{{ $product->id }}')" tabindex="2">
                                                @if($product->status == 1)
                                                    <option selected value="1">Còn hàng</option>
                                                    <option value="0">Hết hàng</option>
                                                @else
                                                <option value="1">Còn hàng</option>
                                                <option selected value="0">Hết hàng</option>
                                                @endif
                                        </select>
                                    </td>
                                    <td>
                                        @if($product->active_product == 1)
                                            <p class="btn btn-success">Đã duyệt</p>
                                        @elseif($product->active_product == 0)
                                            <p class="btn btn-danger">Từ chối</p>
                                        @elseif($product->active_product == 2)
                                            <p class="btn btn-primary">Chờ duyệt</p>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('ban.product.edit', ['id' => $product->id]) }}" class="on-default edit-row"><i class="fa fa-pencil"></i></a> ||
                                        <a href="{{ route('ban.product.delete', ['id' => $product->id]) }}"
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
        function changePromotion(promotion, product_id) {
            updateStatus('product/promotion_product', product_id, promotion,
                function (data) {
                },
                function (error) {
                }
            );
        }

        function changeStatus(status, product_id) {
            updateStatus('product/status_product', product_id, status,
                function (data) {
                },
                function (error) {

                }
            );
        }
    </script>
@endsection
