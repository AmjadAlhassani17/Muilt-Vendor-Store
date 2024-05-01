@extends('layouts.front')

@section('title', 'Register - ShopGrid')

@section('breadcrumb')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Registration</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li>Registration</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
@endsection

@section('content')
    <!-- Start Account Register Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <h3>No Account? Register</h3>
                            <p>Registration takes less than a minute but gives you full control over your orders.</p>
                        </div>
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <form class="row" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-fn">First Name</label>
                                    <x-form.input name="first_name"/>    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-ln">Last Name</label>
                                    <x-form.input name="last_name"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-email">E-mail Address</label>
                                    <x-form.input name="email"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-phone">Phone Number</label>
                                    <x-form.input name="phone_number"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass">Password</label>
                                    <x-form.input type="password" name="password"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass-confirm">Confirm Password</label>
                                    <x-form.input type="password" name="password_confirmation"/>
                                </div>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Register</button>
                            </div>
                            <p class="outer-link">Already have an account? <a href="{{ route('login') }}">Login Now</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Register Area -->
@endsection