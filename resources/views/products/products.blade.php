
@foreach($products as $product)
    <div class="col-3 product-item">
        <div class="product-content">
            <div class="product-top">
                <div class="product-img">
                    <a href="{{ route('products.show', ['product' => $product->id]) }}">
                        <img src="{{ $product->image_url }}" alt="">
                    </a>
                </div>
                <div class="product-price">
                    <b>￥</b>
                    {{ $product->price }}
                </div>
                <div class="product-title">
                    <a href="{{ route('products.show', ['product' => $product->id]) }}">
                        {{ $product->title }}
                    </a>
                </div>
            </div>
            <div class="product-bottom">
                <div class="product-sold">销量 <span>{{ $product->sold_count }}笔</span></div>
                <div class="product-review">评价 <span>{{ $product->review_count }}</span></div>
            </div>
        </div>
    </div>
@endforeach