@extends('templates.ban.master')
@section('title')
    Trang quản lý sản phẩm
@endsection
@section('h1')
    Trang quản lý sản phẩm
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <h4 class="header-title m-t-0 m-b-30">Thêm sản phẩm</h4>

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
                                <form id="create_news" class="form-horizontal" action="{{ route('ban.product.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tên sản phẩm (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chọn danh mục sản phẩm (*)</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="cat_id">
                                                <option value="{{ null }}">-- Không có --</option>
                                                @foreach($objSuperCat as $superCat)
                                                    <option value="{{ $superCat->id }}">{{ $superCat->name }}</option>
                                                    @if(isset($objSubCat1[$superCat->id]))
                                                        @foreach($objSubCat1[$superCat->id] as $subCat1)
                                                            <option value="{{ $subCat1->id }}"> + {{ $subCat1->name }}</option>
                                                            @if(isset($objSubCat2[$subCat1->id]))
                                                                @foreach($objSubCat2[$subCat1->id] as $subCat2)
                                                                    <option value="{{ $subCat2->id }}"> &nbsp;&nbsp;&nbsp; - {{ $subCat2->name }}</option>

                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Giá sản phẩm (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" id="price" name="price" class="form-control" placeholder="Nhập giá sản phẩm...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="">Tình trạng sản phẩm (*)</label>
                                        <div class="col-md-10">
                                            <input type="text" name="new" class="form-control" placeholder="Tình trạng sản phẩm (mới, cũ, like new ...)">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Từ khóa</label>
                                        <div class="col-md-10">
                                            <input type="text" name="tags" value="" data-role="tagsinput" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="picture">Ảnh sản phẩm</label>
                                        <div class="col-md-10">
                                            <input type="file" name="picture" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chi tiết sản phẩm</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="description" id="editor" rows="5"></textarea>
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
@section('css')
    <link rel="stylesheet" href="{{ $adminUrl }}assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="{{ $adminUrl }}assets/css/bootstrap-tagsinput.css">
@endsection
@section('js')
    <script src="{{ $adminUrl }}assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="/public/plugins/ckeditor/ckeditor.js" language="javascript" type="text/javascript"></script>
    <script src="/public/plugins/ckfinder/ckfinder.js" language="javascript" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#create_news').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });


        CKEDITOR.replace('editor', {
            filebrowserBrowseUrl : '/public/plugins/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '/public/plugins/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '/public/plugins/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '/public/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '/public/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '/public/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            height  : '500px',
        });

    </script>
@endsection
