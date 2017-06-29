@extends('templates.shop.master3')
@section('nvarbar')
    <div class="container">
        <ul class="nav nav-tabs">
            <li><a href="{{ route('subshop.index', ['slug' => str_slug($objShop->name), 'id' => $objShop->id]) }}">Trang
                    chủ shop {{ $objShop->name }}</a></li>
            <li class="active"><a
                        href="{{ route('subshop.feedback', ['slug' => str_slug($objShop->name), 'id' => $objShop->id]) }}">Đánh
                    giá - Phản hồi</a></li>
            <li><a href="{{ route('subshop.contact', ['slug' => str_slug($objShop->name), 'id' => $objShop->id]) }}">Liên
                    hệ shop {{ $objShop->name }}</a></li>
        </ul>
    </div>
    <br/><br/><br/><br/>
@endsection
@section('left_bar')
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Danh mục</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                @foreach($objSuperCatOfShop as $superCat)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="{{ route('subshop.cat', ['slug' => str_slug($objShop->name), 'id' => $objShop->id, 'cat_name' => str_slug($superCat->name), 'cat_id' => $superCat->id]) }}">
                                    {{ $superCat->name }}
                                </a>
                                @if(isset($objSubCatOfShop[$superCat->id]))
                                    <a data-toggle="collapse" href="#{{ str_slug($superCat->name) }}">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    </a>
                                @endif

                            </h4>
                        </div>
                        @if(isset($objSubCatOfShop[$superCat->id]))
                            <div id="{{ str_slug($superCat->name) }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        @foreach($objSubCatOfShop[$superCat->id] as $subCat1)
                                            <li>
                                                <a href="{{ route('subshop.cat', ['slug' => str_slug($objShop->name), 'id' => $objShop->id, 'cat_name' => str_slug($subCat1->name), 'cat_id' => $subCat1->id]) }}">
                                                    {{ $subCat1->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div><!--/category-products-->

            <div class="shipping text-center"><!--shipping-->
                <img src="{{ Storage::url('app/files/') }}{{ $objRightAdv[0]->image }}" alt="">
            </div><!--/shipping-->

        </div>
    </div>
@endsection
@section('content')
    <div class="col-sm-9 padding-right">
        <h2 class="title text-center">Bình luận đánh giá về cửa hàng "{{ $objShop->name }}"</h2>
        <div class="col-md-12" id="comment-box">
                <ul id="list_cmt">
                    @if(sizeof($objCmt) == 0)
                        <p class="alert alert-warning">Chưa có bình luận, đánh giá về shop này</p>
                    @else
                    @foreach($objCmt as $cmt)
                        <li>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a style="color: #B2B2B2" href="javascript:void(0)">
                                            <i class="fa fa-user"></i> {{ $cmt->name_cmt }}
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a style="color: #B2B2B2" href="javascript:void(0)">
                                            <i class="fa fa-clock-o"></i> {{ $cmt->created_at }}</a>
                                    </div>
                                </div>
                                <br/>
                                <p>{{ $cmt->content }}</p>
                                <hr/>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
        <div class="col-md-12">
            <p><b>Viết bình luận của bạn</b></p>
            <form id="cmtBox" action="javascript:void(0)">
                <input type="hidden" class="form-control" id="shop_id" value="{{ $objShop->id }}">
                <input type="hidden" class="form-control" id="user_id"
                       value="@if(Auth::check()){{Auth::user()->id}}@endif">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" required id="name"
                               value="@if(Auth::check()){{Auth::user()->fullname}}@endif" name="name"
                               placeholder="Nhập tên của bạn...">
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" required id="email"
                               value="@if(Auth::check()){{Auth::user()->email}}@endif"
                               placeholder="Nhập địa chỉ email...">
                    </div>
                </div>
                <br>
                <textarea name="content" class="form-control" rows="6" required id="content"
                          placeholder="Nhập bình luận..."></textarea>
                <br>
                <button type="submit" onclick="comment()" class="btn btn-default pull-right">
                    Bình luận
                </button>
            </form>
        </div>
        <hr/>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        function comment() {
            var name = ($('#name').val());
            var shop_id = ($('#shop_id').val());
            var email = ($('#email').val());
            var content = ($('#content').val());
            var user_id = ($('#user_id').val());
            if (name != '' && email != '' && content != '') {
                data = {
                    name_cmt: name,
                    shop_id: shop_id,
                    email: email,
                    content: content,
                    user_id: user_id
                };
                commentPublic('cua-hang/{{ str_slug($objShop->name) }}-{{ $objShop->id }}/comment', data,
                    function (data) {
                        $('#content').val('');
                        $('#list_cmt').empty();
                        $('#list_cmt').append(data);
                    },
                    function (error) {
                        alert('Có lỗi');
                    }
                );
            }
        }
    </script>
@endsection