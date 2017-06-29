@extends('templates.admin.master')
@section('title')
    Quản lý quảng cáo
@endsection
@section('h1')
    Quản lý quảng cáo
@endsection
@section('content')
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Danh sách quảng cáo</h4>
                        @if(session('msg'))
                            <p class="alert alert-success"> {{ session('msg') }} </p>
                        @endif
                        <a href="{{ route('admin.adv.create') }}" class="btn btn-primary">Tạo mới</a>
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table m-0 text-center table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên quảng cáo</th>
                                    <th>Link</th>
                                    <th>Vị trí</th>
                                    <th>Tình trạng</th>
                                    <th>Hình ảnh</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objAdv as $advItem)
                                <tr>
                                    <th>{{ $advItem->id }}</th>
                                    <td>{{ $advItem->name }}</td>
                                    <td>{{ $advItem->link }}</td>
                                    <td>
                                        @if($advItem->position == 1)
                                            header
                                        @else
                                            right bar
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="changeActive({{ $advItem->id }})">
                                            @if($advItem->active_adv == 1)
                                                <img id="adv{{ $advItem->id }}" src="{{ $adminUrl }}assets/images/1.gif">
                                            @else
                                                <img id="adv{{ $advItem->id }}" src="{{ $adminUrl }}assets/images/0.gif">
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <img width="300" src="{{ Storage::url('app/files/') }}{{ $advItem->image }}" />
                                    </td>
                                    <td class="actions">
                                        <a href="{{ route('admin.adv.edit', ['id' => $advItem->id]) }}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                        @if(Auth::user()->role == 1)
                                            || <a href="{{ route('admin.adv.delete', ['id' => $advItem->id]) }}" onclick="return confirm('Bạn có muốn xóa quảng cáo này không?')" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $objAdv->links() }}
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
            updateActive('adv/active_adv', id,
                function (data) {
                    $('#adv'+id).attr('src', '{{ $adminUrl }}assets/images/'+ data.active +'.gif');
                },
                function (error) {
                    console.log(error);
                }
            );
        }
    </script>
@endsection
