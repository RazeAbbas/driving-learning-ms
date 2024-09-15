<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course </title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/nemt_fav_icon.png') }}" />
    <!-- fontawesome 6.4.2 -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/fontawesome-6.css') }}">
    <!-- swiper Css 10.2.0 -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper.min.css') }}">
    <!-- magnific popup css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/magnific-popup.css') }}">
    <!-- Bootstrap 5.0.2 -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/jquery-ui.css') }}">
    <!-- metismenu scss -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/metismenu.css') }}">
    <!-- custom style css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!-- header style one -->
    <header class="header-one v-2 header--sticky">
        <div class="header-top-one-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-top-one">
                            <div class="left-information">
                                <a href="mailto:support@nemtguard.com" class="email"><i
                                        class="fa-light fa-envelope"></i>support@nemtguard.com</a>
                                {{-- <a href="tel:+4733378901" class="email"><i class="fa-light fa-phone"></i>+61 012 012
                                        445</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-one-wrapper">
                        <div class="left-side-header">
                            <a href="{{ url('/') }}" class="py-3 d-block">
                                <img src="{{ asset('assets/images/logo/nemt_white_header_icon.png') }}" alt="logo"
                                    width="270" />
                            </a>
                            <div class="main-nav-one">
                                <nav>
                                    <ul>
                                        <li class="" style="position: static">
                                            <a class="nav-link" href="{{ url('home') }}">Home</a>
                                        </li>
                                        <li class="">
                                            <a class="nav-link" href="{{ url('courses') }}">Courses</a>
                                        </li>
                                        <li class="" style="position: static">
                                            <a class="nav-link" href="{{ url('contact-us') }}">Contact Us</a>
                                        </li>
                                        <li class="">
                                            <a class="nav-link" href="{{ url('about-us') }}">About Us</a>
                                        </li>
                                        @if (Auth::check())
                                            <li class="">
                                                <a class="nav-link" href="{{ url('student/dashboard') }}">Dashboard</a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="header-right-area-one">
                            <div class="actions-area">
                                {{-- <div class="search-btn" id="search">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            viewBox="0 0 22 22" fill="none">
                                            <path
                                            d="M19.9375 18.9652L14.7454 13.7732C15.993 12.2753 16.6152 10.3542 16.4824 8.40936C16.3497 6.46453 15.4722 4.64575 14.0326 3.33139C12.593 2.01702 10.7021 1.30826 8.75326 1.35254C6.8044 1.39683 4.94764 2.19075 3.56924 3.56916C2.19083 4.94756 1.39691 6.80432 1.35263 8.75317C1.30834 10.702 2.0171 12.5929 3.33147 14.0325C4.64584 15.4721 6.46461 16.3496 8.40944 16.4823C10.3543 16.6151 12.2754 15.993 13.7732 14.7453L18.9653 19.9374L19.9375 18.9652ZM2.75 8.93742C2.75 7.71365 3.11289 6.51736 3.79278 5.49983C4.47267 4.4823 5.43903 3.68923 6.56965 3.22091C7.70026 2.7526 8.94436 2.63006 10.1446 2.86881C11.3449 3.10756 12.4474 3.69686 13.3127 4.56219C14.1781 5.42753 14.7674 6.53004 15.0061 7.7303C15.2449 8.93055 15.1223 10.1747 14.654 11.3053C14.1857 12.4359 13.3926 13.4022 12.3751 14.0821C11.3576 14.762 10.1613 15.1249 8.9375 15.1249C7.29703 15.1231 5.72427 14.4706 4.56429 13.3106C3.4043 12.1506 2.75182 10.5779 2.75 8.93742Z"
                                            fill="#235347" />
                                        </svg>
                                    </div> --}}
                                @if (auth()->check())
                                    <a href="{{ url('cart') }}">
                                    @else
                                        <a href="{{ url('login') }}">
                                @endif
                                <div class="position-relative">
                                    <i class="fa-regular fa-cart-shopping fa-lg ms-3" style="color: #235347"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                        style="background-color: #235347" id="cart-qty">
                                        {{ \App\Models\CartItem::where('user_id', @\Auth::user()->id)->count() }}
                                    </span>
                                </div>
                                </a>
                            </div>

                            <div class="buttons-area">
                                @if (!Auth::check())
                                    <a href="{{ url('login') }}" class="rts-btn btn-border">Log In</a>
                                    <a href="{{ url('register') }}" class="rts-btn btn-primary">Sign Up</a>
                                @else
                                    <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                        class="rts-btn btn-primary">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                @endif
                            </div>
                            <div class="menu-btn" id="menu-btn">
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect y="14" width="20" height="2" fill="#1F1F25"></rect>
                                    <rect y="7" width="20" height="2" fill="#1F1F25"></rect>
                                    <rect width="20" height="2" fill="#1F1F25"></rect>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header style end -->

    <!-- rts lession details area start -->
    <div class="rts-lession-details-area-start">
        <div class="rts-lession-content-wrapper">
            <div class="rts-lession-left">
                <div class="content-wrapper">
                    <div class="inner-content">
                        <h4>{{ $course->course_name }}</h4>
                        {{-- <div class="progress-wrapper-lesson-compleate">
                        <div class="compleate">
                            <div class="compl">
                                Complete
                            </div>
                            <div class="end">
                                <span>{{ $order_item->progress }}%</span>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar wow fadeInLeft bg--primary" role="progressbar"
                            style="width: {{ $order_item->progress }}%" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100">
                        </div>
                    </div>
                </div> --}}
                    </div>
                </div>
                <!-- course content accordion area -->
                <div class="course-content-wrapper-main">
                    <div class="accordion mt--30" id="accordionExample">
                        @foreach ($course->lessons as $lesson)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" +type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $lesson->id }}" aria-expanded="true"
                                        aria-controls="collapse-{{ $lesson->id }}">
                                        <span style="word-wrap: break-word;">{{ $lesson->lesson_name }}</span>
                                        @php
                                            $status = 'Pending'; // Default status to Pending
                                            $assessmentTaken = false; // Flag to check if any assessment is taken

                                            foreach ($lesson->chapters as $chapter) {
                                                $assessment = \App\Models\Assessment::where('course_id', $course->id)
                                                    ->where('lesson_id', $chapter->id)
                                                    ->first();

                                                if ($assessment) {
                                                    $result = \App\Models\AssessmentResult::where(
                                                        'assessment_id',
                                                        $assessment->id,
                                                    )
                                                        ->where('user_id', $user->id)
                                                        ->first();

                                                    if ($result) {
                                                        $assessmentTaken = true; // Assessment result exists
                                                        if ($result->status == 'Pass') {
                                                            $status = 'Pass';
                                                            break;
                                                        } elseif ($result->status == 'Fail') {
                                                            $status = 'Fail';
                                                        }
                                                    }
                                                }
                                            }

                                            if (!$assessmentTaken) {
                                                $status = 'Pending'; // Set status to Pending if no assessment result found
                                            }
                                        @endphp

                                        @if ($status == 'Pass')
                                            <span class="badge bg-success text-white rounded-pill">Pass</span>
                                        @elseif ($status == 'Fail')
                                            <span class="badge bg-danger text-white rounded-pill">Fail</span>
                                        @else
                                            <span class="badge bg-secondary text-white rounded-pill">Pending</span>
                                        @endif

                                        {{-- <span>
                            {{ floor($lesson->chapters->sum('duration') / 3600) }} :
                            {{ floor(($lesson->chapters->sum('duration') % 3600) / 60) }} :
                            {{ floor($lesson->chapters->sum('duration') % 60) }}
                        </span> --}}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $lesson->id }}" class="accordion-collapse collapse "
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach ($lesson->chapters as $key => $chapter)
                                            <!-- play single area start -->
                                            <a href="#" class="play-vedio-wrapper play-chapter-video"
                                                chapter-id="{{ $chapter->id }}">
                                                <div class="left">
                                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                                    <span style="text-decoration: none!important; color: inherit;">
                                                        Lesson {{ $key + 1 }}: {{ $chapter->chapter_name }}
                                                    </span>
                                                </div>
                                                {{-- <div class="right">
                            <span class="play">
                                Preview
                            </span>
                            <span>
                                {{ floor($chapter->duration / 3600) }} :
                                {{ floor(($chapter->duration % 3600) / 60) }} :
                                {{ floor($chapter->duration % 60) }}
                            </span>
                        </div> --}}
                                            </a>
                                            <!-- play single area end -->
                                            {{-- @if ($order_item->assessment_result->status == 'Pass' && !empty($order_item->assessment_result->course->certification)) --}}
                                            <hr>
                                            <p class="text-warning">Take quiz after Completing the Lesson</span>
                                                <a href="{{ url('student/start-assessment', ['course' => $course->id, 'lesson' => $lesson->id]) }}"
                                                    class="rts-btn btn-primary with-arrow mt-5 btn-block"
                                                    style="text-align: center;display: block;max-width: 100%; padding: 5px 29px; border-radius:9px!important; transition: 0.3s; font-weight: 500;">Take
                                                    Quiz <i class="fa-light fa-arrow-right"></i>
                                                </a>
                                                {{-- @endif --}}
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- @dd($order_item) --}}
                        {{-- @if (isset($order_item) && $order_item->progress == '100') --}}
                        {{-- <div class="w-100">
                @if ($allPassed && !empty($course->certification))
                <a href="{{ url('user/download-certificate', $order_item->assessment_result->id) }}"
                    class="rts-btn  w-100 py-2 mt-3"
                    style="text-decoration: none; line-height: 25px;">
                    <i class="fas fa-download"></i> Download Certificate
                </a>
                @else
                <div class="text-center">
                    <span class="badge bg-warning text-white rounded-pill mt-5 ">Certificate Pending</span>
                </div>
                @endif
            </div> --}}
                        <div class="w-100">
                            @if ($allPassed && !empty($course->certification))
                                @if (isset($assessmentResults[0]))
                                    <div class="text-center text-center d-flex justify-content-center mt-5">
                                        <a href="{{ url('student/download-certificate', $assessmentResults[0]->id) }}"
                                            class="rts-btn btn-primary with-arrow mt-5 btn-block" style="text-align: center;display: block;max-width: 100%; padding: 5px 29px; border-radius:9px!important; transition: 0.3s; font-weight: 500;">
                                            <i class="fas fa-download"></i> Download Certificate
                                        </a>
                                    </div>
                                @endif
                            @else
                            <div class="container mt-5"  id="myAlert">
                                <div class="alert alert-danger alert-dismissable" id="myAlert2">
                                    {{-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> --}}
                                    You must pass each quiz in order to receive your Certificate of completion
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        {{-- @endif --}}

                    </div>
                    <!-- course content accordion area end -->
                </div>
            </div>
            <div class="rts-lession-right">
                <div class="lesson-top-bar">
                    <div class="left-area">
                        <div class="toggle-class" id="toggle-left-back">
                            <i class="fa-light fa-chevron-left"></i>
                        </div>
                        <span>Course Content</span>
                    </div>
                    <div class="right">
                        <a href="{{ url('student/courses') }}"><i class="fa-solid fa-x"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            {{-- <div class="card-body"> 
                    <video width="100%" src=" {{ asset($first_video) }}" controls autoplay
                    id="chapter-video-player" course-id={{ $course->id }}
                    chapter-id={{ @$first_chapter_id }}> </video>
                </div> --}}
                        </div>
                    </div>
                </div>
                <div class="lesson-bottom-area">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title p-3">Lesson Content</h5>
                            {{-- <h5>you must pass each quiz in order to receive your certificate of completion</h5> --}}
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="disc px-4" id="chapter-description" course-id={{ $course->id }}
                                chapter-id={{ @$first_chapter_id }}>
                                {!! $first_chapter_detail !!}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="next-prev-area">
        <div class="prev">
            <i class="fa-sharp fa-solid fa-play"></i>
            Prev
        </div>
        <div class="next">
            Prev
            <i class="fa-sharp fa-solid fa-play"></i>
        </div>
    </div> --}}
            </div>
        </div>
    </div>
    <!-- rts lession details area end -->






    <div id="anywhere-home" class="">
    </div>

    <!-- all scripts -->

    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    <!-- jquery min js -->
    <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
    <!-- jquery ui js -->
    <script src="{{ asset('assets/js/vendor/jquery-ui.js') }}"></script>
    <!-- metismenu js -->
    <script src="{{ asset('assets/js/vendor/metismenu.js') }}"></script>
    <!-- magnific popup js-->
    <script src="{{ asset('assets/js/vendor/magnifying-popup.js') }}"></script>
    <!-- swiper JS 10.2.0 -->
    <script src="{{ asset('assets/js/plugins/swiper.js') }}"></script>
    <!-- counterup js -->
    <script src="{{ asset('assets/js/plugins/counterup.js') }}"></script>
    <!-- waypoint js -->
    <script src="{{ asset('assets/js/vendor/waypoint.js') }}"></script>
    <!-- wow js -->
    <script src="{{ asset('assets/js/vendor/waw.js') }}"></script>
    <!-- isotop mesonary -->
    <script src="{{ asset('assets/js/plugins/isotop.js') }}"></script>
    <!-- jquery imageloaded -->
    <script src="{{ asset('assets/js/plugins/imagesloaded.pkgd.min.js') }}"></script>
    <!-- resize sensor js -->
    <script src="{{ asset('assets/js/plugins/resizer-sensor.js') }}"></script>
    <!-- sticky sidebar -->
    <script src="{{ asset('assets/js/plugins/sticky-sidebar.js') }}"></script>
    <!-- gsap twinmax js -->
    <script src="{{ asset('assets/js/plugins/twinmax.js') }}"></script>
    <!-- chroma js -->
    <script src="{{ asset('assets/js/vendor/chroma.min.js') }}"></script>
    <!-- bootstrap 5.0.2 -->
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <!-- dymanic Contact Form -->
    <script src="{{ asset('assets/js/plugins/contact.form.js') }}"></script>
    <!-- calender js -->
    <script src="{{ asset('assets/js/plugins/calender.js') }}"></script>
    <!-- main Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('body').on('click', '.play-chapter-video', function(e) {
                e.preventDefault();
                let id = $(this).attr('chapter-id');
                let data = {
                    id: id,
                    expectsJson: true,
                    _token: "{{ csrf_token() }}"
                };
                $.ajax({
                    url: "{{ route('course.chapter') }}",
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        console.log(response.file);
                        $('#chapter-video-player').attr('src', "{{ asset('') }}" + response
                            .file);
                        $('#chapter-video-player').attr('chapter-id', response.id);
                        console.log(response.description);
                        $('#chapter-description').html(response.description);
                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            });




            // Set an interval function to trigger the AJAX request every 5 seconds
            setInterval(function() {
                var video = document.getElementById('chapter-video-player');
                // Check if the video is playing
                if (!video.paused && !video.ended && video.readyState > 2) {
                    // Get the current time of the video
                    var currentTime = video.currentTime;

                    // Get the course ID and chapter ID attributes
                    var courseId = $('#chapter-video-player').attr('course-id');
                    var chapterId = $('#chapter-video-player').attr('chapter-id');

                    // Make an AJAX request to send the current time, course ID, and chapter ID to the server
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('course.progress') }}',
                        data: {
                            currentTime: currentTime,
                            courseId: courseId,
                            chapterId: chapterId,
                            expectsJson: true,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Handle success
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error('Error saving video progress:', error);
                        }
                    });
                }
            }, 5000); // 5000 milliseconds = 5 seconds
        });
    </script>
    <script>
        function showAlert() {
            if ($("#myAlert").find("div#myAlert2").length == 0) {
                $("#myAlert").append(
                    "<div class='alert alert-danger alert-dismissable' id='myAlert2'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> You must pass each quiz in order to receive your Certificate of completion</div>"
                    );
            }
            $("#myAlert").css("display", "");
        }
    </script>
</body>

</html>
