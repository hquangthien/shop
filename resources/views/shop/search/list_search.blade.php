<div class="col-md-12">
        <ul class="wrap-suggestion">
            @if(sizeof($objProductSearch) == 0)
                <p class="text-center"> Không có kết quả tìm kiếm nào cho từ khóa <strong>" {{ $key_search }} "</strong> </p>
            @else
            @foreach($objProductSearch as $product)
            <li>
                <a href="{{ route('shop.product.detail', ['slug' => str_slug($product->name), 'id' => $product->id]) }}">
                    <img src="{{ Storage::url('app/files/') }}{{ $product->picture }}" width="100px">
                    <h3>{{ $product->name }}</h3>
                    <h4>Giá: <span class="price">{{ number_format($product->price - (1 - $product->promotion_price/100)) }} VNĐ</span></h4>
                </a>
            </li>
            @endforeach
            @endif
            <li style="margin:auto"><p><a href="{{ route('shop.search', ['key_search' => $key_search]) }}"><strong> Xem tất cả </strong></a></p></li>
        </ul>
</div>