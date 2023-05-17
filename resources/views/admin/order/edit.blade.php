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
                    <form method="post" action="admin/order/{{$order->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="card-body display_data">
                        <h2 class="text-center mt-5">Order info</h2>
                        <hr>
                        <div class="position-relative row form-group">
                            <label for="status" class="col-md-3 text-md-right col-form-label">Status</label>
                            <div class="col-md-9 col-xl-8">
                                <div class="badge badge-dark mt-2">
                                    <select required name="status" id="status"  class="form-control">
                                        <option value="1" selected>{{\App\Utilities\Constant::$order_status[$order->status]}}</option>
                                        <option value="2">{{\App\Utilities\Constant::$order_status[2]}}</option>
                                        <option value="3">{{\App\Utilities\Constant::$order_status[3]}}</option>
                                        <option value="4">{{\App\Utilities\Constant::$order_status[4]}}</option>
                                        <option value="5">{{\App\Utilities\Constant::$order_status[5]}}</option>
                                    </select>
                                </div>
                                <button type="submit"
                                        class="btn-shadow btn-hover-shine btn btn-primary">
                                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                                            <i class="fa fa-download fa-w-20"></i>
                                                        </span>
                                    <span>Save</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
