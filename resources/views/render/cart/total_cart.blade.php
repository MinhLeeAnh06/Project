<div class="proceed-checkout">
    <ul>
        <li class="cart-total">Total <span>${{number_format($carts->sum('price'))}}</span></li>
    </ul>
    @if(auth()->check())
        <a href="{{ route('order.index') }}" class="proceed-btn">PROCESSD TO CHECK OUT</a>
    @endif
</div>
