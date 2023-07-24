
@extends('frontend/index')
@section('title', $product->name)
@section('css')
    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.skinFlat.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
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
                    <h1>{{$product->name}}</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">{{$product->name}}</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->



    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_Product_carousel">
                        @foreach($product->images as $image)
                        <div class="single-prd-item">
                            <img class="img-fluid" src="{{asset('img/product/'.$image->image)}}" alt="{{$image->image}}">
                        </div>
                        @endforeach


                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{$product->name}}</h3>
                        <h2>{{$currency->getPrice($product->special_price ?: $product->price)}}</h2>
                        <ul class="list">
                            <li><a class="active" href="{{route('category.products', ['slug' => $product->category->slug])}}"><span>Category</span> : {{$product->category->name}}</a></li>
                            <li><a href="#"><span>Availibility</span> : In Stock</a></li>
                        </ul>
                        <p>Mill Oil is an innovative oil filled radiator with the most modern technology. If you are looking for
                            something that can make your interior look awesome, and at the same time give you the pleasant warm feeling
                            during the winter.</p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" id="add-to-cart-form">
                            @csrf
                            <div class="product_count">
                                <label for="qty">Quantity:</label>
                                <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                        class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;"
                                        class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                            </div>
                        </form>
                        <div class="card_area d-flex align-items-center">
                            <a class="primary-btn" id="add-to-cart" href="javascript:void(0)">Add to Cart</a>
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                       aria-selected="false">Specification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                       aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    {!! $product->description !!}
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        {!! $product->info->specifications !!}
                    </div>
                </div>
                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>Overall</h5>
                                        <h4>{{$averageRating}}</h4>
                                        <h6>({{$reviewsCount}} Reviews)</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rating_list">
                                        <h3>Based on {{$reviewsCount}} Reviews</h3>
                                        <ul class="list">
                                            <li><a href="#">5 Star
                                                    @for($i=0;$i<5;$i++)
                                                        <i class="fa fa-star {{$i < 5 ? 'star-active' : ''}}"></i>
                                                    @endfor
                                                    {{$totalReviews[5]}}</a></li>
                                            <li><a href="#">4 Star
                                                @for($i=0;$i<5;$i++)
                                                    <i class="fa fa-star {{$i < 4 ? 'star-active' : ''}}"></i>
                                                @endfor
                                                    {{$totalReviews[4]}}</a></li>
                                            <li><a href="#">3 Star
                                                @for($i=0;$i<5;$i++)
                                                    <i class="fa fa-star {{$i < 3 ? 'star-active' : ''}}"></i>
                                                @endfor
                                                    {{$totalReviews[3]}}</a></li>
                                            <li><a href="#">2 Star
                                                    @for($i=0;$i<5;$i++)
                                                        <i class="fa fa-star {{$i < 2 ? 'star-active' : ''}}"></i>
                                                    @endfor
                                                    {{$totalReviews[2]}}</a></li>
                                            <li><a href="#">1 Star
                                                    @for($i=0;$i<5;$i++)
                                                        <i class="fa fa-star {{$i < 1 ? 'star-active' : ''}}"></i>
                                                    @endfor
                                                    {{$totalReviews[1]}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="review_list">
                                @foreach($reviews as $review)
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{asset('img/product/review-1.png')}}" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>{{$review->user->name}}</h4>
                                            @for($i=0;$i<5;$i++)
                                                <i class="fa fa-star {{$i < $review->rating ? 'star-active' : ''}}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p>{{$review->comment}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Add a Review</h4>
                                <p>Your Rating:</p>
                                <ul class="list" id="rating-stars">
                                    <li><a href="javascript:void(0)"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-star"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-star"></i></a></li>
                                </ul>
                                <p>Outstanding</p>
                                <form class="row review_form" id="review-form" action="{{ route('reviews.store',$product->id) }}" method="post"  novalidate="novalidate">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="name" name="name" placeholder="Your Full name" value="{{$user ? $user->name : ''}}" disabled onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Full name'">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" value="{{$user ? $user->name : ''}}" disabled onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Full name'">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="review" id="review" rows="1" placeholder="Review" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="rating" id="rating" value="0">
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" value="submit" class="primary-btn">Submit Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->

    <!-- Start related-product Area -->
    <section class="related-product-area section_gap_bottom">
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
                            <img class="img-fluid d-block mx-auto" src="{{ asset('img/category/c5.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Lấy danh sách các sao đánh giá
        const stars = document.querySelectorAll("#rating-stars li a");
        // Thêm sự kiện click cho mỗi sao đánh giá
        stars.forEach(function(star, index) {
            // Thêm sự kiện mouseover vào sao
            star.addEventListener('mouseover', function() {
                // Thêm class star-active cho các sao từ 0 đến index
                for (var i = 0; i <= index; i++) {
                    stars[i].classList.add('star-active');
                }
            });

            // Thêm sự kiện mouseout vào sao
            star.addEventListener('mouseout', function() {
                // Xóa class star-active khỏi tất cả các sao
                let rate = document.querySelector("#rating").value;
                if(rate == 0 || rate != index + 1){
                    rate = 0;
                    stars.forEach(function(star) {
                        star.classList.remove('star-active');
                    });
                }
            });

            star.addEventListener("click", function() {
                // Đặt giá trị rating
                document.querySelector("#rating").value = index + 1;

                // Đặt lớp active cho các sao đánh giá đã được click
                stars.forEach(function(s, i) {
                    if (i <= index) {
                        s.classList.add("active");
                    } else {
                        s.classList.remove("active");
                    }
                });
            });
        });
        // Lắng nghe sự kiện click vào button "Add to Cart"
        document.querySelector('#add-to-cart').addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của button khi click
            document.querySelector('#add-to-cart-form').submit(); // Submit form
        });
    </script>
<!-- End related-product Area -->
@endsection

@section('js')
    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
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
