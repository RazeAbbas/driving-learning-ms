@extends('layouts.app')
@section('content')
@section('content')

<style type="text/css">
.rounded {
    border-radius: 1rem;
}
.nav-pills .nav-link {
    color: #555;
}
.nav-pills .nav-link.active {
    color: white;
}
input[type="radio"] {
    margin-right: 5px;
}
.bold {
    font-weight: bold;
}
.card-body input {
    border: 1px solid #dee2e6;
}
.card-body span i.fab {
    font-size: 30px;
    color: #fff;
}
.nav-pills .nav-link.active {
    background: linear-gradient(-90deg, #2c0984 0%, #aa1eca  100%) !important;
}
button.edu-btn.btn-medium {
    height: 45px;
    line-height: 40px;
    padding: 0 25px;
}
</style>

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{@$paypal_key}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>

<div class="edu-breadcrumb-area" style="padding: 40px 35px !important;">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">Checkout</h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="index-one.html">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ul>
        </div>
    </div>
</div>
<!--=====================================-->
<!--=       Checkout Area Start         =-->
<!--=====================================-->
<section class="checkout-page-area section-gap-equal">
    <div class="container">
        <div class="row row--25">
            @if(!session('coupon_applied'))
            <div class="container-fluid">
                <div class="row">
                    <div class="coupn-box">
                        <h6 class="toggle-bar active px-4 mx-3"> Have a coupon?
                            <a href="javascript:void(0)" class="toggle-btn" id="toggleCouponForm" style="color: #2c0984;">Click here</a> to enter your code
                        </h6>
                        <div class="container toggle-open" style="display: none;" id="couponFormContainer">
                            <p>If you have a coupon code, please apply it below.</p>
                            <div class="container input-group px-2">
                                <form action="{{ url('apply/coupon') }}" method="post" class="row">
                                    @csrf
                                    <input class="form-control" name="code" placeholder="Enter coupon code" type="text" autofocus="" style="border: 1px solid #ccc;">
                                    <div class="mt-3 apply-btn px-0">
                                        <button type="submit" class="edu-btn btn-medium">Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session()->has('coupon_error'))
            <div class="alert alert-danger" role="alert">
                {{ session('coupon_error') }}
            </div>
        @endif
        @if(session()->has('success_coupon'))
            <div class="alert alert-success" role="alert">
                {{ session('success_coupon') }}
            </div>
        @endif

        @if(\Session::has('error'))
            <div class="alert alert-danger">{{ \Session::get('error') }}</div>
            {{ \Session::forget('error') }}
            @endif
            @if(\Session::has('success'))
            <div class="alert alert-success">{{ \Session::get('success') }}</div>
            {{ \Session::forget('success') }}
            @endif
            @endif

            @if(session('coupon_applied'))
            @php
                $couponData = session('coupon_applied');
                $couponCode = $couponData['code'] ?? null;
                $coupon_value = $couponData['value'] ?? null;

            @endphp
             <div class="mx-4 px-4">
                Coupon Applied: {{ $couponCode }} || {{ $coupon_value }}

                <form action="{{ url('remove/coupon') }}" method="post">
                    @csrf
                    <button type="submit" class="edu-btn btn-medium mt-2">Remove Coupon</button>
                </form>

            </div>
            @endif

        <div class="col-lg-12 mt-3">
            <div class="order-summery checkout-summery">
                <div class="summery-table-wrap">
                    <h4 class="title">Your Order</h4>
                    <table class="table summery-table">
                        <tbody>
                            @if($cart_items)
                                @php
                                    $total_amount = 0;
                                    $couponDataSession = session('coupon_applied');
                                    $couponDiscount = $couponDataSession['total_discounted_price'] ?? 0;
                                    $discountedCartItems = $couponDataSession['discounted_cart_items'] ?? [];
                                @endphp
                                @foreach($cart_items as $course)
                                    <tr>
                                        <td class="d-flex justify-content-between">
                                            <span>
                                                {{ $course->course->course_name }}
                                                <p class="mb-1">
                                                    @if(@$course->training_type == 'session')
                                                        One-to-One Session (<span class="date_time" data-start="{{ @$course->date.' '.@$course->start_time }}" data-end="{{ @$course->date.' '.@$course->end_time }}">{{ date("d, M Y", strtotime(@$course->date)).' '.date("h:i A", strtotime(@$course->start_time)).' - '.date("h:i A", strtotime(@$course->end_time)) }}</span>)
                                                    @else
                                                        Recorded Training
                                                    @endif
                                                </p>
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                if($course->training_type == 'session') {
                                                    $coursePrice = $course->course->session_price;
                                                } elseif($course->training_type == 'recorded_training') {
                                                    $coursePrice = $course->course->price;
                                                } else {
                                                    $coursePrice = $course->course->price;
                                                }

                                                $total_amount += $coursePrice;

                                                $discountedPrice = null;
                                                $originalPrice = $coursePrice;

                                                foreach ($discountedCartItems as $item) {
                                                    if ($item['course_id'] === $course->course->id) {
                                                        $discountedPrice = $item['price'];
                                                        break;
                                                    }
                                                }
                                            @endphp

                                            @if($discountedPrice !== null && $discountedPrice < $coursePrice)
                                                <p>
                                                    <span style="color:red" class="original-price"><s>${{ $originalPrice }}</s></span>
                                                    <span class="discounted-price">${{ $discountedPrice }}</span>
                                                </p>
                                            @else
                                                <p>${{ $coursePrice }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if(session('coupon_applied'))
                                    <tr>
                                        <td>Discount</td>
                                        <td>${{ $couponDiscount }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Total</td>
                                    <td>${{ $total_amount - $couponDiscount }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="2">No items in the cart</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            {{-- @dd(@$discountedPrice) --}}
        <div class="order-payment">
            @if($total_amount - $couponDiscount > 0)
            <h4 class="title">Payment</h4>
            <div class="payment-method">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-white shadow-sm pl-2 pr-2">
                            <!-- Credit card form tabs -->
                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                <li class="nav-item my-0">
                                    <a data-bs-toggle="pill" href="#credit-card" class="nav-link active py-3"> <i class="fa-regular fa-credit-card mr-2"></i> Pay with Card </a>
                                </li>
                                <li class="nav-item my-0">
                                    <a data-bs-toggle="pill" href="#paypal" class="nav-link py-3"> <i class="fab fa-paypal mr-2"></i> Paypal </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End -->

                        <!-- Credit card form content -->
                        <div class="tab-content">
                            <!-- credit card info-->
                            {{-- <div id="credit-card" class="tab-pane fade show active pt-3">
                                <form role="form" action="{{ url('pay-now') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ @$stripe_key }}" id="payment-form">
                                    @csrf
                                    <input type="hidden" value="{{@$discountedPrice}}" name="discount">
                                    <div class='form-row row'>
                                        <div class='col-md-12 error form-group' style="display: none;">
                                            <div class='alert-danger alert'>Please correct the errors and try
                                            again.</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">
                                            <h6 class="mb-0">Card Name</h6>
                                        </label>
                                        <input type="text" name="username" placeholder="Card Holder Name" required class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="cardNumber">
                                            <h6 class="mb-0">Card Number</h6>
                                        </label>
                                        <div class="input-group">
                                            <input type="tel" name="cardNumber" placeholder="Card Number" class="form-control card-number" maxlength="19" required />
                                            <div class="input-group-append">
                                                <span class="input-group-text text-muted" style="background: linear-gradient(-90deg, #2c0984 0%, #aa1eca  100%);"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>
                                                    <span class="hidden-xs">
                                                        <h6 class="mb-0">Expiration Date</h6>
                                                    </span>
                                                </label>
                                                <div class="input-group"><input type="tel" placeholder="MM" name="" class="form-control card-expiry-month" maxlength="2" required /> <input type="tel" placeholder="YYYY" maxlength="4" name="" class="form-control card-expiry-year" required /></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-4">
                                                <label data-bs-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                    <h6 class="mb-0">CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                </label>
                                                <input type="tel" name="cvv" maxlength="3" required class="form-control card-cvc" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-3">
                                            <button class="edu-btn btn-medium" id="myBtn">Pay Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                            <!-- credit card info-->
                            <div id="credit-card" class="tab-pane fade show active pt-3">
                                <form id="payment-form">
                                    <input type="hidden" value="{{ @$couponDiscount }}" name="discount">
                                    <input type="hidden" value="" class="timezone" name="timezone">
                                    <div id="payment-element">
                                        <!-- Stripe.js injects the Payment Element -->
                                    </div>
                                    <button id="submit" class="edu-btn btn-medium mt-4">
                                        <div class="spinner hidden" id="spinner"></div>
                                        <span id="button-text">Pay now</span>
                                    </button>
                                    <div id="payment-message" class="hidden"></div>
                                </form>
                            </div>

                            <!-- End -->
                            <!-- Paypal info -->
                            <div id="paypal" class="tab-pane fade pt-3">
                                <p class="mb-3">
                                    <form action="{{ url('/pay')}}" for="pay-bank" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{@$couponDiscount}}" name="discount">
                                        <input type="hidden" value="" class="timezone" name="timezone">
                                        <div class="col-sm-12 mt-3">
                                            <button type="submit" class="edu-btn btn-medium" id="myBtn">Pay Now</button>
                                        </div>
                                    </form>
                                    {{-- <a href="{{url('/pay')}}" for="pay-bank" class="edu-btn btn-medium mt-3">Pay With Paypal</a> --}}
                                </p>
                                <p class="text-muted">
                                    <b>Note:</b> After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order.
                                </p>
                            </div>
                            <!-- End -->
                            <!-- bank transfer info -->
                            <div id="net-banking" class="tab-pane fade pt-3">
                                <div class="form-group">
                                    <label for="Select Your Bank">
                                        <h6>Select your Bank</h6>
                                    </label>
                                    <select class="form-control" id="ccmonth">
                                        <option value="" selected disabled>--Please select your Bank--</option>
                                        <option>Bank 1</option>
                                        <option>Bank 2</option>
                                        <option>Bank 3</option>
                                        <option>Bank 4</option>
                                        <option>Bank 5</option>
                                        <option>Bank 6</option>
                                        <option>Bank 7</option>
                                        <option>Bank 8</option>
                                        <option>Bank 9</option>
                                        <option>Bank 10</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p>
                                        <button type="button" class="btn btn-primary"><i class="fas fa-mobile-alt mr-2"></i> Proceed Payment</button>
                                    </p>
                                </div>
                                <p class="text-muted">
                                    Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order.
                                </p>
                            </div>
                            <!-- End -->
                        </div>
                    </div>
                </div>
            </div>
            @else
            <a href="{{ url('/buy-courses') }}" class="edu-btn btn-medium">Buy Now</a>
            @endif

        </div>
                {{-- @csrf()
                <button class="edu-btn order-place"><a href="{{url('pay-now')}}"></a>Place Your order <i class="icon-4"></i></button>
            </form> --}}
        </div>


</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var toggleCouponFormBtn = document.getElementById('toggleCouponForm');
        var couponFormContainer = document.getElementById('couponFormContainer');
        toggleCouponFormBtn.addEventListener('click', function() {
            couponFormContainer.style.display = (couponFormContainer.style.display === 'none' || couponFormContainer.style.display === '') ? 'block' : 'none';
        });
    });
</script>

<script>
   /*document.addEventListener('DOMContentLoaded', function () {
    var stripeRadio = document.getElementById('paypal');
    var paymentAccordion = document.getElementById('payAccordion');

    stripeRadio.addEventListener('change', function () {
        if (this.checked) {
            paymentAccordion.style.display = "block";
        } else {
            paymentAccordion.style.display = "none";
        }
    });
});*/
document.addEventListener('DOMContentLoaded', function () {
    var stripeRadio = document.getElementById('stripe');
    var paymentAccordion = document.getElementById('paymentAccordion');

    stripeRadio.addEventListener('change', function () {
        if (this.checked) {
            paymentAccordion.style.display = "block";
        } else {
            paymentAccordion.style.display = "none";
        }
    });

    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $(".timezone").val(timezone);
});

$(".date_time").each(function (key, value) {
    var start = $(this).attr("data-start");
    var end = $(this).attr("data-end");
    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

    const formdata = new FormData();
    formdata.append("start_date", start);
    formdata.append("end_date", end);
    formdata.append("timezone", timezone);

    $.ajax({
        type: 'POST',
        url: "{{ url('convert-date') }}",
        data: formdata,
        contentType: false,
        cache: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(data)
        {
            if(data.flag == true){
                $(value).html(data.date+" "+data.start_time+" - "+data.end_time);
            }
        },
        error: function(data){
            console.log(data);
        },
    });
});

function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
      return false;
  return true;
}


$('#inumber').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
});
</script>
{{-- <script type="text/javascript" src="https://js.stripe.com/v3/"></script> --}}
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    console.log("Stripe Secret Key: {{ env('STRIPE_SECRET') }}");
</script>
{{-- <script type="text/javascript">


    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
        $('.card-number').on('input', function() {
            let text=$(this).val()
            text=text.replace(/\D/g,'')
            if(text.length>4) text=text.replace(/.{4}/,'$& ')
                if(text.length>8) text=text.replace(/.{9}/,'$& ')
                    if(text.length>12) text=text.replace(/.{14}/,'$& ')
                        $(this).val(text);
                });

    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
        'input[type=text]', 'input[type=file]',
        'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
        }
    });

        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
      }

  });

    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error').css("display", "block");
            $('.error').find('.alert').text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script> --}}
