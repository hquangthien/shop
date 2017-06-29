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
                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách danh mục sản phẩm</h4>
                        @if(session('msg'))
                            <p class="alert alert-success"> {{ session('msg') }} </p>
                        @endif
                        @if(Auth::user()->role == 1)
                            <a href="{{ route('admin.cat.create') }}" class="btn btn-primary">Tạo mới</a>
                        @endif
                        <div class="table-responsive">
                            <table class="table m-0 table-bordered">
                                <thead>
                                <tr>
                                    <th>Tên danh mục</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objSuperCat as  $superCat)
                                    <tr>
                                        <td>{{ $superCat->name }}</td>
                                        <td class="actions text-center">
                                            @if(Auth::user()->role == 1)
                                                <a href="{{ route('admin.cat.edit', ['id' => $superCat->id]) }}" class="on-default edit-row"><i class="fa fa-pencil"></i></a> ||
                                                <a href="{{ route('admin.cat.delete', ['id' => $superCat->id]) }}"
                                                   onclick="return confirm('Bạn có muốn xóa danh mục này không? ')"
                                                   class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                            @else
                                                No action
                                            @endif
                                        </td>
                                    </tr>
                                    @if(isset($objSubCat1[$superCat->id]))
                                        @foreach($objSubCat1[$superCat->id] as $subCat1)
                                            <tr>
                                                <td> &nbsp;&nbsp; - {{ $subCat1->name }}</td>
                                                <td class="actions text-center">
                                                    @if(Auth::user()->role == 1)
                                                        <a href="{{ route('admin.cat.edit', ['id' => $subCat1->id]) }}" class="on-default edit-row"><i class="fa fa-pencil"></i></a> ||
                                                        <a href="{{ route('admin.cat.delete', ['id' => $subCat1->id]) }}"
                                                           onclick="return confirm('Bạn có muốn xóa không? ')"
                                                           class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                    @else
                                                        No action
                                                    @endif
                                                </td>
                                            </tr>
                                            @if(isset($objSubCat2[$subCat1->id]))
                                                @foreach($objSubCat2[$subCat1->id] as $subCat2)
                                                    <tr>
                                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="dripicons-arrow-thin-right"></i> {{ $subCat2->name }}</td>
                                                        <td class="actions text-center">
                                                            @if(Auth::user()->role == 1)
                                                                <a href="{{ route('admin.cat.edit', ['id' => $subCat2->id]) }}" class="on-default edit-row"><i class="fa fa-pencil"></i></a> ||
                                                                <a href="{{ route('admin.cat.delete', ['id' => $subCat2->id]) }}"
                                                                   onclick="return confirm('Bạn có muốn xóa không? ')"
                                                                   class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                            @else
                                                                No action
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
