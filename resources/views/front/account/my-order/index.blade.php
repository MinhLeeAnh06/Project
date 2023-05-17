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
                                <th>Image</th>
                                <th>ID</th>
                                <th class="p-name">Products Name</th>
                                <th>Total</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                        <td class="cart-pic first-row">
                                            <img  style="height: 100px;" src="front/img/products/{{$order->orderDetails[0]->product->productImages[0]->path }}">
                                        </td>
                                            <td class="first-row">#{{$order->id}}</td>
                                        <td class="cart-title first-row">
                                            <h5>
                                                {{$order->orderDetails[0]->product->name}}
                                                @if(count($order->orderDetails)>1)
                                                    (and {{count($order->orderDetails) }}  other products )
                                                @endif
                                            </h5>
                                        </td>
                                        <td class="total-price first-row">
                                            ${{array_sum(array_column($order->orderDetails->toArray(),'total'))}}
                                        </td>
                                        <td class="close-td first-row">
                                            <a class="btn" href="./account/my-order/{{$order->id}}">Details</a>
                                        </td>
                                    </tr>
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
