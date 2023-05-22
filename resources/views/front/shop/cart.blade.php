@extends('front.layout.master')
@section('title' , 'Cart')
@section('body')
<!--SHopping Cart Section Begin-->
<div class="fa-shopping spad">
    <div class="container">
        <div class="row">
            @if(!empty($carts))
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Products Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>
                                    <i onclick="confirm('Are you sure  to delete all Carts ? ') === true ? destroyCart():''"
                                       style="cursor:pointer" class="ti-close"></i>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="render-view-cart">
                                @include('render.cart.tbl_cart')
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="./shop" class="primary-btn continue-shop">Continue Shop</a>

                            </div>
                            <div class="discount-coupon">
                                <h6>Discount Code</h6>
                                <form action="" CLASS="coupon-form">
                                    <input type="text" placeholder="Enter Your Code">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4 render-view-cart-total">
                            @include('render.cart.total_cart')
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-12">
                    <h4>Your Cart is Empty.</h4>
                </div>
            @endif
        </div>
    </div>
</div>
<!--SHopping Cart Section End-->
@endsection
