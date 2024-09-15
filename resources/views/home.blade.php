@extends('layouts.app')
@section('content')
    <!-- banner area start -->
    <div class="banner-two-flow-1920">
        <div class="banner-area-one v-2 bg_image shape-move">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 order-xl-1 order-lg-1 order-md-2 order-sm-2 order-2">
                        <div class="banner-content-one">
                            <div class="inner">
                                <div class="pre-title-banner">
                                    <img src="assets/images/banner/bulb-3.png" width="22" alt="icon" />
                                    <span>Gateway to Lifelong Learning</span>
                                </div>
                                <h1 class="title-banner">
                                    Welcome to NEMTGUARD
                                    <span>Leading specialized NEMT Driver Safety Course</span>
                                    <img src="assets/images/banner/06.png" alt="banner" />
                                </h1>
                                <p class="disc">
                                    Your premier online destination for comprehensive training in Non-Emergency Medical
                                    Transportation (NEMT) driving.
                                </p>
                                {{-- <form action="#">
                                    <div class="category-search-input">
                                        <div class="select-banner-search-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 15 15" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M0 0H3V3H0V0ZM6 0H9V3H6V0ZM3 6.00001H0V9.00001H3V6.00001ZM6 6.00001H9V9.00001H6V6.00001ZM3 12H0V15H3V12ZM6 12H9V15H6V12Z"
                                                    fill="#235347" />
                                                <path d="M15 0H12V3H15V0Z" fill="#235347" />
                                                <path d="M15 6H12V9H15V6Z" fill="#235347" />
                                                <path d="M15 12H12V15H15V12Z" fill="#235347" />
                                            </svg>
                                            <select class="nice-select" name="price">
                                                <option>All Category</option>
                                                <option value="asc">Design</option>
                                                <option value="desc">Development</option>
                                                <option value="pop">Popularity</option>
                                                <option value="low">Price</option>
                                                <option value="high">Stars</option>
                                            </select>
                                        </div>
                                        <input type="text" placeholder="Find Your Course" required />
                                        <button>Search</button>
                                    </div>
                                </form> --}}

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-xl-2 order-lg-2 order-md-1 order-sm-1 order-1">
                        <div class="banner-right-img">
                            <img src="assets/images/banner/wheel_chair_ford.png" alt="banner" />
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="review-thumb">
                <!-- single review -->
                <div class="review-single">
                    <img src="assets/images/banner/07.png" alt="banner" />
                    <div class="info-right">
                        <h6 class="title">4.5</h6>
                        <span>(2.4k Review)</span>
                    </div>
                </div>
                <!-- single review end -->
                <!-- single review -->
                <div class="review-single two">
                    <img src="assets/images/banner/08.png" alt="banner" />
                    <div class="info-right">
                        <h6 class="title">100+</h6>
                        <span>Online Course</span>
                    </div>
                </div>
                <!-- single review end -->
            </div> --}}
            <!-- banner shape area two -->
            <div class="banner-shape-area-two shape-image">
                <img src="assets/images/banner/shape/16.png" data-speed="0.04" alt="one" class="shape one" />
                <img src="assets/images/banner/shape/17.png" data-speed="0.04" data-revert="true" alt="two"
                    class="shape two" />
                <img src="assets/images/banner/shape/18.png" data-speed="0.04" alt="three" class="shape three" />
                <img src="assets/images/banner/shape/19.png" data-speed="0.04" data-revert="true" alt="four"
                    class="shape four" />
            </div>
            <!-- banner shape area two end -->
        </div>
    </div>
    <!-- banner area end -->


    <!-- offer add section area start -->
    {{-- <div class="offer-add-area rts-section-gapBottom mt-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="course-add-single-one bg_image bg-p">
                        <div class="title-area-left-style">
                            <div class="pre-title">
                                <img src="assets/images/banner/bulb-4.png" alt="icon" />
                                <span>New Course </span>
                            </div>
                            <h2 class="title">
                                Enroll Now and Save Big <br />
                                on Quality Learning
                            </h2>
                            <a href="{{ url('courses') }}" class="rts-btn btn-primary-white">View Course</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="course-add-single-one bg_image bg-y">
                        <div class="title-area-left-style">
                            <div class="pre-title">
                                <img src="assets/images/banner/bulb-5.png" alt="icon" />
                                <span>New Course </span>
                            </div>
                            <h2 class="title">
                                Limited-Time Offer: Enroll <br />
                                Today for Big Savings
                            </h2>
                            <a href="{{ url('courses') }}" class="rts-btn btn-primary hov--white">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- offer add section area end -->

    <!-- course area start -->
    <div class="course-area-two rts-section-gapBottom mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-between-area align-items-end">
                        <div class="title-area-left-style">
                            <div class="pre-title">
                                <img src="assets/images/banner/bulb.png" alt="icon" />
                                <span>Courses</span>
                            </div>
                            <h2 class="title mb--5">Courses Available Now</h2>
                            {{-- <p class="disc">
                                You'll find something to spark your curiosity and enhance
                            </p> --}}
                        </div>
                        <a href="{{ url('courses') }}" class="rts-btn with-arrow p-0">View All Courses <i
                                class="fa-light fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row g-5 mt--20">


                @foreach ($courses as $course)
                    <div class="col-md-3">
                        <div class="swiper-slide">
                            <!-- single course style two -->
                            <div class="rts-single-course">
                                <a href="{{ url('course/details', $course->id) }}" class="thumbnail">
                                    <img src="{{ asset('storage/upload/298x200-' . $course->featured_img) }}"
                                        alt="course" />
                                </a>
                                <div class="save-icon" id="add-to-wishlist" course-id={{ $course->id }}>
                                    <i class="fa-sharp fa-light fa-bookmark"></i>
                                </div>
                                <div class="lesson-studente">
                                    <div class="lesson">
                                        <i class="fa-light fa-calendar-lines-pen"></i>
                                        <span>{{ $course->lessons->count() }} Lessons</span>
                                    </div>
                                    <div class="lesson">
                                        <i class="fa-light fa-user-group"></i>
                                        <span>54 Students</span>
                                    </div>
                                </div>
                                <a href="{{ url('course/details', $course->id) }}">
                                    <h5 class="title">
                                        {{ $course->course_name }}
                                    </h5>
                                </a>
                                <p class="teacher">{{ $course->instructor->name }}</p>
                                <div class="rating-and-price">
                                    {{-- <div class="rating-area">
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
                                        </div> --}}
                                    <div class="price-area">
                                        @if ($course->discount && $course->discount_end_date >= \Carbon\Carbon::now())
                                            @php
                                                $discountedPrice =
                                                    $course->price - $course->price * ($course->discount / 100);
                                            @endphp
                                            <div class="not price">${{ $course->price }}</div>
                                            <div class="price">${{ $discountedPrice }}</div>
                                        @else
                                            <div class="price">${{ $course->price }}</div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <!-- single course style two end -->
                        </div>
                    </div>
                @endforeach

                {{-- <div class="swiper-button-next">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
                <div class="swiper-button-prev">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <div class="swiper-pagination"></div> --}}

            </div>
        </div>
    </div>
    <!-- course area end -->

    <!-- why choose us section area start -->
    <div class="why-choose-us bg-blue bg-choose-us-one bg_image rts-section-gap shape-move">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why-choose-us-area-image pb--50">
                        <img class="one" src="assets/images/why-choose/home-page-nemt-2.png" alt="why-choose" />
                        <div class="border-img">
                            <img class="two ml--20" src="assets/images/why-choose/home-page-nemt.png" alt="why-choose" />
                        </div>
                        {{-- <div class="circle-animation">
                            <a class="uni-circle-text uk-background-white dark:uk-background-gray-80 uk-box-shadow-large uk-visible@m"
                                href="#view_in_opensea">
                                <svg class="uni-circle-text-path uk-text-secondary uni-animation-spin" viewBox="0 0 100 100"
                                    width="140" height="140">
                                    <defs>
                                        <path id="circle" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0">
                                        </path>
                                    </defs>
                                    <text font-size="11.2">
                                        <textPath xlink:href="#circle">
                                            About Univercity • About Collage •
                                        </textPath>
                                    </text>
                                </svg>
                                <i class="fa-regular fa-arrow-up-right"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6 pl--90 mt_md--50 mt_sm--20 pl_md--15 pl_sm--10">
                    <div class="title-area-left-style">
                        <div class="pre-title">
                            <img src="assets/images/banner/bulb-2.png" alt="icon" />
                            <span>Why Choose Us</span>
                        </div>
                        <h2 class="title">NEMTGUARD Your Path to Excellence & Success</h2>
                        <p class="post-title">
                            At NEMTGUARD, we are committed to shaping safe and compassionate drivers-
                            <br />
                            who excel in transporting individuals with care and professionalism.
                        </p>
                    </div>
                    <div class="why-choose-main-wrapper-1">
                        <!-- single choose reason -->
                        {{-- <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets/images/why-choose/icon/01.png" alt="icon" />
                            </div>
                            <h6 class="title">Expert Instructors</h6>
                        </div> --}}
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets/images/why-choose/icon/02.png" alt="icon" />
                            </div>
                            <h6 class="title">Interactive Learning</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets/images/why-choose/icon/03.png" alt="icon" />
                            </div>
                            <h6 class="title">Affordable Learning</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        {{-- <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets/images/why-choose/icon/04.png" alt="icon" />
                            </div>
                            <h6 class="title">Career Advance</h6>
                        </div> --}}
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets/images/why-choose/icon/05.png" alt="icon" />
                            </div>
                            <h6 class="title">Course Selection</h6>
                        </div>
                        <!-- single choose reason end -->
                        <!-- single choose reason -->
                        {{-- <div class="single-choose-reason-1">
                            <div class="icon">
                                <img src="assets/images/why-choose/icon/06.png" alt="icon" />
                            </div>
                            <h6 class="title">Support Community</h6>
                        </div> --}}
                        <!-- single choose reason end -->
                    </div>
                    <a href="{{ url('courses') }}" class="rts-btn btn-primary-white with-arrow">View All Courses <i
                            class="fa-regular fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="shape-image">
            <div class="shape one" data-speed="0.04" data-revert="true">
                <img src="assets/images/banner/15.png" alt="" />
            </div>
            <div class="shape two" data-speed="0.04">
                <img src="assets/images/banner/shape/banner-shape02-w.svg" alt="" />
            </div>
            <div class="shape three" data-speed="0.04" data-revert="true">
                <img src="assets/images/banner/16.png" alt="" />
            </div>
        </div>
    </div>
    <!-- why choose us section area end -->

    <!-- join our team area start -->
    {{-- <div class="join-our-team-area v-1 rts-section-gap shape-move">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="thumbnail-jointeam-one pl--70">
                                        <img src="assets/images/instructor/instructor.png" alt="join" />
                                        <div class="shape-area-one shape-image">
                                            <img src="assets/images/instructor/shape/01.png" alt="shape" data-speed="0.04"
                                            class="shape one" />
                                            <img src="assets/images/instructor/shape/02.png" alt="shape" data-speed="0.04"
                                            data-revert="true" class="shape two" />
                                            <img src="assets/images/instructor/shape/03.png" alt="shape" data-speed="0.04"
                                            class="shape three" />
                                            <img src="assets/images/instructor/shape/04.png" alt="shape" data-speed="0.04"
                                            data-revert="true" class="shape four" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="title-area-left-style">
                                        <div class="pre-title">
                                            <img src="assets/images/banner/bulb.png" alt="icon" />
                                            <span>Joint Our Team</span>
                                        </div>
                                        <h2 class="title">
                                            Join Us Become an Instructor <br />
                                            & Inspire Learning
                                        </h2>
                                        <p class="post-title">
                                            As an instructor with us, you'll have the opportunity to
                                            inspire, guide, and mentor our diverse community of students.
                                            Whether you're an industry expert, an academic guru, or an
                                            experienced professional
                                        </p>
                                        <a href="become-instructor.html" class="rts-btn btn-primary with-arrow">Join Us <i
                                            class="fa-regular fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="shape-area shape-image">
                                <img src="assets/images/instructor/shape/05.png" data-speed="0.04" alt="shape" class="shape" />
                            </div>
                        </div> --}}
    <!-- join our team area end -->
    <!-- rts testimonials area  -->
    {{-- <div class="testimonials-area rts-section-gap mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-area-center-style">
                    <div class="pre-title">
                        <img src="assets/images/banner/bulb.png" alt="icon" />
                        <span>Student Review</span>
                    </div>
                    <h2 class="title">Our Students Feedback</h2>
                    <p class="post-title">
                        You'll find something to spark your curiosity and enhance
                    </p>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="container-full mt--50">
        <div class="row">
            <div class="col-lg-12">
                <div class="marque-main-wrapper-parent-flex">
                    <div class="marquree-wrapper-1">
                        <!-- single testimonials-area -->
                        <div class="single-testimonials-area-1">
                            <div class="stars-area">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <p class="disc">
                                I can't recommend The Gourmet Haven enough. It's a place for
                                special occasions, date nights, or whenever you're in the
                                mood for a culinary.
                            </p>
                            <div class="feedback-author">
                                <img src="assets/images/students-feedback/02.png" alt="students-feedback" />
                                <div class="information">
                                    <h5 class="title">Emma Elizabeth</h5>
                                    <span>Assistant Teacher</span>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonials-area end -->
                        <!-- single testimonials-area -->
                        <div class="single-testimonials-area-1">
                            <div class="stars-area">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <p class="disc">
                                I can't recommend The Gourmet Haven enough. It's a place for
                                special occasions, date nights, or whenever you're in the
                                mood for a culinary.
                            </p>
                            <div class="feedback-author">
                                <img src="assets/images/students-feedback/03.png" alt="students-feedback" />
                                <div class="information">
                                    <h5 class="title">Jack Benjamin</h5>
                                    <span>Assistant Teacher</span>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonials-area end -->
                        <!-- single testimonials-area -->
                        <div class="single-testimonials-area-1">
                            <div class="stars-area">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <p class="disc">
                                I can't recommend The Gourmet Haven enough. It's a place for
                                special occasions, date nights, or whenever you're in the
                                mood for a culinary.
                            </p>
                            <div class="feedback-author">
                                <img src="assets/images/students-feedback/04.png" alt="students-feedback" />
                                <div class="information">
                                    <h5 class="title">Samuel John</h5>
                                    <span>Assistant Teacher</span>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonials-area end -->
                        <!-- single testimonials-area -->
                        <div class="single-testimonials-area-1">
                            <div class="stars-area">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <p class="disc">
                                I can't recommend The Gourmet Haven enough. It's a place for
                                special occasions, date nights, or whenever you're in the
                                mood for a culinary.
                            </p>
                            <div class="feedback-author">
                                <img src="assets/images/students-feedback/05.png" alt="students-feedback" />
                                <div class="information">
                                    <h5 class="title">Samantha Willow</h5>
                                    <span>Assistant Teacher</span>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonials-area end -->
                    </div>
                    <div class="marquree-wrapper-1">
                        <!-- single testimonials-area -->
                        <div class="single-testimonials-area-1">
                            <div class="stars-area">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <p class="disc">
                                I can't recommend The Gourmet Haven enough. It's a place for
                                special occasions, date nights, or whenever you're in the
                                mood for a culinary.
                            </p>
                            <div class="feedback-author">
                                <img src="assets/images/students-feedback/06.png" alt="students-feedback" />
                                <div class="information">
                                    <h5 class="title">Emma Elizabeth</h5>
                                    <span>Assistant Teacher</span>
                                </div>
                            </div>
                        </div>

                        <div class="single-testimonials-area-1">
                            <div class="stars-area">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <p class="disc">
                                I can't recommend The Gourmet Haven enough. It's a place for
                                special occasions, date nights, or whenever you're in the
                                mood for a culinary.
                            </p>
                            <div class="feedback-author">
                                <img src="assets/images/students-feedback/07.png" alt="students-feedback" />
                                <div class="information">
                                    <h5 class="title">Emma Elizabeth</h5>
                                    <span>Assistant Teacher</span>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonials-area end -->
                        <!-- single testimonials-area -->
                        <div class="single-testimonials-area-1">
                            <div class="stars-area">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <p class="disc">
                                I can't recommend The Gourmet Haven enough. It's a place for
                                special occasions, date nights, or whenever you're in the
                                mood for a culinary.
                            </p>
                            <div class="feedback-author">
                                <img src="assets/images/students-feedback/08.png" alt="students-feedback" />
                                <div class="information">
                                    <h5 class="title">Emma Elizabeth</h5>
                                    <span>Assistant Teacher</span>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonials-area end -->
                        <!-- single testimonials-area -->
                        <div class="single-testimonials-area-1">
                            <div class="stars-area">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <p class="disc">
                                I can't recommend The Gourmet Haven enough. It's a place for
                                special occasions, date nights, or whenever you're in the
                                mood for a culinary.
                            </p>
                            <div class="feedback-author">
                                <img src="assets/images/students-feedback/09.png" alt="students-feedback" />
                                <div class="information">
                                    <h5 class="title">Emma Elizabeth</h5>
                                    <span>Assistant Teacher</span>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonials-area end -->
                    </div>
                </div>

            </div>
        </div>
    </div> --}}
    </div>
    <!-- rts testimonials area end -->
    <!-- fun facts area start -->
    {{-- <div class="fun-facts-area-1 shape-move bg_image ptb--50" style="margin-top: 15rem; margin-bottom:15rem;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="fun-facts-main-wrapper-1">
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="assets/images/fun-facts/01.svg" alt="icon" />
                            </div>
                            <h5 class="title"><span class="counter">65,972</span></h5>
                            <span class="enr">Students Enrolled</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="assets/images/fun-facts/02.svg" alt="icon" />
                            </div>
                            <h5 class="title"><span class="counter">5,321</span></h5>
                            <span class="enr">Completed Course</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="assets/images/fun-facts/03.svg" alt="icon" />
                            </div>
                            <h5 class="title"><span class="counter">44,239</span></h5>
                            <span class="enr">Students Learner</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="assets/images/fun-facts/04.svg" alt="icon" />
                            </div>
                            <h5 class="title"><span class="counter">75,992</span></h5>
                            <span class="enr">Students Enrolled</span>
                        </div>
                        <!-- single end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-image">
            <div class="shape one" data-speed="0.04" data-revert="true">
                <img src="assets/images/banner/15.png" alt="" />
            </div>
            <div class="shape three" data-speed="0.04">
                <img src="assets/images/banner/16.png" alt="" />
            </div>
        </div>
    </div> --}}
    <!-- fun facts area end -->


    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('error') }}</p>
        </div>
    @endif
@endsection
@section('script')
@endsection
