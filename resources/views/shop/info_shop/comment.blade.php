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