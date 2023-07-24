
@extends('frontend/index')
@section('title', isset($keyword)  ? $keyword : $category->name)
@section('idBody','category')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        .pagination a.disabled {
            pointer-events: none;
            cursor: default;
            background: #808080;
        }
    </style>
@endsection
<?php
use App\Services\Currency;
$currency = new Currency();
?>
@section('mainContent')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shop Category page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ isset($keyword) ? 'javascript:void(0)' : route('category.products', ['slug' => $category->slug])}}">{{isset($keyword) ? $keyword : $category->name}}</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <div class="container">
        @if(count($products))
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-filter mt-50">
                    <div class="top-filter-head">Product Filters</div>
                    @if(count($mappedBrands) > 0)
                        <div class="common-filter">
                            <div class="head">{{__('Brands')}}</div>
                            <form action="#">
                                <ul>
                                    @foreach($mappedBrands as $key => $brand)
                                        <li class="filter-list"><input class="pixel-radio" type="radio" id="{{$brand}}" value="{{$key}}" name="brand"><label for="{{$brand}}">{{$brand}}</label></li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>
                    @endif
                    @if(count($mappedColors) > 0)
                    <div class="common-filter">
                        <div class="head">{{__('Color')}}</div>
                        <form action="#">
                            <ul>
                                @foreach($mappedColors as $key => $color)
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="{{$color}}" value="{{$key}}" name="color"><label for="{{$color}}">{{$color}}</label></li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                    @endif
                    @if(count($deals) > 0)
                        <div class="common-filter">
                            <div class="head">{{__('Deals of the Week')}}</div>
                            <form action="#">
                                <ul>
                                    @foreach($deals as $key => $deal)
                                        <li class="filter-list"><input class="pixel-radio" type="radio" id="deal_{{$deal}}" value="{{$deal}}" name="deals_of_the_week"><label for="deal_{{$deal}}">{{$deal ? 'Yes' : 'No'}}</label></li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>
                    @endif
                    @if(count($comingSoon) > 0)
                        <div class="common-filter">
                            <div class="head">{{__('Comming Soon')}}</div>
                            <form action="#">
                                <ul>
                                    @foreach($comingSoon as $key => $comm)
                                        <li class="filter-list"><input class="pixel-radio" type="radio" id="comm_{{$comm}}" value="{{$comm}}" name="coming_soon"><label for="comm_{{$comm}}">{{$comm ? 'Yes' : 'No'}}</label></li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting products">
                        <select>
                            <option value="a-z">{{__('Name A -> Z')}}</option>
                            <option value="z-a">{{__('Name Z -> A')}}</option>
                            <option value="high-low">{{__('Price High -> Low')}}</option>
                            <option value="low-high">{{__('Price Low -> High')}}</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto">
                        <select>
                            <option value="12">{{__('Show 12')}}</option>
                            <option value="24">{{__('Show 24')}}</option>
                            <option value="36">{{__('Show 36')}}</option>
                        </select>
                    </div>
                    @if($totalPages > 1)
                        <div class="pagination">
                            @php
                                $pre = $currentPage-1 > 1 ? $currentPage-1 : 1;
                                $next = $currentPage+1 >= $totalPages ? $totalPages : $currentPage+1;
                                $disablePre = $pre == $currentPage ? 'disabled' : '';
                                $disableNext = $next == $currentPage ? 'disabled' : '';
                            @endphp
                            <a href="{{$linkPage.$pre}}" class="prev-arrow {{$disablePre}}"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                            @for($i=1;$i<=$totalPages;$i++)
                                <a href="{{$linkPage.$i}}" class="{{$currentPage == $i ? 'active' : ''}}">{{$i}}</a>
                            @endfor
                            <a href="{{$linkPage.$next }}" class="next-arrow {{$disableNext}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    @endif
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        @foreach($products as $product)
                            <!-- single product -->
                            <div class="col-lg-4 col-md-6">
                                <div class="single-product">
                                    <a href="{{ route('products.show', ['id' => $product->id]) }}"><img class="img-fluid" src="{{$product->images->first() ? asset('img/product').'/'.$product->images->first()->image : asset("img/placeholder.png")}}" alt="{{$product->name}}"></a>
                                    <div class="product-details">
                                        <h6>{{$product->name}}</h6>
                                        <div class="price">
                                            <h6>{{$currency->getPrice($product->special_price ?: $product->price)}}</h6>
                                            @if($product->special_price)
                                                <h6 class="l-through">{{$currency->getPrice($product->price)}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </section>
                <!-- End Best Seller -->
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto">
                        <select>
                            <option value="12">{{__('Show 12')}}</option>
                            <option value="24">{{__('Show 24')}}</option>
                            <option value="36">{{__('Show 36')}}</option>
                        </select>
                    </div>
                    @if($totalPages > 1)
                        <div class="pagination">
                            @php
                                $pre = $currentPage-1 > 1 ? $currentPage-1 : 1;
                                $next = $currentPage+1 >= $totalPages ? $totalPages : $currentPage+1;
                                $disablePre = $pre == $currentPage ? 'disabled' : '';
                                $disableNext = $next == $currentPage ? 'disabled' : '';
                            @endphp
                            <a href="{{$linkPage.$pre}}" class="prev-arrow {{$disablePre}}"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                            @for($i=1;$i<=$totalPages;$i++)
                            <a href="{{$linkPage.$i}}" class="{{$currentPage == $i ? 'active' : ''}}">{{$i}}</a>
                            @endfor
                            <a href="{{$linkPage.$next }}" class="next-arrow {{$disableNext}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    @endif
                </div>
                <!-- End Filter Bar -->
            </div>
        </div>
        @else
            <div class="text-center mt-5">{{__('No products found!')}}</div>

        @endif
    </div>

    <!-- Start related-product Area -->
    <section class="related-product-area section_gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Deals of the Week</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('img/r1.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>{{$currency->getPrice(189000)}}</h6>
                                        <h6 class="l-through">{{$currency->getPrice(210000)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('img/r2.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>{{$currency->getPrice(189000)}}</h6>
                                        <h6 class="l-through">{{$currency->getPrice(210000)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Các div còn lại -->
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('img/r3.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>{{$currency->getPrice(189000)}}</h6>
                                        <h6 class="l-through">{{$currency->getPrice(210000)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('img/r5.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>{{$currency->getPrice(189000)}}</h6>
                                        <h6 class="l-through">{{$currency->getPrice(210000)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('img/r6.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>{{$currency->getPrice(189000)}}</h6>
                                        <h6 class="l-through">{{$currency->getPrice(210000)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('img/r7.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>{{$currency->getPrice(189000)}}</h6>
                                        <h6 class="l-through">{{$currency->getPrice(210000)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('img/r9.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>{{$currency->getPrice(189000)}}</h6>
                                        <h6 class="l-through">{{$currency->getPrice(210000)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('img/r10.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>{{$currency->getPrice(189000)}}</h6>
                                        <h6 class="l-through">{{$currency->getPrice(210000)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('img/r11.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>{{$currency->getPrice(189000)}}</h6>
                                        <h6 class="l-through">{{$currency->getPrice(210000)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ctg-right">
                        <a href="#" target="_blank">
                            <img class="img-fluid d-block mx-auto" src="{{asset('img/category/c5.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End related-product Area -->
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
        $(document).ready(function() {
            $(".sorting.mr-auto .option").click(function() {
                let url = UrlChange('numShow',$(this).data('value'));
                // Chuyển hướng đến URL mới
                window.location.href = url.toString();
            });

            $(".sorting.mr-auto .option").each(function() {
                if ($(this).data('value') == {{$numShow}}) {
                    $(".sorting.mr-auto .current").html($(this).html());
                    $(".sorting.mr-auto .option").siblings().removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $(".sorting.products .option").click(function() {
                let url = UrlChange('sort_by',$(this).data('value'));
                // Chuyển hướng đến URL mới
                window.location.href = url.toString();
            });

            $(".sorting.products .option").each(function() {
                if ($(this).data('value') == "{{$sortBy}}") {
                    $(".sorting.products .current").html($(this).html());
                    $(".sorting.products .option").siblings().removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $(".common-filter .pixel-radio").click(function() {
                if (!$(this).hasClass('checked')) {
                    let url = UrlChange($(this).attr('name'), $(this).attr('value'));
                    // Chuyển hướng đến URL mới
                    window.location.href = url.toString();
                } else {
                    let url = UrlChange($(this).attr('name'), null);
                    // Chuyển hướng đến URL mới
                    window.location.href = url.toString();
                }
            });

            $(".common-filter .pixel-radio").each(function() {
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                const value = urlParams.get($(this).attr('name'));

                if (value && $(this).attr('value') == value) {
                    $(this).prop('checked',true);
                    $(this).addClass('checked');
                }else{
                    $(this).removeClass('checked');
                }
            });
        });

        function UrlChange(param,value) {
            // Lấy URL hiện tại
            var currentUrl = window.location.href;
            // Tạo đối tượng URL từ URL hiện tại
            var url = new URL(currentUrl);
            // Lấy danh sách các tham số truy vấn
            var params = url.searchParams;
            // Kiểm tra số lượng tham số
            params.set(param, value);
            if(!value){
                params.delete(param);
            }
            // Cập nhật URL với tham số mới
            url.search = params.toString();
            return url;
        }
    </script>

@endsection
