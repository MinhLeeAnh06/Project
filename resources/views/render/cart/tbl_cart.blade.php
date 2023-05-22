@foreach($carts as $cart)
    <input type="hidden" name="product_id" value="{{$cart->id}}" class="product_id">
    <tr data-rowid = "{{$cart->rowId}}">
        <td class="cart-pic first-row"><img  style="height: 170px" src="front/img/products/{{$cart->image_product}}"></td>
        <td class="cart-title first-row">
            <h5>{{$cart->name}}</h5>
        </td>
        <td class="p-price first-row">${{number_format($cart->product->price)}}</td>
        <td class="qua-col first-row">
            <div class="quantity">
                <div class="pro-qty">
                    <span class="dec qtybtn">-</span>
                    <input type="text" value="{{ $cart->quantity }}"
                           data-url="{{ route('cart.update', ['id' => $cart->id]) }}"
                           data-product-id="{{ $cart->product_id }}"
                           class="update-cart" readonly>
                    <span class="inc qtybtn">+</span>
                </div>
            </div>
        </td>
        <td class="total-price first-row">${{number_format($cart->price)}}</td>
        <td class="close-td first-row">
            <button class="ti-close delete-cart-item" data-url="{{ route('cart.delete', ['id' => $cart->id]) }}"></button>
        </td>
    </tr>
@endforeach
