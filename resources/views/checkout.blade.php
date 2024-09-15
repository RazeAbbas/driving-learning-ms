@extends('layouts.app')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <!-- bread crumb area -->
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">Checkout</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="{{ url('home') }}">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="{{ url('checkout') }}">Checkout</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->


    <!-- Shop area start -->
    <main class="ms-main">
        <div class="ms-page-content">
            <!--================= Checkout Area Start =================-->
            <article id="post-284" class="page checkout-area type-page status-publish hentry">
                <div class="ms-default-page container entry-content">
                    <div class="woocommerce">

                        <div class="woocommerce-notices-wrapper"></div>

                        <div class="row d-flex justify-content-center">

                            <div class="col-lg-9">
                                <div class="row row--25">
                                    @if (!session('coupon_applied'))
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="coupn-box">
                                                    <h6 class="toggle-bar active px-4 mx-3"> Have a coupon?
                                                        <a href="javascript:void(0)" class="toggle-btn"
                                                            id="toggleCouponForm" style="color: #235347;">Click here</a> to
                                                        enter your code
                                                    </h6>
                                                    <div class="container toggle-open" style="display: none;"
                                                        id="couponFormContainer">
                                                        <div class="container input-group px-2">
                                                            <form action="{{ url('apply/coupon') }}" method="post"
                                                                class="row">
                                                                @csrf
                                                                <div class="input-group">
                                                                    <input type="text" class="w-50" name="code"
                                                                        placeholder="Enter coupon code"
                                                                        aria-label="Enter coupon code"
                                                                        aria-describedby="basic-addon2">
                                                                    <div class="input-group-append apply-btn">
                                                                        <button type="submit"
                                                                            class="btn btn-outline-primary"
                                                                            type="button">Apply</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                @if (session()->has('coupon_error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('coupon_error') }}
                                    </div>
                                @endif
                                @if (session()->has('success_coupon'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success_coupon') }}
                                    </div>
                                @endif

                                @if (\Session::has('error'))
                                    <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                                    {{ \Session::forget('error') }}
                                @endif
                                @if (\Session::has('success'))
                                    <div class="alert alert-success">{{ \Session::get('success') }}</div>
                                    {{ \Session::forget('success') }}
                                @endif
                                @endif

                                @if (session('coupon_applied'))
                                    @php
                                        $couponData = session('coupon_applied');
                                        $couponCode = $couponData['code'] ?? null;
                                        $couponValue = $couponData['value'] ?? null;
                                    @endphp
                                    <div class="mx-4 px-4">
                                        Coupon Applied: {{ $couponCode }} || {{ $couponValue }}

                                        <form action="{{ url('remove/coupon') }}" method="post">
                                            @csrf
                                            <button type="submit" class="edu-btn btn-medium mt-2">Remove Coupon</button>
                                        </form>
                                    </div>
                                @endif

                                <div class="full-grid">
                                    <div class="border border-1 p-5">
                                        <div class="checkout-title">
                                            <h5 class="animated fadeIn">Your Order</h5>
                                        </div>
                                        <table class="table">
                                            <tbody>
                                                @php
                                                    $subTotal = 0;
                                                    $totalDiscount = 0;
                                                @endphp
                                                @foreach ($courses as $course)
                                                    @php
                                                        $discountedPrice = $course->course->price;
                                                        $discountAmount = 0;
                                                        if (session('coupon_applied')) {
                                                            $couponValue = rtrim($couponData['value'], '%');
                                                            $discountAmount =
                                                                $course->course->price * ($couponValue / 100);
                                                            $discountedPrice = $course->course->price - $discountAmount;
                                                            $totalDiscount += $discountAmount;
                                                        }
                                                        $subTotal += $discountedPrice;
                                                    @endphp
                                                    <tr class="border-bottom" style="font-size: 18px;">
                                                        <td class="fw-bold">{{ $course->course->course_name }}</td>
                                                        <td>${{ number_format($course->course->price, 2) }}</td>
                                                        {{-- <td>${{ number_format($discountAmount, 2) }}</td> --}}
                                                        {{-- <td>${{ number_format($discountedPrice, 2) }}</td> --}}
                                                    </tr>
                                                @endforeach
                                                <tr class="border-bottom">
                                                    <th class="fw-bold">Discount</th>
                                                    <th>${{ number_format($totalDiscount, 2) }}</th>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Total</th>
                                                    <th>${{ number_format($subTotal, 2) }}</th>
                                                    {{-- <th>${{ number_format($subTotal - $totalDiscount, 2) }}</th> --}}
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </article>
            <!--================= Checkout Area End =================-->
        </div>
    </main>
    <!-- Display a payment form -->
    <div class="d-flex justify-content-center">
        <div class="col-lg-8 p-5 border border-1  text-center">
            <form id="payment-form">
                <div id="payment-element">
                    <input type="hidden" name="coupon" value="{{$totalDiscount}}">
                    <!--Stripe.js injects the Payment Element-->
                </div>
                <div class="row p-2">
                    <button id="submit" type="submit" class="btn btn-primary mt-5 py-2 w-25">
                        <div class="spinner hidden" id="spinner"></div>
                        <span id="button-text " style="font-size: 16px">Pay now</span>
                    </button>
                </div>
                <div id="payment-message" class="hidden"></div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script>
        var key = "{{ $stripe_public }}";
        const stripePublishableKey = key;
        let stripe;
        let elements;

        initialize();
        checkStatus();

        // async function initialize() {
        //     try {
        //         const items = [{
        //             id: "xl-tshirt"
        //         }];
        //         const {
        //             clientSecret
        //         } = await fetch("{{ route('stripe.form') }}", {
        //             method: "POST",
        //             headers: {
        //                 "Content-Type": "application/json",
        //                 'X-CSRF-TOKEN': "{{ csrf_token() }}"
        //             },
        //             body: JSON.stringify({
        //                 items
        //             }),
        //         }).then((r) => r.json());

        //         stripe = Stripe(stripePublishableKey);
        //         elements = stripe.elements({
        //             clientSecret
        //         });

        //         const paymentElement = elements.create("payment");
        //         paymentElement.mount("#payment-element");
        //     } catch (error) {
        //         console.error(error);
        //     }
        // }
        async function initialize() {
            try {
                const items = [{ id: "xl-tshirt" }]; 
                const {
                    clientSecret
                } = await fetch("{{ route('stripe.form') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        items
                    }),
                }).then((r) => r.json());

                stripe = Stripe(stripePublishableKey);
                elements = stripe.elements({
                    clientSecret
                });

                const paymentElement = elements.create("payment");
                paymentElement.mount("#payment-element");
            } catch (error) {
                console.error(error);
            }
        }

        document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

        async function handleSubmit(e) {
            e.preventDefault();
            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: "{{ route('stripe.pay') }}",
                },
            });
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }
        }

        async function checkStatus() {
            const clientSecret = new URLSearchParams(window.location.search).get("payment_intent_client_secret");

            if (!clientSecret) {
                return;
            }
            const {
                paymentIntent
            } = await stripe.retrievePaymentIntent(clientSecret);

            switch (paymentIntent.status) {
                case "succeeded":
                    showMessage("Payment succeeded!");
                    break;
                case "processing":
                    showMessage("Your payment is processing.");
                    break;
                case "requires_payment_method":
                    showMessage("Your payment was not successful, please try again.");
                    break;
                default:
                    showMessage("Something went wrong.");
                    break;
            }
        }

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageContainer.textContent = "";
            }, 4000);
        }
    </script>
    {{-- <script>
        // console.log('{{ $stripe_public }}');
        var key = "{{ $stripe_public }}";
        const stripePublishableKey = key;

        let stripe;
        let elements;

        initialize();
        checkStatus();

        async function initialize() {
            try {
                const items = [{
                    id: "xl-tshirt"
                }];
                const {
                    clientSecret
                } = await fetch("{{ route('stripe.form') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        items
                    }),
                }).then((r) => r.json());

                stripe = Stripe(stripePublishableKey);
                elements = stripe.elements({
                    clientSecret
                });

                const paymentElement = elements.create("payment");
                paymentElement.mount("#payment-element");
            } catch (error) {
                console.error(error);
            }
        }

        document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

        async function handleSubmit(e) {
            e.preventDefault();
            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: "{{ route('stripe.pay') }}",
                },
            });
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }
        }

        async function checkStatus() {
            const clientSecret = new URLSearchParams(window.location.search).get("payment_intent_client_secret");

            if (!clientSecret) {
                return;
            }
            const {
                paymentIntent
            } = await stripe.retrievePaymentIntent(clientSecret);

            switch (paymentIntent.status) {
                case "succeeded":
                    showMessage("Payment succeeded!");
                    break;
                case "processing":
                    showMessage("Your payment is processing.");
                    break;
                case "requires_payment_method":
                    showMessage("Your payment was not successful, please try again.");
                    break;
                default:
                    showMessage("Something went wrong.");
                    break;
            }
        }

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageContainer.textContent = "";
            }, 4000);
        }
    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toggleCouponFormBtn = document.getElementById('toggleCouponForm');
            var couponFormContainer = document.getElementById('couponFormContainer');
            toggleCouponFormBtn.addEventListener('click', function() {
                couponFormContainer.style.display = (couponFormContainer.style.display === 'none' ||
                    couponFormContainer.style.display === '') ? 'block' : 'none';
            });
        });
    </script>
@endsection
