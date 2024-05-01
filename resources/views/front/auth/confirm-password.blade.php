@extends('layouts.front')

@section('title', 'Confirem Password - ShopGrid')

@section('breadcrumb')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Login</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li>Confirm Password</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
@endsection

@section('content')
    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('password.confirm') }}" method="post">
                        @csrf

                        <div class="card-body">
                            @if ($errors->has('password'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <div class="title">
                                <h3>Confirm Password</h3>
                                <p>You must confirm password to enable 2FA.</p>
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Password</label>
                                <input class="form-control" type="password" name="password" autocomplete="current-password" id="reg-pass" required>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Confirm</button>
                            </div>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->
@endsection