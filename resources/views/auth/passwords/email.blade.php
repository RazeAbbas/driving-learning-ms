@extends('layouts.auth')

@section('content')
<div class="login-registration-wrapper">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="login-page-form-area">
                    <h4 class="title">{{ __('Reset Password') }}</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="single-input-wrapper">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" placeholder="Enter Your Email" required class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button class="rts-btn btn-primary">{{ __('Send Password Reset Link') }}</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-thumbnail-login-p mt--100">
                    <img src="{{asset('assets/images/banner/login-bg.png')}}" width="600" height="495" alt="reset-password-form">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