<script>
    const stripe = Stripe("{{@$stripe_key}}");
    let elements;

    initialize();
    checkStatus();

    document
    .querySelector("#payment-form")
    .addEventListener("submit", handleSubmit);

    async function initialize() {
        try {
            // The items the customer wants to buy
            const items = [{ id: "xl-tshirt" }];

            const { clientSecret } = await fetch("{{url('/checkout')}}", {
                method: "POST",
                headers: { "Content-Type": "application/json", 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                body: JSON.stringify({ items }),
            }).then((r) => r.json());

            elements = stripe.elements({ clientSecret });

            const paymentElement = elements.create("payment");
            paymentElement.mount("#payment-element");
        } catch (error) {
            console.error(error);
        }
    }

    async function handleSubmit(e) {
        var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        e.preventDefault();
        setLoading(true);
        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: "{{url('/payment-response?timezone=')}}"+timezone,
            },
        });
        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
        } else {
            showMessage("An unexpected error occurred.");
        }

        setLoading(false);
    }

    async function checkStatus() {
        const clientSecret = new URLSearchParams(window.location.search).get(
            "payment_intent_client_secret"
            );

        if (!clientSecret) {
            return;
        }

        const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

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

        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageContainer.textContent = "";
        }, 4000);
    }

    function setLoading(isLoading) {
        const submitButton = document.querySelector("#submit");
        const spinner = document.querySelector("#spinner");
        const buttonText = document.querySelector("#button-text");

        if (isLoading) {
            // Disable the button and show a spinner
            submitButton.disabled = true;
            spinner.classList.remove("hidden");
            buttonText.classList.add("hidden");
        } else {
            submitButton.disabled = false;
            spinner.classList.add("hidden");
            buttonText.classList.remove("hidden");
        }
    }
</script>

@endsection
