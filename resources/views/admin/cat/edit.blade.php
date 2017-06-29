@extends('templates.admin.master')
@section('title')
    Quản lý danh mục sản phẩm
@endsection
@section('h1')
    Quản lý danh mục sản phẩm
@endsection
@section('content')
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Thêm danh mục sản phẩm</h4>

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
                                @if(session('msg'))
                                        <p class="alert alert-warning">{{ session('msg') }}</p>
                                @endif
                                    <form class="form-horizontal" action="{{ route('admin.cat.update', ['id' => $objCat->id]) }}" role="form" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tên danh mục tin (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" name="name" value="{{ $objCat->name }}" class="form-control" placeholder="Nhập danh mục tin...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Danh mục cha</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="parrent_cat">
                                                <option value="{{ null }}">-- Không có --</option>
                                                @foreach($objSuperCat as $superCat)
                                                    <option
                                                            @if($objCat->parrent_cat == $superCat->id)
                                                            selected
                                                            @endif
                                                            value="{{ $superCat->id }}">{{ $superCat->name }}</option>
                                                    @if(isset($objSubCat1[$superCat->id]))
                                                        @foreach($objSubCat1[$superCat->id] as $subCat1)
                                                            <option
                                                                    @if($objCat->parrent_cat == $subCat1->id)
                                                                    selected
                                                                    @endif
                                                                    value="{{ $subCat1->id }}"> + {{ $subCat1->name }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
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
