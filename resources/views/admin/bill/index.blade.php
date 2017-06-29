@extends('templates.admin.master')
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
                        <h4 class="header-title m-t-0 m-b-30">Danh sách đơn hàng</h4>
                        @if(session('msg'))
                            <p class="alert alert-success"> {{ session('msg') }} </p>
                        @endif
                        <form action="{{ route('admin.bill.filter') }}" method="GET">
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
                                        @if(isset($status_filter))
                                            @foreach($objStatus as $status)
                                                <option value="{{ $status->id }}"
                                                        @if($status->id == $status_filter)
                                                        selected
                                                        @endif
                                                >{{ $status->name_status }}</option>
                                            @endforeach
                                        @else
                                            @foreach($objStatus as $status)
                                                <option value="{{ $status->id }}">{{ $status->name_status }}</option>
                                            @endforeach
                                        @endif
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
                                    <th>Ngày tạo</th>
                                    <th>Cửa hàng</th>
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
                                    <tr>
                                        <td>{{ $bill->created_at }}</td>
                                        <td>{{ $bill->shop_name }}</td>
                                        <td>{{ $bill->name }}</td>
                                        <td>{{ $bill->phone }}</td>
                                        <td>{{ $bill->address }}</td>
                                        <td>{{ number_format($bill->total) }} VND</td>
                                        <td>{{ $bill->name }}</td>
                                        <td>{{ $bill->note }}</td>
                                        <td>
                                            @if($bill->status == 1)
                                                <p class="btn btn-info">{{ $bill->name_status }}</p>
                                            @else
                                            <select id="status" onchange="changeStatus($(this).val(), '{{ $bill->id }}')" class="form-control">
                                                @foreach($objStatus as $status)
                                                    <option value="{{ $status->id }}"
                                                            @if($status->id == $bill->status)
                                                            selected
                                                            @endif
                                                    >{{ $status->name_status }}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" type="button" onclick="getItem('{{ $bill->id }}', '{{ $bill->shop_id }}')" class="edit-modal mrg" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            @if(Auth::user()->role == 1)
                                            ||
                                            <a href="{{ route('admin.bill.delete', ['id' => $bill->id]) }}"
                                               onclick="return confirm('Bạn có muốn xóa không? ')"
                                               class="on-default remove-row"><i class="fa fa-trash-o"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $objBill->links() }}
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
    <div id="detail-bill-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Chi tiết hóa đơn</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" onclick="alert('comming soon!')" class="btn btn-primary btn-rounded w-lg waves-effect waves-light m-b-20 m-t-30" data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200" data-overlaycolor="#36404a"><i class="fa fa-print"></i>In</a>
                    <a href="javascript:void(0)" class="btn btn-default btn-rounded w-lg waves-effect waves-light m-b-20 m-t-30" data-dismiss="modal" data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200" data-overlaycolor="#36404a">Đóng</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        function changeStatus(id, bill_id) {
            updateStatusAdmin('bill/status_bill', bill_id, id,
                function (data) {
                    alert('Cập nhật thành công!');
                    /*location.reload();*/
                },
                function (error) {
                    alert('Có lỗi khi cập nhật');
                }
            );
        }

        function getItem(id, shop_id) {
            showItemAdmin('bill', id, shop_id,
                function (data) {
                    $('.modal-body').html(data);
                    $('#detail-bill-modal').modal('toggle');
                },
                function (error) {
                    alert('Có lỗi khi cập nhật');
                }
            );
        }
    </script>
@endsection
