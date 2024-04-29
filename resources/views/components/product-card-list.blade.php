<div class="single-product">
    <div class="row align-items-center">
        <div class="col-lg-4 col-md-4 col-12">
            <div class="product-image">
                <img src="{{ $product->image_url }}" alt="#">
                @if ($product->compare_price)
                    <span class="sale-tag">-{{ $product->price_discound }}%</span>
                @endif
                @if ($product->new)
                    <span class="new-tag">{{ $product->new }}%</span>
                @endif
                <div class="button">
                    <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to
                        Cart</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-12">
            <div class="product-info">
                <span class="category">{{ $product->category->name ?? '' }}</span>
                <h4 class="title">
                    <a href="{{ route('front.products.show', $product->slug) }}">{{ $product->name }}</a>
                </h4>
                <ul class="review">
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star"></i></li>
                    <li><span>4.0 Review(s)</span></li>
                </ul>
                <div class="price">
                    <span>{{ App\Helpers\Currency::format($product->price) }}</span>
                    @if ($product->compare_price)
                        <span class="discount-price">{{ App\Helpers\Currency::format($product->compare_price) }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
