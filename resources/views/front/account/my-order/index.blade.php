@extends('front.layout.master')
@section('title' , 'My Orders')
@section('body')

<!--SHopping Cart Section Begin-->
<div class="fa-shopping spad">
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                <div class="cart-table">
                        <table>
                            <thead>
                            <tr>
                                <th class="text-center">Order ID</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Payment type</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Time create</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @include('render.front.order.tbl_order')
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--SHopping Cart Section End-->
@endsection()
