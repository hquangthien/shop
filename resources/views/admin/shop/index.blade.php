@extends('templates.admin.master')
@section('title')
    Quản lý shop
@endsection
@section('h1')
    Quản lý shop
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách shop</h4>
                        @if(session('msg'))
                            <p class="alert alert-success"> {{ session('msg') }} </p>
                        @endif
                        @if(session('msg_dlt'))
                            <p class="alert alert-danger"> {{ session('msg_dlt') }} </p>
                        @endif
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tài khoản sở hữu</th>
                                    <th>Tên shop</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Tình trạng</th>
                                    <th>Ngày mở</th>
                                    <th>Hoạt động lần cuối</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objShop as $shop)
                                    <tr>
                                        <td>{{ $shop->id }}</td>
                                        <td>{{ $shop->username }}</td>
                                        <td>{{ $shop->name }}</td>
                                        <td>{{ $shop->address }}</td>
                                        <td>{{ $shop->email }}</td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="changeActive({{ $shop->id }})">
                                                @if($shop->active_shop == 1)
                                                    <img id="cmt{{ $shop->id }}" src="{{ $adminUrl }}assets/images/1.gif">
                                                @else
                                                    <img id="cmt{{ $shop->id }}" src="{{ $adminUrl }}assets/images/0.gif">
                                                @endif
                                            </a>
                                        </td>
                                        <td>{{ $shop->created_at }}</td>
                                        <td>
                                            @if($shop->last_activity != null)
                                                {{ $shop->last_activity }}
                                            @else
                                                Shop này chưa hoạt động
                                            @endif
                                        </td>
                                        <td>
                                            @if(Auth::user()->role == 1)
                                            <a href="{{ route('admin.shop.delete', ['id' => $shop->id]) }}" onclick="return confirm('Bạn có chắc chắn xóa shop này?')" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                @else
                                                No action
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $objShop->links() }}
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
        function changeActive(id) {
            updateActive('shop/active_shop', id,
                function (data) {
                    $('#cmt'+id).attr('src', '{{ $adminUrl }}assets/images/'+ data.active +'.gif');
                },
                function (error) {

                }
            );
        }
    </script>
@endsection
