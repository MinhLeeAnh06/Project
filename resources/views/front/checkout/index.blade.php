@extends('front.layout.master')
@section('title' , 'Check Out')
@section('body')
<!--Shopping Cart Section Begin-->
<div class="checkout-section spad">
    <div class="container">
        <form action="{{ route('order.store') }}" class="checkout-form" method="post">
            @csrf
            <div class="row">
                @if(!empty($carts))
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <a href="" class="content-btn">Click Here To Login</a>
                        </div>
                        <h4>Billing Details</h4>
                        <div class="row">
                            <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id ??''}}" required>
                            <div class="col-lg-6">
                                <label for="fir">First Name <span>*</span> </label>
                                <input type="text" id="fir" name="first_name" value="{{Auth::user()->name??''}}"required>
                            </div>
                            <div class="col-lg-6">
                                <label for="last">Last Name <span>*</span> </label>
                                <input type="text" id="last" name="last_name" value="{{Auth::user()->name??''}}"required>
                            </div>
                            <div class="col-lg-12">
                                <label for="cun">Country Name <span>*</span> </label>
                                <input type="text" id="cun" name="country" value="{{Auth::user()->country??''}}"required>
                            </div>
                            <div class="col-lg-12">
                                <label for="street">Street Address<span>*</span> </label>
                                <input type="text" id="street" name="street_address" class="street-first"  value="{{Auth::user()->street_address??''}}"required>
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Town / City<span>*</span> </label>
                                <input type="text" id="town" name="town_city"  value="{{Auth::user()->town_city??''}}"required>
                            </div>
                            <div class="col-lg-6">
                                <label for="email">Email Address <span>*</span> </label>
                                <input type="email" id="email" name="email"  value="{{Auth::user()->email??''}}"required>
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone <span>*</span> </label>
                                <input type="number" min="0"   id="phone" name="phone"  value="{{Auth::user()->phone??''}}"required>
                            </div>
                            <div class="col-lg-12">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <input type="text" placeholder="Enter  Your Copun Code ">
                        </div>
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span> </li>
                                    @foreach($carts as $cart)
                                        <li class="fw-normal">{{$cart->product->name}} x {{$cart->quantity}} <span>${{$cart->product->price * $cart->quantity}}</span></li>
                                    @endforeach

                                    <li class="fw-normal">Total <span>${{number_format($carts->sum('price'))}}</span></li>
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <lable>Phương thức thanh toán</lable>
                                        <select class="border" name="payment_type">
                                            <option value="0">Trả tiền sau</option>
                                            <option value="1">VNPay</option>
                                        </select>
                                    </div>
                                    <div class="pc-item">

                                    </div>
                                </div>
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-order">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <h4>Your Cart is Empty !!!!</h4>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
<!--Shopping Cart Section End-->
@endsection()
