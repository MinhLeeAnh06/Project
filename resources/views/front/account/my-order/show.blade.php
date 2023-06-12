@extends('front.layout.master')
@section('title' , 'My Order Details')
@section('body')
    <!--Shopping Cart Section Begin-->
    <div class="checkout-section spad">
        <div class="container">
            <div class="table-responsive">
                <h2 class="text-center">Products list</h2>
                <hr>
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">Product image</th>
                        <th class="text-center">Product name</th>
                        <th class="text-center">Color</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Base price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderDetails as $item)
                        <tr>
                            <td class="cart-pic first-row"><img  style="width: 100px" src="front/img/products/{{$item->product_image}}"></td>
                            <td class="text-center">{{ $item->product_name }}</td>
                            <td class="text-center">{{ $item->product_color }}</td>
                            <td class="text-center">{{ $item->product_size }}</td>
                            <td class="text-center">{{ $item->product_base_price  }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-center">{{ number_format($item->price).' VND' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Shopping Cart Section End-->
@endsection()
