@extends('templates.ban.master')
@section('title')
    Quản lý email
@endsection
@section('h1')
    Quản lý email
@endsection
@section('content')
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Chi tiết email</h4>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <label class="col-md-2 control-label">Người gửi: </label>
                                    <div class="col-md-10">
                                        {{ $objContact->name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 control-label">Email: </label>
                                    <div class="col-md-10">
                                        {{ $objContact->email }}
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 control-label">Chủ đề: </label>
                                    <div class="col-md-10">
                                        {{ $objContact->subject }}
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 control-label">Nội dung: </label>
                                    <div class="col-md-10">
                                        {{ $objContact->detail }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="form-horizontal" action="{{ route('ban.contact.reply') }}" role="form" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="name" class="form-control" value="{{ $shopName }}">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email: </label>
                                        <div class="col-md-10">
                                            <input type="text" name="email" class="form-control" value="{{ $objContact->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chủ đề: </label>
                                        <div class="col-md-10">
                                            <input type="text" name="subject" class="form-control" value="{{ $shopName }} reply: {{ $objContact->subject }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nội dung: </label>
                                        <div class="col-md-10">
                                            <textarea type="text" rows="5" name="detail" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="submit" name="submit" value="Gửi" class="btn btn-lg btn-primary">
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
