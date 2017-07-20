@extends('templates.admin.master')
@section('title')
    Trang quản lý nhân viên
@endsection
@section('h1')
    Trang quản lý nhân viên
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách người dùng</h4>
                        @if(session('msg'))
                            <p class="alert alert-success"> {{ session('msg') }} </p>
                        @endif
                        @if(session('msg_dlt'))
                            <p class="alert alert-danger"> {{ session('msg_dlt') }} </p>
                        @endif
                        @if(Auth::user()->role == 1)
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Tạo mới</a>
                        @endif
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Quyền</th>
                                    @if(Auth::user()->role == 1)
                                        <th>Tình trạng</th>
                                    @endif
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objUser as $userItem)
                                <tr>
                                    <th>{{ $userItem->id }}</th>
                                    <td>{{ $userItem->username }}</td>
                                    <td>{{ $userItem->fullname }}</td>
                                    <td>{{ $userItem->email }}</td>
                                    <td>{{ $userItem->name_role }}</td>
                                    @if(Auth::user()->role == 1)
                                    <td>
                                        @if($userItem->role == 1)
                                            Không thay đổi
                                        @else
                                            <a href="javascript:void(0)" onclick="changeActive({{ $userItem->id }})">
                                            @if($userItem->active_user == 1)
                                                    <img id="user{{ $userItem->id }}" src="{{ $adminUrl }}assets/images/1.gif">
                                            @else
                                                <img id="user{{ $userItem->id }}" src="{{ $adminUrl }}assets/images/0.gif">
                                            @endif
                                        @endif
                                        </a>
                                    </td>
                                    @endif
                                    <td class="actions">
                                        @if(Auth::user()->role == 1 and $userItem->role == 1)
                                            <a href="{{ route('admin.user.edit', ['id' => $userItem->id]) }}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                        @else
                                            @if(Auth::user()->role == 1 OR Auth::user()->id == $userItem->id)
                                            <a href="{{ route('admin.user.edit', ['id' => $userItem->id]) }}" class="on-default edit-row"><i class="fa fa-pencil"></i></a> ||
                                            <a href="{{ route('admin.user.destroy', ['id' => $userItem->id]) }}" onclick="return confirm('  Bạn có chắc chắn xóa người dùng này?')" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                            @else
                                                No action
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $objUser->links() }}
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
            updateActive('user/active_user', id,
                function (data) {
                    $('#user'+id).attr('src', '{{ $adminUrl }}assets/images/'+ data.active +'.gif');
                },
                function (error) {
                    console.log(error);
                }
            );
        }
    </script>
@endsection
