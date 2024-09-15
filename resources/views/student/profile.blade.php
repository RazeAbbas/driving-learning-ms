@extends('layouts.student')
@section('content')
    <div class="col-lg-9">
        <div class="login-page-form-area"
            style="width: 100% !important; max-width: 100%; box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.05);">
            <form action="{{ url('/student/profile') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex half-input-wrapper mb-5">
                    <img src="{{ asset('storage/images/' . Auth::user()->image) }}" width="150" height="150"
                        alt="" class="border border-1" id="profile-image-update">
                    <input id="image" type="file" class="form-control" name="image"
                        style="height:30px; font-size: 15px; width: 220px;">
                </div>
                <div class="single-input-wrapper">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                </div>
                <div class="half-input-wrapper">
                    <div class="single-input-wrapper">
                        <label for="username">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                    </div>
                    <div class="single-input-wrapper">
                        <label for="gender">Gender</label>
                        <select class="form-select" name="gender" id="gender" style="height: 55px; font-size: 17px">
                            <option value="Male" @if ($student->gender == 'Male') selected @endif>Male</option>
                            <option value="Female" @if ($student->gender == 'Female') selected @endif>Female</option>
                        </select>
                    </div>
                </div>
                <div class="half-input-wrapper">
                    <div class="single-input-wrapper">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}"
                            readonly="">
                    </div>
                    <div class="single-input-wrapper">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}">
                    </div>
                </div>
                <div class="half-input-wrapper">
                    <div class="single-input-wrapper">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="New Password">
                    </div>
                    <div class="single-input-wrapper">
                        <label for="passwords">Confirm Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="confirm_password" placeholder="Confirm Password">
                    </div>
                </div>
                <button class="rts-btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
@endsection
