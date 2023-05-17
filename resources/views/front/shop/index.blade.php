@extends('front.layout.master')
@section('title' , 'Shop')
@section('body')
<!--Products Shop Section Begin-->
<section class="product-shop spad">
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
            @include('front.shop.components.products-slidebar-filter')
        </div>
        <div class="col-lg-9 order-1 order-lg-2">
            <div class="product-show-option">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <form action="">
                            <div class="select-option">
                            <select  name="sort_by" onchange="this.form.submit();" class="sorting">
                                <option value="latest" {{request('sort_by') == 'latest' ?'selected':''}}> Sorting : Latest</option>
                                <option value="oldest" {{request('sort_by') == 'oldest' ?'selected':''}}> Sorting : Oldest</option>
                                <option value="name-ascending" {{request('sort_by') == 'name-ascending' ?'selected':''}}> Sorting : Name A-Z</option>
                                <option value="name-descending"{{request('sort_by') == 'name-descending' ?'selected':''}}> Sorting : Name Z-A</option>
                                <option value="price-ascending" {{request('sort_by') == 'price-ascending' ?'selected':''}}> Sorting : Price Ascending</option>
                                <option value="price-descending" {{request('sort_by') == 'price-descending' ?'selected':''}}> Sorting : Price Descending</option>
                            </select>
                            <select name="show" class="p-show"  onchange="this.form.submit();">
                                <option {{request('show') == '3' ?'selected':''}} value="3">Show:3 </option>
                                <option {{request('show') == '9' ?'selected':''}} value="9">Show:9</option>
                                <option {{request('show') == '15' ?'selected':''}} value="15">Show:15 </option>
                            </select>
                        </div>
                        </form>
                    </div>
                    <div class="col-lg-5 col-md-5 text-right">
                        <p>SHow 01-09 Of 36 Products</p>
                    </div>
                </div>
            </div>
            <div class="product-list">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-sm-6">
                        @include('front.components.product-item')
                        </div>
                    @endforeach
                </div>
            </div>
            {{$products->links()}}
        </div>
    </div>
</div>
</section>
<!--Products Shop Section End-->
@endsection()
