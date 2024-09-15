<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ @$page_title ?? 'Student Assessment' }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/nemt_fav_icon.png') }}" />
    <!-- fontawesome 6.4.2 -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/fontawesome-6.css') }}" />
    <!-- swiper Css 10.2.0 -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper.min.css') }}" />
    <!-- magnific popup css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/magnific-popup.css') }}" />
    <!-- Bootstrap 5.0.2 -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" />
    <!-- jquery ui css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/jquery-ui.css') }}" />
    <!-- metismenu scss -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/metismenu.css') }}" />
    <!-- custom style css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    
</head>

<body>
    <!-- header style one -->
    <header class="header-one v-2 header--sticky">
        <div class="header-top-one-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-top-one">
                            <div class="left-information">
                                <a href="mailto:support@nemtguard.com" class="email"><i
                                    class="fa-light fa-envelope"></i>support@nemtguard.com</a>
                                    {{-- <a href="tel:+4733378901" class="email"><i class="fa-light fa-phone"></i>+61 012 012
                                        445</a>
                                    </div> --}}
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
                                    <a href="{{url('/')}}" class="py-3 d-block">
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
                                        <div class="search-btn" id="search">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            viewBox="0 0 22 22" fill="none">
                                            <path
                                            d="M19.9375 18.9652L14.7454 13.7732C15.993 12.2753 16.6152 10.3542 16.4824 8.40936C16.3497 6.46453 15.4722 4.64575 14.0326 3.33139C12.593 2.01702 10.7021 1.30826 8.75326 1.35254C6.8044 1.39683 4.94764 2.19075 3.56924 3.56916C2.19083 4.94756 1.39691 6.80432 1.35263 8.75317C1.30834 10.702 2.0171 12.5929 3.33147 14.0325C4.64584 15.4721 6.46461 16.3496 8.40944 16.4823C10.3543 16.6151 12.2754 15.993 13.7732 14.7453L18.9653 19.9374L19.9375 18.9652ZM2.75 8.93742C2.75 7.71365 3.11289 6.51736 3.79278 5.49983C4.47267 4.4823 5.43903 3.68923 6.56965 3.22091C7.70026 2.7526 8.94436 2.63006 10.1446 2.86881C11.3449 3.10756 12.4474 3.69686 13.3127 4.56219C14.1781 5.42753 14.7674 6.53004 15.0061 7.7303C15.2449 8.93055 15.1223 10.1747 14.654 11.3053C14.1857 12.4359 13.3926 13.4022 12.3751 14.0821C11.3576 14.762 10.1613 15.1249 8.9375 15.1249C7.29703 15.1231 5.72427 14.4706 4.56429 13.3106C3.4043 12.1506 2.75182 10.5779 2.75 8.93742Z"
                                            fill="#235347" />
                                        </svg>
                                    </div>
                                    <a href="{{ url('cart') }}">
                                        <div class="position-relative">
                                            <i class="fa-regular fa-cart-shopping fa-lg ms-3" style="color: #235347"></i>
                                            <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                            style="background-color: #235347"
                                            id="cart-qty">{{ \App\Models\CartItem::where('user_id',@\Auth::user()->id)->count() }}</span>
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
<div class="dashboard--area-main pt--100">
    <div class="container">
        @yield('content')
    </div>
</div>
<div class="rts-section-gap">
    
</div>



<!-- footer dashboards area -->
<div class="footer-dashboard fixed-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-dashboard-inner">
                    <p>Copyright © 2024 All Rights Reserved by <a href="#">NEMTGUARD</a></p>
                    <a href="{{url('/')}}">
                        <img src="{{ asset('assets/images/logo/nemt_dark.png') }}" width="170px"
                        alt="logo">
                    </a>
                    {{-- <div class="social-area-dashboard-footer">
                        <ul>
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer dashboards area end -->


<!-- header style two -->
<div id="side-bar" class="side-bar header-two">
    <button class="close-icon-menu"><i class="far fa-times"></i></button>
    <!-- inner menu area desktop start -->
    <div class="inner-main-wrapper-desk">
        <div class="thumbnail">
            <img src="assets/images/banner/04.jpg" alt="elevate" />
        </div>
        <div class="inner-content">
            <h4 class="title">We Build Building and Great Constructive Homes.</h4>
            <p class="disc">
                We successfully cope with tasks of varying complexity, provide
                long-term guarantees and regularly master new technologies.
            </p>
            <div class="footer">
                <h4 class="title">Got a project in mind?</h4>
                <a href="contact.html" class="rts-btn btn-primary">Let's talk</a>
            </div>
        </div>
    </div>
    <!-- mobile menu area start -->
    <div class="mobile-menu-main">
        <nav class="nav-main mainmenu-nav mt--30">
            <ul class="mainmenu metismenu" id="mobile-menu-active">
                <li>
                    <a href="{{ url('home') }}" class="main">Home</a>
                </li>
                <li>
                    <a href="{{ url('courses') }}" class="main">Courses</a>
                </li>
                <li>
                    <a href="{{ url('contact-us') }}" class="main">Contact Us</a>
                </li>
                <li>
                    <a href="{{ url('about-us') }}" class="main">About Us</a>
                </li>
                @if (Auth::check())
                <li class="">
                    <a href="{{ url('student/dashboard') }}" class="main">Dashboard</a>
                </li>
                @endif
            </ul>
        </nav>
        
        <div class="buttons-area">
            @if (!Auth::check())
            <a href="{{ url('login') }}" class="rts-btn btn-border">Log In</a>
            <a href="{{ url('register') }}" class="rts-btn btn-primary">Sign Up</a>
            @else
            <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            class="rts-btn btn-primary">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @endif
        </div>
        
        <div class="rts-social-style-one pl--20 mt--50">
            <ul>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- mobile menu area end -->
</div>
<!-- header style two End -->

<!-- modal -->
{{-- <div id="myModal-1" class="modal fade" role="dialog">
    <div class="modal-dialog bg_image">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal">
                    <i class="fa-light fa-x"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="inner-content">
                    <div class="title-area">
                        <span class="pre">Get Our Courses Free</span>
                        <h4 class="title">Wonderful for Learning</h4>
                    </div>
                    <form action="#">
                        <input type="text" placeholder="Your Mail.." required />
                        <button>Download Now</button>
                        <span>Your information will never be shared with any third
                            party</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- rts backto top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
            style="
            transition: stroke-dashoffset 10ms linear 0s;
            stroke-dasharray: 307.919, 307.919;
            stroke-dashoffset: 307.919;
            ">
        </path>
    </svg>
</div>
<!-- rts backto top end -->

<!-- offcanvase search -->
<div class="search-input-area">
    <div class="container">
        <div class="search-input-inner">
            <div class="input-div">
                <input class="search-input autocomplete" type="text" placeholder="Search by keyword or #" />
                <button><i class="far fa-search"></i></button>
            </div>
        </div>
    </div>
    <div id="close" class="search-close-icon">
        <i class="far fa-times"></i>
    </div>
</div>
<!-- offcanvase search -->
<div id="anywhere-home" class=""></div>

<!-- all scripts -->
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Base JS -->
<script src="https://dixeam.com/cdn/basejs/3.0/base.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        baseJS.init(
        {
            "site_url": "{{url('/')}}",
            "current_url":"{{URL::current()}}",
            "lang": "en",
            "notif": {"type":"toastr", "options":[]},
            "inputMasking": "",
        }
        );
        
    })
</script> 
@yield('script')
</body>

</html>
