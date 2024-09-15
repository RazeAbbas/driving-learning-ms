@extends('layouts.auth')
@section('content')
<div class="login-registration-wrapper">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="login-page-form-area">
                    <h4 class="title">Login to Your Account👋</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="single-input-wrapper">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" placeholder="Enter Your Email" required class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                             @enderror
                        </div>
                        <div class="single-input-wrapper">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" placeholder="Password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="single-checkbox-filter mb-3">
                            {{-- <div class="check-box">
                                <input type="checkbox" id="type-1" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">{{ __('Remember Me') }}</label><br>
                            </div> --}}
                            <div class="check-box">
                                <p><a href="{{ route('password.request') }}">Forgot Password?</a></p>
                            </div>

                        </div>
                        <button class="rts-btn btn-primary">Login</button>
                    </form>
                    <p>Don't Have an account? <a href="{{url('register')}}">Registration</a></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-thumbnail-login-p mt--100">
                    <img src="assets/images/banner/login-bg.png" width="600" height="495" alt="login-form">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
