
@extends('front.layout.master')
@section('title' , 'Blog-Details')
@section('body')

    <div class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-details-inner">
                        <div class="blog-detail-title">
                            <h2>{{$blog->title}}</h2>
                            <p>{{$blog->category}} <span>June 12,2022</span></p>
                        </div>
                        <div class="blog-large-pic">
                            <img src="front/img/blog/{{$blog->image}}">
                        </div>
                        <div class="blog-detail-desc">
                            <p>{{$blog->content}}</p>
                        </div>

                        <!--    Latest Blog Section Begin-->
                        <section class="latest-blog spad">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="section-title">
                                            <h2> From The Blog</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($blogService as $blogs)
                                        <a href="blog/{{$blogs->id}}">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="single-latest-blog">
                                                    <img src="front/img/blog/{{$blogs->image}}">
                                                    <div class="tag-list">
                                                        <div class="tag-item">
                                                            <i class="fa fa-calendar-o"></i>
                                                            {{date('M,d,Y',strtotime($blogs->create_at))}}
                                                        </div>
                                                        <div class="tag-item">
                                                            <i class="fa fa-comment-o"></i>
                                                            {{count($blogs->blogComments)}}
                                                        </div>
                                                    </div>
                                                    <a href="blog/{{$blogs->id}}">
                                                        <h4>{{$blogs->title}}</h4>
                                                    </a>
                                                    <p > {{$blogs->subtitle}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="benefit-items">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="single-benefit">
                                                <div class="sb-icon">
                                                    <img src="front/img/icon-1.png">
                                                </div>
                                                <div class="sb-text">
                                                    <h6>Free Ship</h6>
                                                    <p>For All order orver 99$</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="single-benefit">
                                                <div class="sb-icon">
                                                    <img src="front/img/icon-2.png">
                                                </div>
                                                <div class="sb-text">
                                                    <h6>DELIVERY ON TIME</h6>
                                                    <p>If good have problems</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="single-benefit">
                                                <div class="sb-icon">
                                                    <img src="front/img/icon-3.png">
                                                </div>
                                                <div class="sb-text">
                                                    <h6>SECURE PAYMENT</h6>
                                                    <p>100% Secure Payment</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--    Latest Blog Section End-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--BlogDetail Section End-->
@endsection()
