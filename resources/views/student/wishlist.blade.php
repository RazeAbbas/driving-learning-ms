@extends('layouts.student')
@section('content')
    <div class="col-lg-9">
        <div class="exrolled-course-wrapper-dashed">
            <h5 class="title">Wishlist</h5>
            <div class="row g-5">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <!-- rts single course start -->
                        <div class="rts-single-course">
                            <a href="{{ url('course/details', $course->id) }}" class="thumbnail">
                                <img src="{{ asset('storage/upload/270x200-' . $course->featured_img) }}" alt="course">
                            </a>
                            <a href="{{route('wishlist.remove',$course->id)}}">
                                <div class="save-icon">
                                    <i class="fa fa-remove"></i>
                                </div>
                            </a>
                            <div class="lesson-studente">
                                <div class="lesson">
                                    <i class="fa-light fa-calendar-lines-pen"></i>
                                    <span>{{ $course->lessons->count() }} Lessons</span>
                                </div>
                                <div class="lesson">
                                    <i class="fa-light fa-user-group"></i>
                                    <span>0 Students</span>
                                </div>
                            </div>
                            <a href="{{ url('course/details', $course->id) }}">
                                <h5 class="title">{{ $course->course_name }}</h5>
                            </a>
                            <p class="teacher">{{ $course->instructor->name }}</p>
                            <div class="rating-and-price">
                                <div class="rating-area">
                                    <span>4.5</span>
                                    <div class="stars">
                                        <ul>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="price-area">
                                    <div class="price">
                                        {{ $course->price }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- rts single course end -->
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
@endsection
