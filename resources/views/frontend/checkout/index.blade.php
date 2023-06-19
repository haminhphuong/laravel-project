@extends('frontend/index')
@section('title', 'Checkout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
    .select-scroll .list{
        height: 250px;
        overflow: auto;
    }
    </style>
@endsection

@section('mainContent')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">

            <div class="cupon_area">
                <div class="check_title">
                    <h2>Have a coupon? <a href="#">Click here to enter your code</a></h2>
                </div>
                <input type="text" placeholder="Enter coupon code">
                <a class="tp_btn" href="#">Apply Coupon</a>
            </div>
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="{{ route('checkout.place-order') }}" id="checkout_form" method="post" novalidate="novalidate">
                            @csrf
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="{{__('First name')}}" required aria-invalid="true">
                                @error('first_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="{{__('Last name')}}" required aria-invalid="true">
                                @error('last_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="{{__('Phone number')}}" required aria-invalid="true">
                                @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{__('Email Address')}}" required aria-invalid="true">
                                @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select select-scroll" id="province">
                                    @foreach($provinces as $province)
                                        <option value="{{ $province['ID']}}">{{ $province['Title'] }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="city_address" id="city_address" class="@error('city_address') is-invalid @enderror">
                                @error('city_adress')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select select-scroll" id="district">
                                    <option value="1">District</option>
                                </select>
                                <input type="hidden" name="district_address" id="district_address" class="@error('district_address') is-invalid @enderror">
                                @error('district_address')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select select-scroll" id="ward">
                                    <option value="1">Ward</option>
                                </select>
                                <input type="hidden" name="ward_address" id="ward_address" class="@error('ward_adress') is-invalid @enderror">
                                @error('ward_address')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="{{__('Address line')}}">
                                @error('address')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note" rows="1" placeholder="{{__('Order Notes')}}"></textarea>
                                @error('note')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="hidden" name="payment_method" id="payment_method">
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product <span>Total</span></a></li>
                                @foreach($cartItems as $item)
                                    <li><a href="#">{{ $item->name }} <span class="middle">x {{ $item->quantity }}</span> <span class="last">{{ number_format($item->total_price,2) }}</span></a></li>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Subtotal <span>{{ number_format($subtotal, 2) }}</span></a></li>
                                <li><a href="#">Shipping <span>{{__('Free Ship')}}</span></a></li>
                                <li><a href="#">Total <span>{{ number_format($subtotal, 2) }}</span></a></li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="cash_on_delivery" name="method" checked value="cash_on_delivery">
                                    <label for="cash_on_delivery">{{__('Cash on delivery')}}</label>
                                    <div class="check"></div>
                                </div>
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="paypal" name="method" value="paypal">
                                    <label for="paypal">{{__('Paypal')}} </label>
                                    <img src="img/product/card.jpg" alt="">
                                    <div class="check"></div>
                                </div>
                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" name="selector">
                                <label for="f-option4">I’ve read and accept the </label>
                                <a href="#">terms & conditions*</a>
                            </div>
                            <a class="primary-btn" href="javascript:void(0)" id="placeOrder">{{__('Place Order')}}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection
@section('js')
    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
    <script src="{{ asset('js/gmaps.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(document).ready(function(){
            // gọi hàm xử lý khi trang được tải lần đầu
            $('#province').trigger('change');
            $('input[name="method"]:checked').trigger('change');
        });
        $('#province').change(function(){
            var province_id = $(this).val();
            var selectedOption = $(this).find('option:selected');
            $("#city_address").val(selectedOption.text());
            $.ajax({
                url: '/api/get-districts/' + province_id,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    var districts = response.districts;
                    var districtDropdown = $('#district');
                    var list = $("#district").siblings(".nice-select.country_select").find(".list");
                    var current = $("#district").siblings(".nice-select.country_select").find(".current");
                    list.empty();
                    districtDropdown.empty(); // xóa tất cả các option cũ
                    $.each(districts, function(key, value){
                        var selected = key == 0 ? "focus selected" : "";
                        if(key == 0) current.html(value.Title) ;
                        districtDropdown.append('<option value="' + value.ID + '">' + value.Title + '</option>');
                        var html = '<li data-value="' + value.ID + '" class="option ' + selected + '">' + value.Title + '</li>';
                        list.append(html);
                    });
                    $('#district').trigger('change');
                }
            });

        });

        $('#district').change(function() {
            var districtId = $(this).val();
            var selectedOption = $(this).find('option:selected');
            $("#district_address").val(selectedOption.text());
            // Kết nối tới API để lấy danh sách xã
            $.ajax({
                type: 'GET',
                url: '/api/get-wards/' + districtId,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var wards = response.wards;
                    var list = $("#ward").siblings(".nice-select.country_select").find(".list");
                    var current = $("#ward").siblings(".nice-select.country_select").find(".current");
                    // Xóa danh sách xã cũ
                    $('#ward').empty();
                    list.empty();
                    // Hiển thị danh sách xã mới
                    $.each(wards, function(key, value) {
                        var selected = key == 0 ? "focus selected" : "";
                        if(key == 0) current.html(value.Title) ;
                        $('#ward').append('<option value="' + value.ID + '">' + value.Title + '</option>');
                        var html = '<li data-value="' + value.ID + '" class="option ' + selected + '">' + value.Title + '</li>';
                        list.append(html);
                    });
                    $('#ward').trigger('change');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#ward').change(function() {
            var selectedOption = $(this).find('option:selected');
            $("#ward_address").val(selectedOption.text());
        })

        // add a change event listener to the radio inputs
        $('input[name="method"]').change(function() {
            // update the hidden input field value with the selected payment method value
            $('#payment_method').val($(this).val());
        });

        $("#placeOrder").click(function (){
            // get the selected payment method value
            var paymentMethod = document.querySelector('input[name="method"]:checked');

            // display the alert message if no payment method is selected
            if (!paymentMethod) {
                alert('Bạn chưa chọn phương thức thanh toán!');
                return false; // stop further processing
            }
            $("#checkout_form").submit();
        })
    </script>
@endsection
