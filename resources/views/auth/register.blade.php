@extends('layouts.auth')

@section('content')
<div class="login-registration-wrapper">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="login-page-form-area">
                    <h4 class="title">Sign Up to Your Account👋</h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="single-input-wrapper">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" name="name" type="text" placeholder="Enter Your Name" class="@error('name') is-invalid @enderror"  value="{{ old('name') }}" required  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                             @enderror
                        </div>
                        <div class="single-input-wrapper">
                            <label for="email">Email*</label>
                            <input id="email" type="email" name="email" placeholder="Enter Your Email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                            <div class="single-input-wrapper">
                                <label for="password">{{ __('Password') }}</label>
                                <input name="password" id="password" type="password" placeholder="Password" class=" @error('password') is-invalid @enderror" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="single-input-wrapper">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" placeholder="Confirm Password"  name="password_confirmation" required autocomplete="new-password">
                            </div>
                        <div class="single-checkbox-filter">
                            <div class="check-box">
                                <input type="checkbox" id="type-1" required>
                                <label for="type-1">Accept the Terms and Privacy Policy</label><br>
                            </div>
                        </div>
                        <button class="rts-btn btn-primary">Sign Up</button>
                        <p>Already Have an account? <a href="{{url('login')}}">Login</a></p>
                    </form>
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
