@extends('templates.admin.master')
@section('title')
    Tạo mới quảng cáo
@endsection
@section('h1')
    Tạo mới quảng cáo
@endsection
@section('content')
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Tạo quảng cáo</h4>

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
                                <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('adv.store') }}" role="form" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tên quảng cáo (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" name="name" class="form-control" placeholder="Nhập tên quảng cáo...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Link (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" name="link" class="form-control" placeholder="Nhập link quảng cáo...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Vị trí (*)</label>
                                        <div class="col-md-10">
                                            <select name="position" class="form-control">
                                                <option value="1">header</option>
                                                <option value="2">right_bar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Chọn ảnh (*)</label>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control">
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

