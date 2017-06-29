@extends('templates.ban.master')
@section('title')
    Quản lý bình luận
@endsection
@section('h1')
    Quản lý bình luận
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách bình luận</h4>
                        @if(session('msg'))
                            <p class="alert alert-success"> {{ session('msg') }} </p>
                        @endif
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Nội dung</th>
                                    <th>Tình trạng</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objComment as $commentItem)
                                    <tr>
                                        <th>{{ $commentItem->id }}</th>
                                        <td>{{ $commentItem->name_cmt }}</td>
                                        <td>{{ $commentItem->email }}</td>
                                        <td>{{ $commentItem->content }}</td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="changeActive({{ $commentItem->id }})">
                                                @if($commentItem->active_cmt == 1)
                                                    <img id="cmt{{ $commentItem->id }}" src="{{ $adminUrl }}assets/images/1.gif">
                                                @else
                                                    <img id="cmt{{ $commentItem->id }}" src="{{ $adminUrl }}assets/images/0.gif">
                                                @endif
                                            </a>
                                        </td>
                                        <td class="actions">
                                            <a href="{{ route('ban.comment.destroy', ['id' => $commentItem->id]) }}" onclick="return confirm('Bạn có chắc chắn xóa bình luận này?')" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $objComment->links() }}
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
            updateActiveBan('comment/active_cmt', id,
                function (data) {
                    $('#cmt'+id).attr('src', '{{ $adminUrl }}assets/images/'+ data.active +'.gif');
                },
                function (error) {
                    console.log(error);
                }
            );
        }
    </script>
@endsection
