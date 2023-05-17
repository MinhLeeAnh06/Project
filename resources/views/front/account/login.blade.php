@extends('front.layout.master')
@section('title' , 'Login')
@section('body')

    <!--Register Section Begin-->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2> Login</h2>
                        @if(session('notification'))
                            <div class="alert alert-warning" role="alert">
                                {{session('notification')}}
                            </div>
                        @endif
                        <form action="" method="post">
                            @csrf
                            <div class="group-input">
                                <label for="email">UserName or Email address</label>
                                <input type="email" id="email" name="email">
                            </div>
                            <div class="group-input">
                                <label for="password">Password</label>
                                <input type="password" id="pass" name="password">
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label>
                                        Save Password
                                        <input type="checkbox" id="save-pass" name="remember">
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">Sign In</button>
                        </form>
                        <div class="switch-login">
                            <a href="./account/register" class="or-login">Or Create An Account </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Register Section End-->
@endsection()
