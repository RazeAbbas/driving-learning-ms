@extends('layouts.app')
@section('content')
    <!-- bread crumb area -->
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">Cart</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="{{ url('home') }}">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="{{ url('cart') }}">Cart</a>
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
            <!--================= Cart Area Start =================-->
            <article id="post-283" class="post-283 page type-page status-publish hentry">
                <div class="ms-default-page container">
                    <div class="woocommerce">
                        <div class="woocommerce-notices-wrapper"></div>
                        <div class="ms-woocommerce-cart-form-wrapper">
                            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                <thead>
                                    <tr>
                                        <th class="">Action</th>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Course</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-subtotal">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr class="woocommerce-cart-form__cart-item cart_item"
                                            id="course-{{ $course->course_id }}">
                                            <td class="" course-id="{{ $course->course_id }}">
                                                <form action="{{ url('removefromcart') }}" method="POST"
                                                    data-action="make_ajax" data-action-after="reload">
                                                    @csrf()
                                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                                    <input type="hidden" name="course_id" value="{{ $course->course_id }}">
                                                    <button type="submit" class="remove-wishlist border-0 bg-light">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="product-thumbnail">
                                                @if ($course->course)
                                                    <a href="{{ url('course/details', $course->course_id) }}">
                                                        <img src="{{ asset('storage/upload/110x110-' . $course->course->featured_img) }}"
                                                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                            alt="{{ $course->course->course_name }}">
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="product-name" data-title="Product">
                                                @if ($course->course)
                                                    <a
                                                        href="{{ url('course/details', $course->course_id) }}">{{ $course->course->course_name }}</a>
                                                @else
                                                    <span class="text-danger">Course not found</span>
                                                @endif
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                @if ($course->course)
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi><span
                                                                class="woocommerce-Price-currencySymbol">$</span>{{ $course->course->price }}</bdi>
                                                    </span>
                                                @else
                                                    <span class="text-danger">N/A</span>
                                                @endif
                                            </td>
                                            <td class="product-subtotal" data-title="Subtotal">
                                                @if ($course->course)
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi><span
                                                                class="woocommerce-Price-currencySymbol">$</span>{{ $course->course->price }}</bdi>
                                                    </span>
                                                @else
                                                    <span class="text-danger">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            
                            <div class="row">
                                <div class="col-md-5 offset-md-7">
                                    <div class="ms-cart-collaterals cart-collaterals">
                                        <div class="ms-cart-totals cart_totals ">
                                            <h3 class="animated fadeIn">Cart totals</h3>
                                            <table class="shop_table shop_table_responsive">
                                                <tbody>
                                                    <?php
                                                        $subTotal = 0;
                                                        foreach ($courses as $course) {
                                                            $subTotal += $course->course->price;
                                                        }
                                                        $total = $subTotal; 
                                                    ?>
                                                    <tr class="cart-subtotal">
                                                        <th>Subtotal</th>
                                                        <td data-title="Subtotal">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <bdi><span
                                                                        class="woocommerce-Price-currencySymbol update-subtotal">$ {{$subTotal}}</span></bdi>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        <td data-title="Total">
                                                            <strong><span class="woocommerce-Price-amount amount">
                                                                    <bdi><span
                                                                            class="woocommerce-Price-currencySymbol update-grandtotal">$ {{$total}}</span></bdi></span>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="ms-proceed-to-checkout wc-proceed-to-checkout">
                                                <a href="{{ url('checkout') }}"
                                                    class="rts-btn btn-primary my-proceed-to-checkout"
                                                    @if (App\Models\CartItem::count() == 0) style="pointer-events: none" @endif>
                                                    Proceed to
                                                    checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </article>
        </div>
    </main>
    <!-- Shop area end -->
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

            $('body').on('click', '.product-remove', function(e) {
                e.preventDefault();
                let id = $(this).attr('course-id');
                destroy_product(id);
            });

            function destroy_product(productId) {
                let data = {
                    product_id: productId,
                    expectsJson: true,
                    _token: "{{ csrf_token() }}"
                };
                $.ajax({
                    url: "{{ url('removefromcart') }}",
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        console.log(response);
                        $('#cart-qty').text(response.qty);
                        var div = document.getElementById('course-' + productId);
                        div.style.visibility = "hidden";
                        div.style.display = "none";
                        $('.update-subtotal').text('$' + response.subTotal);
                        $('.update-grandtotal').text('$' + response.grandTotal);

                        if (response.grandTotal === 0) {
                            $('.my-proceed-to-checkout').css('pointer-events', 'none');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            }

        });
    </script>
    
@endsection