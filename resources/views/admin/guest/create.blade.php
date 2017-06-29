@extends('templates.admin.master')
@section('title')
    Quản lý thành viên
@endsection
@section('h1')
    Quản lý thành viên
@endsection
@section('content')
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Thêm người dùng</h4>

                        <div class="row">
                            <div class="col-lg-12">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="form-horizontal" action="{{ route('user.store') }}" role="form" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tên tài khoản (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" name="username" class="form-control" placeholder="Nhập tài khoản...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Quyền (*)</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="role">
                                                <option>-- Chọn quyền --</option>
                                                @foreach($objRoles as $roleItem)
                                                    <option value="{{ $roleItem->id }}">{{ $roleItem->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Email (*)</label>
                                        <div class="col-md-10">
                                            <input type="email" name="email" class="form-control" placeholder="Nhập email...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Nhập lại email (*)</label>
                                        <div class="col-md-10">
                                            <input type="email" name="confirm-email" class="form-control" placeholder="Nhập lại email...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Nhập họ tên (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" name="fullname" class="form-control" placeholder="Nhập họ tên...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Mật khẩu (*)</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="password" value="" placeholder="Nhập mật khẩu...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nhập lại mật khẩu (*)</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="confirm-password" value="" placeholder="Nhập lại mật khẩu...">
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="submit" name="submit" value="Thêm mới" class="btn btn-lg btn-primary">
                                        <input type="reset" name="reset" value="Nhập lại" class="btn btn-lg btn-default">
                                    </div>
                                </form>
                            </div><!-- end col -->

                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
