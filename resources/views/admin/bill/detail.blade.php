<div class="row card-box">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <address>
            <strong>{{ $objShop->name }}</strong>
            <br>
            {{ $objShop->address }}
            <br />
            <abbr title="Phone">Điện thoại:</abbr> {{ $objShop->phone }}
        </address>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
        <p>
            <em>Ngày mua: {{ $objShop->created_at }}</em>
        </p>
        <p>
            <em>Mã hóa đơn: #{{ $objBill->id }}</em>
        </p>
    </div>
</div>

<div class="row">
    <div class="text-center">
        <h1>Hóa đơn</h1>
    </div>

    <div class="text-left" style="padding-left:20px">
        Tên khách hàng: {{ $objBill->name }}<br>
        Address: {{ $objBill->address }}<br>
        Phone: {{ $objBill->phone }}<br>
        Email: {{ $objBill->email }}<br>
        Ghi chú: {{ $objBill->note }}<br>
        Hình thức thanh toán:
        @if($objBill->payment == 2)
            <img src="https://www.baokim.vn/cdn/x_developer/module/baokim_btn/thanhtoan-m.png">
        @elseif($objBill->payment == 3)
            <img src="https://www.nganluong.vn/css/newhome/img/button/pay-sm.png"border="0" />
        @elseif($objBill->payment == 1)
            <img width="150px" src="https://zencommerce.in/wp-content/themes/zencommercein/img/en/cod.png" alt="">
        @endif
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th class="text-center">Giá</th>
            <th class="col-md-2 text-center">Tổng</th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0 ?>
        @foreach($objDetail as $item)

        <tr>
            <td class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <em>{{ $item->product_name }}</em>
                    </div>
                    <div class="col-md-6">
                        <img width="150px" src="{{ Storage::url('app/files/') }}{{ $item->product_picture }}" alt="">
                    </div>
                </div>

            </td>
            <td class="col-md-1 text-center">{{ $item->quantity }}</td>
            <td class="col-md-2" style="text-align: center"> {{ number_format($item->price) }}</td>
            <td class="col-md-2 text-center">{{ number_format($item->price * $item->quantity) }}</td>
        </tr>
        <?php $total = $total + $item->price * $item->quantity?>
        @endforeach
        <tr>
            <td> &nbsp; </td>
            <td> &nbsp; </td>
            <td class="text-right"><h4><strong>Tổng thanh toán:</strong></h4></td>
            <td class="text-center text-danger" colspan="3"><h4><strong>&nbsp;{{ number_format($total) }}</strong></h4></td>
        </tr>
        </tbody>
    </table>
</div>