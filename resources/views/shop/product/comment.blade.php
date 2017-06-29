@foreach($objCmt as $cmt)
    <li>
        <div class="col-md-12">
            <ul>
                <li><a href="javascript:void(0)"><i class="fa fa-user"></i>{{ $cmt->name_cmt }}</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-clock-o"></i>{{ $cmt->created_at }}</a></li>
            </ul>
            <p>{{ $cmt->content }}</p>
            <br />
        </div>
    </li>
    <br />
    <hr />
@endforeach