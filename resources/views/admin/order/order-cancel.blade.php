@extends('admin.layout.master')
@section('title' , 'Orders')
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

                    <div class="card-header">

                        <form>
                            <div class="input-group">
                                <input type="search" name="search" id="search" value="{{request('search')}}"
                                       placeholder="Search everything" class="form-control">
                                <span class="input-group-append">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-search"></i>&nbsp;
                                                        Search
                                                    </button>
                                                </span>
                            </div>
                        </form>

                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <a href="{{ LINK_CHECK_PAY }}">
                                    <button class="btn btn-focus">Link check pay</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Order ID</th>
                                <th class="text-center">User name</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr data-order-id="{{ $order->order_id }}">
                                    <td class="text-center">{{ $order->order_id }}</td>
                                    <td class="text-center">{{ $order->user_name }}</td>
                                    <td class="text-center">{{ $order->amount }}</td>
                                    <td class="text-center">{{ number_format($order->total). ' VND' }}</td>
                                    <td class="text-center text-status">{{ getStatusOrder($order->status) }}</td>
                                    <td class="text-center">
                                        <div class="mt-2">
                                            <a href="{{ route('admin.order.show', ['id' => $order->order_id]) }}" class="btn btn-warning">Xem đơn hàng</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        {{--                        {{$orders->links()}}--}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection