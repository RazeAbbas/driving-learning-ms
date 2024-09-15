@extends('layouts.app')
@section('content')
    <!-- course details breadcrumb -->
    <div class="course-details-breadcrumb-1 bg_image rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-course-left-align-wrapper">
                        <div class="meta-area">
                            <a href="{{ url('home') }}">Home</a>
                            <i class="fa-solid fa-chevron-right"></i>
                            <a class="active" href="#">Course Details</a>
                        </div>
                        <h1 class="title">
                            {{ $course->course_name }}
                        </h1>
                        <!-- <div class="rating-area">
                            <div class="stars-area">
                                <span>4.5</span>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <div class="students">
                                <i class="fa-thin fa-users"></i>
                                <span>3054 Students</span>
                            </div>

                        </div> 
                        <div class="author-area">
                            <div class="author">
                                @if ($instructor->image != null)
                                    <img src="{{ asset('storage/images/' . $instructor->image) }}" alt="breadcrumb"
                                        height="40" width="40">
                                @else
                                    <img src="{{ asset('assets/images/breadcrumb/nemt_user.png') }}" alt="breadcrumb"
                                        height="40" width="40">
                                @endif
                                <h6 class="name"><span>By</span> {{ $instructor->name }}</h6>
                            </div>
                            <p> <span>Category: </span> {{ $course->category->title }}</p>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- course details breadcrumb end -->


    <!-- course details area start -->
    <div class="rts-course-area rts-section-gap">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8 order-cl-1 order-lg-1 order-md-2 order-sm-2 order-2">
                    <div class="course-details-btn-wrapper pb--50">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Course
                                    Information</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">Course
                                    Content</button>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Instructor</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts"
                                    type="button" role="tab" aria-controls="contacts"
                                    aria-selected="false">Review</button>
                            </li> -->
                        </ul>
                    </div>
                    <div class="tab-content mt--50" id="myTabContent">
                        <div class="tab-pane fade  show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="course-content-wrapper">
                                <h5 class="title">About Course</h5>
                                <p class="disc">
                                    {{ $course->short_detail }}
                                </p>
                                <h5 class="title">Description</h5>
                                <p class="disc">
                                    {{ $course->long_detail }}
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="course-content-wrapper-main">
                                <h5 class="title">Course Content</h5>

                                <!-- course content accordion area -->
                                <div class="accordion mt--30" id="accordionExample">
                                    @foreach ($lessons as $key => $lesson)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ $key }}" aria-expanded="false"
                                                    aria-controls="collapse-{{ $key }}">
                                                    <span>{{ $lesson->lesson_name }}</span>
                                                    <span>{{ $lesson->chapters->count() }} Chapters</span>
                                                </button>
                                            </h2>
                                            <div id="collapse-{{ $key }}" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                @if ($lesson->chapters->count() > 0)
                                                    <div class="accordion-body">
                                                        @foreach ($lesson->chapters as $chapter)
                                                            <!-- play single area start -->
                                                            <a href="#" class="play-vedio-wrapper">
                                                                <div class="left">
                                                                    <i class="fa-light fa-circle-play"></i>
                                                                    <span>{{ $chapter->chapter_name }}</span>
                                                                </div>
                                                                <div class="right">
                                                                    <i class="fa-regular fa-lock"></i>
                                                                </div>
                                                            </a>
                                                            <!-- play single area end -->
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <!-- course content accordion area end -->
                            </div>
                        </div>
                        <div class="tab-pane fade " id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <!-- single instructor area staret -->
                            <div class="single-instructor-area-details">
                                <a href="#" class="thumbnail">
                                    <img src="{{ asset('storage/images/' . $instructor->image) }}" alt="instructor"
                                        width="120" height="120">
                                </a>
                                <div class="inner-instrustor-area">
                                    <h5 class="title">{{ $instructor->name }}</h5>
                                    <span class="deg">{{ $instructor->instructor_degree }}</span>
                                    <div class="stars-area-wrapper">

                                        {{-- <div class="users-area">
                                            <i class="fa-light fa-users"></i>
                                            <span>1350 Students</span>
                                        </div> --}}
                                        <div class="users-area">
                                            <i class="fa-light fa-video"></i>
                                            <span>{{ $instructor->courses->count() }} Courses</span>
                                        </div>
                                    </div>
                                    <div class="follow-us">
                                        <span>Follow</span>
                                        <ul>
                                            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single instructor area end -->
                        </div>

                        <div class="tab-pane fade " id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                            <div class="rating-main-wrapper">
                                <!-- single-top-rating -->
                                {{-- <div class="rating-top-main-wrapper">
                                    <!-- rating area start -->
                                    <div class="rating-area-main-wrapper">
                                        <h2 class="title">5.0</h2>
                                        <div class="stars-wrapper">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <span>Total {{ count($course->course_reviews) }} Ratings</span>
                                    </div>
                                    <!-- rating area end -->
                                    <div class="progress-wrapper-main">
                                        <div class="single-progress-area-h" data-sal-delay="150" data-sal="slide-up"
                                            data-sal-duration="800">
                                            <div class="progress-top">
                                                <i class="fa-regular fa-star"></i>
                                                <span class="parcent">
                                                    5
                                                </span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar wow fadeInLeft bg--primary" role="progressbar"
                                                    style="width: 0%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="end">
                                                <span>25 Rating</span>
                                            </div>
                                        </div>
                                        <div class="single-progress-area-h" data-sal-delay="150" data-sal="slide-up"
                                            data-sal-duration="800">
                                            <div class="progress-top">
                                                <i class="fa-regular fa-star"></i>
                                                <span class="parcent">
                                                    4
                                                </span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar wow fadeInLeft bg--primary" role="progressbar"
                                                    style="width: 0%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="end">
                                                <span>20 Rating</span>
                                            </div>
                                        </div>
                                        <div class="single-progress-area-h" data-sal-delay="150" data-sal="slide-up"
                                            data-sal-duration="800">
                                            <div class="progress-top">
                                                <i class="fa-regular fa-star"></i>
                                                <span class="parcent">
                                                    3
                                                </span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar wow fadeInLeft bg--primary" role="progressbar"
                                                    style="width: 0%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="end">
                                                <span>5 Rating</span>
                                            </div>
                                        </div>
                                        <div class="single-progress-area-h" data-sal-delay="150" data-sal="slide-up"
                                            data-sal-duration="800">
                                            <div class="progress-top">
                                                <i class="fa-regular fa-star"></i>
                                                <span class="parcent">
                                                    2
                                                </span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar wow fadeInLeft bg--primary" role="progressbar"
                                                    style="width: 0%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="end">
                                                <span>2 Rating</span>
                                            </div>
                                        </div>
                                        <div class="single-progress-area-h" data-sal-delay="150" data-sal="slide-up"
                                            data-sal-duration="800">
                                            <div class="progress-top">
                                                <i class="fa-regular fa-star"></i>
                                                <span class="parcent">
                                                    1
                                                </span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar wow fadeInLeft bg--primary" role="progressbar"
                                                    style="width: 0%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="end">
                                                <span>1 Rating</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="rating-top-main-wrapper">
                                    <!-- rating area start -->
                                    <div class="rating-area-main-wrapper">
                                        <h2 class="title">5.0</h2>
                                        <div class="stars-wrapper">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <span>Total {{ count($course->course_reviews) }} Ratings</span>
                                    </div>
                                    <!-- rating area end -->
                                    <div class="progress-wrapper-main">
                                        <?php
                                        /* Initialize an array to hold ratings and their counts */
                                        $ratings = [
                                            5 => 0,
                                            4 => 0,
                                            3 => 0,
                                            2 => 0,
                                            1 => 0
                                        ];
                                
                                        /* Calculate ratings and their counts */
                                        foreach ($course->course_reviews as $review) {
                                            $rating = $review->rating;
                                            $ratings[$rating]++;
                                        }
                                
                                        /* Calculate total ratings */
                                        $total_ratings = array_sum($ratings);
                                
                                        /* Loop through ratings and render progress bars */
                                        foreach ($ratings as $rating => $count) {
                                            $percentage = ($total_ratings > 0) ? ($count / $total_ratings) * 100 : 0;
                                        ?>
                                        <div class="single-progress-area-h" data-sal-delay="150" data-sal="slide-up"
                                            data-sal-duration="800">
                                            <div class="progress-top">
                                                <i class="fa-regular fa-star"></i>
                                                <span class="parcent">
                                                    <?php echo $rating; ?>
                                                </span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar wow fadeInLeft bg--primary" role="progressbar"
                                                    style="width: <?php echo $percentage; ?>%"
                                                    aria-valuenow="<?php echo $count; ?>" aria-valuemin="0"
                                                    aria-valuemax="<?php echo $total_ratings; ?>">
                                                </div>
                                            </div>
                                            <div class="end">
                                                <span><?php echo $count; ?> Rating</span>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <!-- single-top-rating end-->
                                <!-- person indevidual rating area  -->
                                <div class="indevidual-rating-area">
                                    @if (count(@$course->course_reviews) > 0)
                                        @foreach (@$course->course_reviews as $key => $value)
                                            <!-- author-area -->
                                            <div class="author-area">
                                                @if (@file_get_contents(asset('storage/images/' . @$value->user->image)))
                                                    <img src="{{ asset('storage/images/' . @$value->user->image) }}"
                                                        alt="Comment Images" width="60" height="60">
                                                @else
                                                    <img src="{{ asset('assets/images/dummy.png') }}"
                                                        alt="Comment Images" width="60" height="60">
                                                @endif
                                                <div class="information">
                                                    <span>{{ @$value->user->name }}</span>
                                                    <div class="stars rating">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                        <span
                                                            class="ml--30">{{ date('d F, Y', $value->created_at) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- author-area end -->
                                            <p class="disc">
                                                {{ @$value->description }}
                                            </p>
                                            <div class="like-love-area">
                                                <a href="#">
                                                    <i class="fa-sharp fa-light fa-thumbs-up"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa-regular fa-heart"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="comment">
                                            <p class="text-center">No comment found.</p>
                                        </div>
                                    @endif
                                </div>
                                <!-- person indevidual rating area end -->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-cl-2 order-lg-2 order-md-1 order-sm-1 order-1  rts-sticky-column-item">
                    <!-- right- sticky bar area -->
                    <div class="right-course-details">
                        <!-- single course-sidebar -->
                        <div class="course-side-bar">
                            <div class="thumbnail">
                                <img src="{{ asset('storage/upload/370x250-' . $course->featured_img) }}" alt="img">
                                {{-- <div class="vedio-icone">
                                    <a class="video-play-button play-video popup-video"
                                        href="{{ asset($course->featured_video) }}">
                                        <span></span>
                                    </a>
                                    <div class="video-overlay">
                                        <a class="video-overlay-close">×</a>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="price-area">
                                @if ($hasDiscount)
                                    <h3 class="title">${{ $discountPrice }}</h3>
                                    <h4 class="none">${{ $course->price }}</h4>
                                    <span class="discount">- {{ $course->discount }} %</span>
                                @else
                                    <h3 class="title">${{ $course->price }}</h3>
                                @endif

                            </div>
                            @if ($hasDiscount)
                                <div class="clock-area">
                                    <i class="fa-light fa-clock"></i>
                                    <span>{{ $daysleft }} Day left at this price!</span>
                                </div>
                            @endif
                            @if (Auth::check() && Auth::user()->role == '3')
                                <form action="{{ url('/cart/add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <button type="button" id="add-to-cart" course-id="{{ $course->id }}"
                                        class="rts-btn btn-primary">Add To Cart</button>
                                </form>
                            @else
                                <button href="#" id="add-to-cart" course-id="{{ $course->id }}"
                                    class="rts-btn btn-primary disabled-add-btn">Add To Cart</button>
                            @endif

                            <div class="what-includes">
                                <hr>
                                <div class="single-include">
                                    <div class="left">
                                        <i class="fa-sharp fa-light fa-file-certificate"></i>
                                        <span>Certificate</span>
                                    </div>
                                    <div class="right">
                                        <span>Certificate of completion </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single course-sidebar end -->
                    </div>
                    <!-- right- sticky bar area end -->
                    <!-- right- sticky bar area -->
                    <div class="right-course-details mt--30">
                        <!-- single course-sidebar -->
                        <div class="course-side-bar">
                            <!-- course single sidebar -->
                            <div class="course-single-information">
                                <h5 class="title">A course by</h5>
                                <div class="body">
                                    <div class="author">
                                        <img src="assets/images/course/13.png" alt="">
                                        <span>{{ $instructor->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- course single sidebar end-->
                            <!-- course single sidebar -->
                            <div class="course-single-information">
                                <h5 class="title">Material Includes</h5>
                                <div class="body">
                                    <!-- ingle check -->
                                    <div class="single-check">
                                        <i class="fa-light fa-circle-check"></i>
                                        Flexible Deadlines
                                    </div>
                                    <!-- ingle check end -->
                                    <!-- ingle check -->
                                    {{-- <div class="single-check">
                                        <i class="fa-light fa-circle-check"></i>
                                        Hours of live- demo
                                    </div> --}}
                                    <!-- ingle check end -->
                                    <!-- ingle check -->
                                    {{-- <div class="single-check">
                                        <i class="fa-light fa-circle-check"></i>
                                        Hours of live- demo
                                    </div> --}}
                                    <!-- ingle check end -->
                                    <!-- ingle check -->
                                    {{-- <div class="single-check">
                                        <i class="fa-light fa-circle-check"></i>
                                        200+ downloadable resoursces
                                    </div> --}}
                                    <!-- ingle check end -->
                                </div>
                            </div>
                            <!-- course single sidebar end-->
                            <!-- course single sidebar -->
                            <!-- <div class="course-single-information">
                                <h5 class="title">Share</h5>
                                <div class="body">
                                    <div class="social-share-course-side-bar">
                                        <ul>
                                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                            <!-- course single sidebar end-->
                        </div>
                        <!-- single course-sidebar end -->
                    </div>
                    <!-- right- sticky bar area end -->
                </div>
            </div>
        </div>
    </div>
    <!-- course details area end -->


    <!-- course area start -->
    {{-- <div class="rts-section-gapBottom  rts-feature-course-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-between-area">
                        <div class="title-area-left-style">
                            <div class="pre-title">
                                <img src="{{ asset('assets/images/banner/bulb.png') }}" alt="icon">
                                <span>More Similar Courses</span>
                            </div>
                            <h2 class="title">Related Courses</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt--50 ">
                <div class="col-lg-12">
                    <div class="swiper swiper-float-right-course swiper-data"
                        data-swiper='{
                "spaceBetween":30,
                "slidesPerView":4,
                "loop": true,
                "autoplay":{
                    "delay":"2000"
                },
                "breakpoints":{
                "0":{
                    "slidesPerView":1,
                    "spaceBetween":30},
                "320":{
                    "slidesPerView":1,
                    "spaceBetween":30},
                "480":{
                    "slidesPerView":1,
                    "spaceBetween":30},
                "640":{
                    "slidesPerView":2,
                    "spaceBetween":30},
                "1100":{
                    "slidesPerView":3,
                    "spaceBetween":30},
                "1200":{
                    "slidesPerView":4,
                    "spaceBetween":30}
                }
            }'>
                        <div class="swiper-wrapper">
                            @foreach ($related_courses as $related_course)
                                <div class="swiper-slide">
                                    <!-- single course style two -->
                                    <div class="rts-single-course">
                                        <a href="{{ url('course/details', $related_course->id) }}" class="thumbnail">
                                            <img src="{{ asset('storage/upload/298x200-' . $related_course->featured_img) }}"
                                                alt="course" />
                                        </a>
                                        <div class="save-icon" id="add-to-wishlist" course-id={{ $related_course->id }}>
                                            <i class="fa-sharp fa-light fa-bookmark"></i>
                                        </div>
                                        <div class="lesson-studente">
                                            <div class="lesson">
                                                <i class="fa-light fa-calendar-lines-pen"></i>
                                                <span>{{ $related_course->lessons->count() }} Lessons</span>
                                            </div>
                                            <div class="lesson">
                                                <i class="fa-light fa-user-group"></i>
                                                <span>54 Students</span>
                                            </div>
                                        </div>
                                        <a href="{{ url('course/details', $related_course->id) }}">
                                            <h5 class="title">
                                                {{ $related_course->course_name }}
                                            </h5>
                                        </a>
                                        <p class="teacher">{{ $related_course->instructor->name }}</p>
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
                                                <div class="price">${{ $related_course->price }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single course style two end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- course area end -->
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Retrieve user ID from the hidden input field
            var userId = $('#user_id').val();

            $(document).on('click', '#add-to-cart', function(e) {
                e.preventDefault();
                let courseId = $(this).attr('course-id');
                checkCart(courseId, userId, function(response) {
                    if (response.flag === 'error') {
                        toastr.error(response.message);
                    } else {
                        checkEnrollment(courseId, userId, function(response) {
                            if (response.flag === 'error') {
                                toastr.error(response.message);
                            } else {
                                addToCart(courseId, userId);
                            }
                        });
                    }
                });
            });

            $('body').on('click', '.disabled-add-btn', function(e) {
                toastr.error('Please login as student to add to cart');
            });
        });

        function checkCart(courseId, userId, callback) {
            let data = {
                course_id: courseId,
                user_id: userId,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "{{ route('cart.product.check') }}",
                type: 'POST',
                data: data,
                success: function(response) {
                    callback(response);
                },
                error: function(error) {
                    console.log(error);
                    toastr.error('Error occurred. Please try again later.');
                }
            });
        }

        function checkEnrollment(courseId, userId, callback) {
            let data = {
                course_id: courseId,
                user_id: userId,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "{{ route('enrolled.product.check') }}",
                type: 'POST',
                data: data,
                success: function(response) {
                    callback(response);
                },
                error: function(error) {
                    console.log(error);
                    toastr.error('Error occurred. Please try again later.');
                }
            });
        }

        function addToCart(courseId, userId) {
            let data = {
                course_id: courseId,
                user_id: userId,
                _token: "{{ csrf_token() }}"
            };
            $.ajax({
                url: "{{ route('cart.add') }}",
                type: 'POST',
                data: data,
                success: function(response) {
                    if(response.flag == true) {
                        toastr.success('Product Added to Cart');
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function(error) {
                    console.log(error);
                    toastr.error('Error occurred. Please try again later.');
                }
            });
        }
    </script>
@endsection
