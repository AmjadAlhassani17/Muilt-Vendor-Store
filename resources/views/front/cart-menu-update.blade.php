<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items" id="total-count-change-outside">{{ $items->count() }}</span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span id="total-count-change-inside">{{ $items->count() }} Items</span>
            <a href="{{ route('front.cart.index') }}">View Cart</a>
        </div>
        @foreach ($items as $item)
            <div>
                <ul class="shopping-list">
                    <li id="cart-menu-item-{{ $item->id }}">
                        <a class="remove remove-item" data-id="{{ $item->id }}" title="Remove this item"><i
                                class="lni lni-close"></i></a>
                        <div class="cart-img-head">
                            <a class="cart-img" href="{{ route('front.products.show', $item->product->slug) }}"><img
                                    src="{{ $item->product->image_url }}" alt="#"></a>
                        </div>

                        <div class="content">
                            <h4><a href="{{ route('front.products.show', $item->product->slug) }}">
                                    {{ $item->product->name }}</a></h4>
                            <span class="quantity"
                                id="cart-menu-quantity-with-change-{{ $item->id }}">{{ $item->quantity }}x -
                            </span>
                            <span class="amount"
                                id="cart-menu-amount-with-change-{{ $item->id }}">{{ App\Helpers\Currency::format($item->product->price * $item->quantity) }}</span>
                        </div>
                    </li>
                </ul>
            </div>
        @endforeach
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount" id="total-with-change">{{ App\Helpers\Currency::format($total) }}</span>
            </div>
            <div class="button">
                <a href="{{ route('front.checkout') }}" class="btn animate">Checkout</a>
            </div>
        </div>
    </div>
    <!--/ End Shopping Item -->
</div>