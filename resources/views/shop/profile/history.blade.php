@extends('templates.shop.master2')
@section('title')
    {{ Auth::user()->fullname }} | Lịch sử mua hàng
@endsection
@section('content')
    <div class="col-sm-8">
        <div id="contact-page" class="container">
            <div class="bg">
                <div class="row">
                    <div class="col-sm-9">
                        @if(sizeof($objBill) == 0)
                            <p class="alert alert-warning text-center"> Bạn chưa có đơn hàng nào </p>
                        @else
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-box">
                                        <h4 class="header-title m-t-0 m-b-30">Danh sách đơn hàng</h4>
                                        <div class="table-responsive">
                                            <table class="table m-0 text-center table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Ngày tạo</th>
                                                    <th>Người nhận</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Tổng tiền</th>
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
                                                            <td>{{ $bill->name }}</td>
                                                            <td>{{ $bill->phone }}</td>
                                                            <td>{{ $bill->address }}</td>
                                                            <td>{{ number_format($bill->total) }} VND</td>
                                                            <td>{{ $bill->note }}</td>
                                                            <td>{{ $bill->name_status }}</td>
                                                            <td>
                                                                <a href="javascript:void(0)" type="button" onclick="getItem({{ $bill->id }})" class="edit-modal mrg" data-toggle="modal"><i class="fa fa-eye"></i></a>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        function getItem(id) {
            showItemPublic('chi-tiet-hoa-don-user', id,
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
