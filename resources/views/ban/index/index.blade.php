@extends('templates.ban.master')
@section('title')
    Trang thống kê
@endsection
@section('h1')
    Trang thống kê
@endsection
@section('css')
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ $adminUrl }}assets/plugins/morris/morris.css">

@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Sản phẩm</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <span class="badge badge-primary pull-left m-t-20"><i
                                            class="fa  fa-newspaper-o fa-2x"></i> </span>
                            </div>

                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"><span id="sum-news"></span>{{ $sumProduct }}</h2>
                                <p class="text-muted">Sản phẩm đang được đăng bán</p>
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
                                            class="fa fa-window-maximize fa-2x"></i> </span>
                                <h2 class="m-b-0"><span id="sum-views"></span>{{ $sumBill }}</h2>
                                <p class="text-muted m-b-25">Đơn hàng đã hoàn tất</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Tin nhắn góp ý</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <span class="badge badge-danger pull-left m-t-20"><i class="fa  fa-envelope fa-2x"></i> </span>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0"><span id="sum-messages"></span>{{ $sumContact }}</h2>
                                <p class="text-muted">Tổng tin nhắn góp ý</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Bình luận</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2">
                                <span class="badge badge-warining pull-left m-t-20"><i class="fa  fa-comment fa-2x"></i> </span>
                                <h2 class="m-b-0"><span id="sum-comments"></span>{{ $sumComment }}</h2>
                                <p class="text-muted m-b-25">Tổng số bình luận về shop</p>
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
                    <h4 class="header-title m-t-0">Đơn hàng mới (<span id="sum">@if($sumNewBill<10){{ $sumNewBill }}@else 10 @endif</span>/{{ $sumNewBill }} )</h4>
                    <div class="table-responsive">
                        <table class="table m-0 text-center table-bordered">
                            <thead>
                            <tr>
                                <th>Ngày tạo</th>
                                <th>Người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th>Chú thích</th>
                                <th>Tình trạng</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(sizeof($objBill) == 0)
                                <tr>
                                    <td colspan="9" class="text-center">Không có đơn hàng nào</td>
                                </tr>
                            @else
                                @foreach($objBill as $bill)
                                    <tr id="bill_{{ $bill->id }}">
                                        <td>{{ $bill->created_at }}</td>
                                        <td>{{ $bill->name }}</td>
                                        <td>{{ $bill->phone }}</td>
                                        <td>{{ $bill->address }}</td>
                                        <td>{{ number_format($bill->total) }} VND</td>
                                        <td>{{ $bill->name }}</td>
                                        <td>{{ $bill->note }}</td>
                                        <td>
                                            @if($bill->status == 1)
                                                <a href="javascript:void(0)"
                                                   onclick="changeStatus(2, '{{ $bill->id }}')"
                                                   class="btn btn-success"><i class="fa fa-bus"></i> Còn hàng
                                                </a>
                                                <a href="javascript:void(0)"
                                                   onclick="changeStatus(4, '{{ $bill->id }}')"
                                                   class="btn btn-warning"><i class="fa fa-window-close"></i> Hết hàng
                                                </a>
                                            @else
                                                {{ $bill->name_status }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('ban.bill.delete', ['id' => $bill->id]) }}"
                                               onclick="return confirm('Bạn có muốn xóa không? ')"
                                               class="on-default remove-row"><i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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

        function changeStatus(id, bill_id) {
            updateStatus('bill/status_bill', bill_id, id,
                function (data) {
                    $('#sum').text(parseInt($('#sum').text()) - 1);
                    $('#bill_'+bill_id).fadeOut("slow", function () {
                        $('#bill_'+bill_id).remove();
                    });
                },
                function (error) {

                }
            );
        }
    </script>
@endsection