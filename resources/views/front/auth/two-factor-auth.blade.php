@extends('layouts.front')

@section('title', '2FA - ShopGrid')

@section('breadcrumb')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">2FA</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li>2FA</li>
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
                    <form class="card login-form" action="{{ route('two-factor.enable') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Two Factor Authentication</h3>
                                <p>You can Enable/Disable 2FA.</p>
                            </div>
                            @if (session('status') == 'two-factor-authentication-enabled')
                                <div class="mb-4 font-medium text-sm">
                                    Please finish configuring two factor authentication below.
                                </div>
                            @endif
                            @if (session('status') == 'two-factor-authentication-confirmed')
                                <div class="mb-4 font-medium text-sm">
                                    Two factor authentication confirmed and enabled successfully.
                                </div>
                            @endif
                            <div class="button">
                                @if (!$user->two_factor_recovery_codes)
                                    <button class="btn" type="submit">Enable</button>
                                @else
                                    <div class="p-4">
                                        {!! $user->twoFactorQrCodeSvg() !!}
                                    </div>
                                    <h3>Recovery Codes</h3>
                                    <ul>
                                        @foreach ($user->recoveryCodes() as $recoveryCode)
                                            <li>
                                                {{ $recoveryCode }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="mb-3"></div>
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Disable</button>
                                @endif
                                
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
