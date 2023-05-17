@extends('front.layout.master')
@section('title' , 'Result')
@section('body')
<!--Shopping Cart Section Begin-->
<div class="checkout-section spad">
    <div class="container">
        <div class="col-lg-12">
            <h4>{{$notification}}</h4>
        </div>
        <a href="./" class="primary-btn mt-5 ">Continue Shopping</a>
    </div>
</div>
<!--Shopping Cart Section End-->
@endsection()
