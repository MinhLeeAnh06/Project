@extends('front.layout.master')
@section('title' , 'Contact')
@section('body')
    <!-- Header Section Begin  -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class="fa fa-envelope"></i>
                        huylllee@gmail.com
                    </div>
                    <div class="phone-service">
                        <i class="fa fa-phone"></i>
                        0376697126
                    </div>
                </div>
                <div class="ht-right">
                    <a href="login.html" class="login-panel"><i class="fa fa-user"></i>Login</a>
                    <div class="lan-selector">
                        <select class="language_drop" name="countries" id="countries" style="width: 300px;">
                            <option value="yt" data-image = "front/img/flag-1.jpg" data-imagecss="flag yt" data-title ="English">English</option>
                            <option value="yu" data-image = "front/img/flag-2.jpg" data-imagecss="flag yu" data-title ="German">German</option>
                        </select>
                    </div>
                    <div class="top-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="index.html">
                                <img src="front/img/logo.png" height="25">
                            </a>
                        </div>
                    </div>
                    <div class="col-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Category</button>
                            <div class="input-group">
                                <input type="text" placeholder="What do you need">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 text-right">
                        <ul class="nav-right">
                            <li class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li>
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="icon_bag_alt"></i>
                                    <span>3</span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="si-pic"><img src="front/img/select-product-1.jpg"> </td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <p>$60.00 x 1</p>
                                                        <h6> Kabino Bedside Table</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="ti-close"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="si-pic"><img src="front/img/select-product-2.jpg"> </td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <p>$60.00 x 1</p>
                                                        <h6> Kabino Bedside Table</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="ti-close"></i>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>$120.000</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="shopping-cart.html" class="primary-btn view-card">VIEW CART</a>
                                        <a href="check-out.html" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price">$150.000</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                            <li class="active"><a href="#">Women's Clothing</a></li>
                            <li><a href="#">Men's Clothing </a></li>
                            <li><a href="#">UnderWear</a></li>
                            <li><a href="#">Kid's Clothing</a></li>
                            <li><a href="#">Brand codeleanon</a></li>
                            <li><a href="#">Accessories/Shoes</a></li>
                            <li><a href="#"></a>Luxury Brand</li>
                            <li><a href="#">Brand Outdoor apparel</a></li>
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="shop.html">SHop</a></li>
                        <li>
                            <a href="">Collection</a>
                            <ul class="dropdown">
                                <li><a href=""> Men's</a></li>
                                <li><a href="">Women's</a></li>
                                <li><a href="">Kid's</a></li>
                            </ul>
                        </li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="">Pages</a>
                            <ul class="dropdown">
                                <li><a href="blog-details.html">Blog Details</a></li>
                                <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                <li><a href="check-out.html">Checkout</a></li>
                                <li><a href="faq.html">Faq</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="login.html">Login</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header Section End  -->
<!--Breadcrumb Section Begin-->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.html"> <i class="fa fa-home"></i>Home</a>
                    <span>Contact</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Breadcrumb Section End-->
<!--Map Section Begin-->
<div class="map spad">
    <div class="container">
        <div class="map-inner">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29811.461773003866!2d105.97871273390105!3d20.93513073991156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13
            .1!3m3!1m2!1s0x3135a51286f8b355%3A0xb3e95ce9d4e89e81!2zVsSpbmggS2jDumMsIFbEg24gR2lhbmcs
            IEjGsG5nIFnDqm4sIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1670333981545!5m2!1svi!2s"
                     height="400" frameborder="0" style="border:0;" allowfullscreen=""  aria-hidden="false" tabindex="0"></iframe>
            <div class="icon">
                <i class="fa fa-map-marker"></i>
            </div>

        </div>
    </div>
</div>
<!--Map Section End-->
<!--Contact Section Begin-->
<section class="contact-section spad">
    <section class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="contact-title">
                    <h4>Contact Us</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, dignissimos dolor doloribus hic qui saepe ullam. Cupiditate
                        dolorem ducimus iste iure molestias officiis optio porro, quis quo temporibus veritatis vero?</p>

                </div>
                <div class="contact-widget">
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-location-pin">
                            </i>
                        </div>
                        <div class="ci-text">
                            <span>Address:</span>
                            <p>Vĩnh Khúc - Văn Giang - Hưng Yên</p>
                        </div>
                    </div>
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-mobile">
                            </i>
                        </div>
                        <div class="ci-text">
                            <span>Phone:</span>
                            <p>0376697126</p>
                        </div>
                    </div>
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-email">
                            </i>
                        </div>
                        <div class="ci-text">
                            <span>Email:</span>
                            <p>Huylllee@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <div class="contact-form">
                    <div class="leave-comment">
                        <h4>Leave A Comment</h4>
                        <p>Our Staff will call back later and answer the question</p>
                        <form action="#" class="comment-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Your Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Your Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Your messages"></textarea>
                                    <button type="submit" class="site-btn">Send Messages</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!--Contact Section End-->
@endsection()
