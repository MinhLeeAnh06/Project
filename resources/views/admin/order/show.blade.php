@extends('admin.layout.master')
@section('title' , 'SHow Orders')
@section('body')
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Order
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body display_data">

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
                                    <td class="text-center">{{ $item->price }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>



{{--                        <h2 class="text-center mt-5">Order info</h2>--}}
{{--                        <hr>--}}
{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="name" class="col-md-3 text-md-right col-form-label">--}}
{{--                                Full Name--}}
{{--                            </label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->first_name.''.$order->last_name}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->email}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="phone" class="col-md-3 text-md-right col-form-label">Phone</label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->phone}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="company_name" class="col-md-3 text-md-right col-form-label">--}}
{{--                                Company Name--}}
{{--                            </label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->company_name}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="street_address" class="col-md-3 text-md-right col-form-label">--}}
{{--                                Street Address</label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->street_address}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="town_city" class="col-md-3 text-md-right col-form-label">--}}
{{--                                Town City</label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->town_city}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="country"--}}
{{--                                   class="col-md-3 text-md-right col-form-label">Country</label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->country}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="postcode_zip" class="col-md-3 text-md-right col-form-label">--}}
{{--                                Postcode Zip</label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->postcode_zip}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="payment_type" class="col-md-3 text-md-right col-form-label">Payment Type</label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->payment_type}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="status" class="col-md-3 text-md-right col-form-label">Status</label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <div class="badge badge-dark mt-2">--}}
{{--                                    {{\App\Utilities\Constant::$order_status[$order->status]}}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="description"--}}
{{--                                   class="col-md-3 text-md-right col-form-label">Description</label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->description}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="position-relative row form-group">--}}
{{--                            <label for="description"--}}
{{--                                   class="col-md-3 text-md-right col-form-label">Created_at</label>--}}
{{--                            <div class="col-md-9 col-xl-8">--}}
{{--                                <p>{{$order->created_at}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
