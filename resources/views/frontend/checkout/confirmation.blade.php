@extends('frontend/index')
@section('title', 'Confirmation')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

@endsection

@section('mainContent')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Confirmation</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/">Confirmation</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Order Details Area =================-->
    <section class="order_details section_gap">
        <div class="container">
            <h3 class="title_confirmation">{{__('Thank you. Your order has been received.')}}</h3>
            <div class="row order_d_inner">
                <div class="col-lg-6">
                    <div class="details_item">
                        <h4>{{__('Order Info')}}</h4>
                        <ul class="list">
                            <li><a href="#"><span>{{__('Order number')}}</span> : {{$order->id}}</a></li>
                            <li><a href="#"><span>{{__('Date')}}</span> : {{$order->created_at}}</a></li>
                            <li><a href="#"><span>{{__('Total')}}</span> : {{number_format($order->total_price,2)}}</a></li>
                            <li><a href="#"><span>{{__('Payment method')}}</span> : {{$order->payment_method == 'cash_on_delivery' ? 'Cash On Delivery' : 'Paypal'}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="details_item">
                        <h4>{{__('Address')}}</h4>
                        <ul class="list">
                            <li><a href="#"><span>{{__('City')}}</span> : {{$orderAddress->city}}</a></li>
                            <li><a href="#"><span>{{__('District ')}}</span> : {{$orderAddress->district }}</a></li>
                            <li><a href="#"><span>{{__('Ward')}}</span> : {{$orderAddress->ward}}</a></li>
                            <li><a href="#"><span>{{__('Street')}}</span> : {{$orderAddress->address}}</a></li>
                            <li><a href="#"><span>{{__('Country')}}</span> : {{__('Việt Nam')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="order_details_table">
                <h2>{{__('Order Details')}}</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">{{__('Product')}}</th>
                            <th scope="col">{{__('Quantity')}}</th>
                            <th scope="col">{{__('Total')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderItems as $item)
                        <tr>
                            <td>
                                <p>{{$item->product->name}}</p>
                            </td>
                            <td>
                                <h5>x {{$item->quantity}}</h5>
                            </td>
                            <td>
                                <p>${{number_format($item->price,2)}}</p>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                <h4>{{__('Shipping')}}</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>{{__('Free Ship')}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>{{__('Total')}}</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>{{number_format($order->total_price,2)}}</p>
                            </td>
                        </tr>
                        @if($orderAddress->note)
                        <tr>
                            <td>
                                <h4>{{__('Note')}}</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>{{$orderAddress->note}}</p>
                            </td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Order Details Area =================-->
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
@endsection
