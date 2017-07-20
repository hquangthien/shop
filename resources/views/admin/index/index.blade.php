@extends('templates.admin.master')
@section('title')
    Trang thống kê
@endsection
@section('h1')
    Trang thống kê
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Shop</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <span class="badge badge-primary pull-left m-t-20"><i
                                            class="fa  fa-handshake-o fa-2x"></i> </span>
                            </div>

                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"><span id="sum-news"></span>{{ $countShop }}</h2>
                                <p class="text-muted">Shop đăng ký bán hàng</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Đơn hàng</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2">
                                <span class="badge badge-success pull-left m-t-20"><i
                                            class="fa  fa-window-maximize fa-2x"></i> </span>
                                <h2 class="m-b-0"><span id="sum-views"></span>{{ $sumBill }}</h2>
                                <p class="text-muted m-b-25">Tổng số đơn hàng đã hoàn tất</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Đơn hàng</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <span class="badge badge-warning pull-left m-t-20"><i class="fa  fa-window-maximize fa-2x"></i> </span>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"><span id="sum-messages"></span>{{ $sumBillPending }}</h2>
                                <p class="text-muted">Tổng số đơn hàng đang chờ xử lý</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Mặt hàng</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2">
                                <span class="badge badge-success pull-left m-t-20"><i class="zmdi zmdi-collection-item zmdi-hc-2x"></i> </span>
                                <h2 class="m-b-0"><span id="sum-comments"></span>{{ $sumProduct }}</h2>
                                <p class="text-muted m-b-25">Tổng số mặt hàng đang được bán</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Đơn hàng theo ngày</h4>
                        <div id="morris-line-example" style="background-color: #3d6983">
                        </div>
                    </div>
                </div><!-- end col-->
                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Doanh thu theo ngày</h4>
                        <div id="morris-line-example2" style="background-color: #3d6983">
                        </div>
                    </div>
                </div><!-- end col-->
            </div>
            <div class="row card-box">
                <div class="col-md-12">
                    <h4 class="header-title m-t-0">Sản phẩm chờ duyệt (<span id="sum">@if($sumNewPro<10){{ $sumNewPro }}@else 10 @endif</span>/{{ $sumNewPro }} ) </h4>
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
                            @if(sizeof($objNewProduct) == 0)
                                <tr>
                                    <td colspan="8" class="text-center"> Không có sản phẩm nào </td>
                                </tr>
                            @endif
                            @foreach($objNewProduct as $product)
                                <tr id="product{{$product->id}}">
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
                                    <td>
                                        <a href="javascript:void(0)" onclick="changeActive({{ $product->id }})" class="btn btn-success">Duyệt</a>
                                        <a href="javascript:void(0)" onclick="cancelProduct({{ $product->id }})" class="btn btn-danger">Từ chối</a>
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
                                        @if(Auth::user()->role == 1)
                                        <a href="{{ route('admin.product.delete', ['id' => $product->id]) }}"
                                           onclick="return confirm('Bạn có muốn xóa không? ')"
                                           class="on-default remove-row"><i class="fa fa-trash-o"></i>
                                        </a>
                                        @else
                                            No action
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
@section('js')
    <script src="{{ $adminUrl }}assets/plugins/morris/morris.min.js"></script>
    <script src="{{ $adminUrl }}assets/plugins/raphael/raphael-min.js"></script>
    <script type="text/javascript">
        Morris.Line({
            element: 'morris-line-example',
            data: [
                    @if(sizeof($sttBills))
                    @foreach($sttBills as $bill)
                { y: '{{ $bill->date }}', a: '{{ $bill->count_bill }}' },
                @endforeach
                @endif
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Đơn hàng']
        });

        Morris.Line({
            element: 'morris-line-example2',
            data: [
                    @if(sizeof($sttRevenue))
                    @foreach($sttRevenue as $bill)
                { y: '{{ $bill->date }}', a: '{{ $bill->total }}' },
                @endforeach
                @endif
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Danh thu']
        });

        function changeActive(product_id) {
            updateActive('product/active_product', product_id,
                function (data) {
                    $('#sum').text(parseInt($('#sum').text()) - 1);
                    $('#product'+product_id).fadeOut("slow", function () {
                        $('#product'+product_id).remove();
                    });
                },
                function (error) {

                }
            );
        }

        function cancelProduct(product_id) {
            updateActive('product/cancel_product', product_id,
                function (data) {
                    $('#sum').text(parseInt($('#sum').text()) - 1);
                    $('#product'+product_id).fadeOut("slow");
                },
                function (error) {

                }
            );
        }

        function changePin(product_id) {
            updateActive('product/pin_product', product_id,
                function (data) {
                    $('#pin'+product_id).attr('src', '{{ $adminUrl }}assets/images/'+ data.active +'.gif');
                },
                function (error) {

                }
            );
        }
    </script>
@endsection