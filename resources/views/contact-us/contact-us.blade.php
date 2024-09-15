@extends('layouts.app')
@section('content')
    <!-- bread crumb area -->
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">Contact Us</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="{{ url('/') }}">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="#">Contact us</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->


    <!-- rts contact area start -->
    <div class="rts-contact-area rts-section-gapTop">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-8">
                    <!-- contact left area start -->
                    <div class="contact-left-area-start">
                        <div class="title-area-left-style">
                            <div class="pre-title">
                                <img src="assets/images/banner/bulb.png" alt="icon">
                                <span>Courses</span>
                            </div>
                            <h2 class="title">Love to hear from you <br>
                                <span>Get in touch!</span>
                            </h2>
                        </div>
                        <form action="{{ route('contact.send') }}" method="post" class="contact-page-form"
                            id="contact-form-di">
                            @csrf
                            <div class="single-input">
                                <label for="name">Your Name*</label>
                                <input id="name" name="name" type="text" placeholder="Andrew Davis ...."
                                    required>
                            </div>
                            <div class="single-input">
                                <label for="email">Your Email*</label>
                                <input id="email" name="email" type="email" placeholder="support@nemtguard.com"
                                    required>
                            </div>
                            <div class="single-input">
                                <label for="message">Message*</label>
                                <textarea id="message" name="message" placeholder="Let tell us about your projects" required></textarea>
                            </div>
                            <button type="submit" class="rts-btn btn-primary mt--30">Send Message</button>
                        </form>

                        {{-- <div id="form-messages" class="mt--20"></div> --}}
                    </div>
                    <!-- contact left area end -->
                </div>
                <!-- <div class="col-xl-7 pl--50 pl_lg--15 pl_md--15 pl_sm--15 pb_md--100 pb_sm--100">
                            <div class="contact-map-area-start">
                                <div class="single-maptop-info">
                                    <div class="icon">
                                        <img src="assets/images/contact/02.png" alt="contact">
                                    </div>
                                    <p class="disc">
                                        123 Main Street,
                                        New York, AV 10013
                                    </p>
                                </div>
                                <div class="single-maptop-info">
                                    <div class="icon">
                                        <img src="assets/images/contact/03.png" alt="contact">
                                    </div>
                                    <a href="tel:+4733378901">(555) 123-4567</a> <br>
                                    <a href="tel:+4733378901">(555) 123-4567</a>
                                </div>
                                <div class="single-maptop-info">
                                    <div class="icon">
                                        <img src="assets/images/contact/04.png" alt="contact">
                                    </div>
                                    <p class="disc">
                                        Mon-Fri: 9 AM – 6 PM <br>
                                        Saturday: 9 AM – 4 PM
                                    </p>
                                </div>
                            </div>
                            <div class="map-bottom-area mt--30">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14602.288851207937!2d90.47855065!3d23.798243149999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1705835333294!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div> -->
            </div>
        </div>
    </div>
    <!-- rts contact area end -->

    <div class="rts-section-gap">

    </div>
    <script>
        $(document).ready(function() {
            $('#contact-form-di').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Check if response contains success message
                        if (response.success) {
                            toastr.success(response.success);
                        } else {
                            // If success message not found, display a generic success message
                            toastr.success('Your message has been sent successfully!');
                        }
                    },
                    error: function(error) {
                        toastr.error('An error occurred. Please try again later.');
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
