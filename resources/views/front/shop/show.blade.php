@extends('front.layout.master')
@section('title' , 'Shop')
@section('body')
<!--Product SHop Section Begin-->
<section class="product-shop spad page-details">
    <style>
        .chose-active {
            border: 2px solid black;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('front.shop.components.products-slidebar-filter')
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-pic-zoom">
                            <img class="product-big-img"  src="front/img/products/{{$product->productImages[0]-> path}}" alt="">
                            <div class="zoom-icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="product-thumbs">
                            <div class="product-thumbs-track ps-slider owl-carousel">
                               @foreach($product->productImages as $productImage)
                                   <div class="pt active" data-imgbigurl = "front/img/products/{{$productImage->path}}">
                                       <img src="front/img/products/{{$productImage->path}}">
                                   </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details">
                            <div class="pd-title">
                                <span>{{$product->tag}}</span>
                                <h3>{{$product->name}} </h3>
                                <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                            </div>
                            <div class="pd-rating">
                                @for($i=1;$i<=5;$i++)
                                    @if($i<=$product->avgRating)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                                <span>({{count($product->productComments)}})</span>
                            </div>
                            <div class="pd-desc">
                                <p>{{$product->content}}</p>
                                @if($product->discount!=null)
                                    <h4>{{$product->discount}} <span>{{$product->price}}</span></h4>
                                @else
                                    <h4>{{$product->discount}} </h4>
                                @endif
                            </div>
                            <div class="pd-color">
                                <h6>Color</h6>
                                    <div class="pd-color-choose">
                                        @php($count = 1)
                                        @foreach(array_unique(array_column($product->productDetails->toArray(),'color')) as $productColor)
                                            <div class="cc-item">
                                                <label class="change-color color-{{ $count }}" data-color="{{$productColor}}" style="background-color: {{ $productColor }};"></label>
                                            </div>
                                            @php($count++)
                                        @endforeach
                                    </div>
                            </div>
                            <div class="pd-size-choose">
                                @foreach(array_unique(array_column($product->productDetails->toArray(),'size')) as $productSize)
                                    <div class="sc-item">
                                  <input type="radio" id="sm-{{$productSize}}">
                                  <label for="sm-{{$productSize}}" class="chose-size">{{$productSize}}</label>
                              </div>
                                @endforeach
                            </div>

                            <div class="quantity">
                                <div class="quantity">
                                    <button class="primary-btn pd-cart btn-add-to-cart"
                                            data-url="{{ route('cart.store') }}"
                                            data-product-id="{{ $product->id }}">Add To Cart</button>
                                </div>
                            </div>
                            <ul class="pd-tags">
                                <li> <span>CATEGORIES</span>: {{$product->productCategory->name}}</li>
                                <li> <span>TAGS</span>:{{$product->tag}}</li>
                            </ul>
                            <div class="pd-share">
                                <div class="p-code">Sku : {{$product->sku}}</div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tab">
                    <div class="tab-item">
                        <ul class="nav" role="tablist">
                            <li><a class="active" href="#tab-1" data-toggle="tab" role="tab">DESCRIPTION</a></li>
                            <li><a href="#tab-3" data-toggle="tab" role="tab">Customers Reviews ({{$comments->count()}})</a></li>
                        </ul>
                    </div>
                    <div class="tab-item-content">
                        <div class="tab-content">
                            <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                <div class="product-content">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <h5 >INTRODUCTION</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eos obcaecati qui quisquam voluptatum. Accusantium aut autem consectetur cupiditate delectus eaque earum,
                                                molestiae mollitia natus, omnis sapiente tempore totam voluptatem!</p>
                                            <h5>Features</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem eligendi excepturi explicabo, fuga fugiat fugit id illum,
                                                neque nesciunt officia porro quis quos similique, soluta tenetur? Deserunt nostrum nulla pariatur?</p>

                                        </div>
                                        <div class="col-lg-5">
                                            <img src="front/img/product-single/tab-desc.jpg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                <div class="customer-review-option">
                                    <h4>Comments</h4>
                                    @if(session('notification'))
                                        <div class="alert alert-warning" role="alert">
                                            {{session('notification')}}
                                        </div>
                                    @endif
                                    <div class="comment-option">
                                        @foreach($comments as $comment)
                                        <div class="co-item">
                                            <div class="avatar-pic">
                                                <img src="front/img/product-single/_default-user.png">
                                            </div>
                                            <div class="avatar-text">
                                                <div class="at-rating">
                                                    @for($i=1;$i<=5;$i++)
                                                        @if($i<=$comment->rating)
                                                            <i class="fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <h5>{{$comment->name}} <span>{{$comment->created_at}}</span></h5>
                                                <div class="at-reply">{{$comment->messages}}!</div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="leave-comment">
                                        <h4>Leave A Comment</h4>
                                        <form action="" method="post" class="comment-form"  onsubmit = "return checkComment()">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id ?? null }}">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" name="name" placeholder="Name" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Email" name="email"required>
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea placeholder="Messages" name="messages"required></textarea>
                                                    <div class="personal-rating">
                                                        <h6>Your Rating</h6>
                                                        <div class="rate" >
                                                            <input type="radio" id="star5" name="rating" value="5" required/>
                                                            <label for="star5" title="text" >5 stars</label>
                                                            <input type="radio" id="star4" name="rating" value="4" required />
                                                            <label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="rating" value="3" required/>
                                                            <label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="rating" value="2"required />
                                                            <label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="rating" value="1"required/>
                                                            <label for="star1" title="text">1 star</label>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="site-btn">Send Messages</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Product SHop Section End-->
<!--Related products Sections Begin-->
<div class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($relatedProducts as $product)
                <div class="col-lg-3 col-sm-6">
                @include('front.components.product-item')
                </div>
            @endforeach
        </div>
    </div>
</div>
<!--Related products Sections End-->

@endsection()
