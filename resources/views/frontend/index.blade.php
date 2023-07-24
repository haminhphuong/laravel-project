<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('img/fav.png') }}">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Site Title -->
    <title>@yield('title')</title>
    <!--
        CSS
        ============================================= -->
    @yield('css')

</head>

<body id="@yield('idBody')">
@php
    use Illuminate\Support\Facades\Auth;
    $cart = auth()->user() ? auth()->user()->cart : '';
    $totalQuantity = $cart ? $cart->sum('quantity') : 0;
@endphp
    <!-- Start Header Area -->
<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item {{request()->path() == '/' ? 'active' : ''}}"><a class="nav-link" href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
                        @php
                            use App\Models\Category;
                            $categories = Category::all();
                        @endphp
                        @foreach($categories as $item)
                            <li class="nav-item {{trim(request()->path(),'category') == '/'.$item->slug ? 'active' : ''}}"><a class="nav-link" href="{{route('category.products', ['slug' => $item->slug])}}">{{$item->name}}</a></li>
                        @endforeach
                        <li class="nav-item {{str_contains(request()->path(),'contact') ? 'active' : ''}}"><a class="nav-link" href="{{ route('contact') }}">{{ __('messages.contact') }}</a></li>
                        <li class="nav-item {{str_contains(request()->path(),'account') ? 'active' : ''}}"><a class="nav-link" href="{{ route('account') }}">{{ __('messages.account') }}</a></li>
                        @if(Auth::check())
                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">{{ __('messages.logout') }}</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a href="{{ route('cart.index') }}" class="cart"><span class="ti-bag"></span>
                                <span class="number-product" style="color: orangered">{{$totalQuantity}}</span>
                            </a></li>

                        <li class="nav-item">
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between" method="GET" action="{{ route('search') }}">
                <input type="text" class="form-control" id="search_input"  name="keyword" placeholder="{{ __('messages.search_here') }}">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="{{ __('messages.close_search') }}"></span>
            </form>
        </div>
    </div>
</header>


@yield('mainContent')

<!-- start footer Area -->
<footer class="footer-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>{{ __('messages.about_us') }}</h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
                        magna aliqua.
                    </p>


                </div>
            </div>
            <div class="col-lg-4  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>{{ __('messages.newsletter') }}</h6>
                    <p>{{ __('messages.stay_update') }}</p>
                    <div class="" id="mc_embed_signup">

                        <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                              method="get" class="form-inline">

                            <div class="d-flex flex-row">

                                <input class="form-control" name="EMAIL" placeholder="{{ __('messages.enter_email') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('messages.enter_email') }}'"
                                       required="" type="email">


                                <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                <div style="position: absolute; left: -5000px;">
                                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                </div>

                                <!-- <div class="col-lg-4 col-md-4">
                                            <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                                        </div>  -->
                            </div>
                            <div class="info"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="single-footer-widget mail-chimp">
                    <h6 class="mb-20">{{ __('messages.instagram_feed') }}</h6>
                    <ul class="instafeed d-flex flex-wrap">
                        <li><img src="img/i1.jpg" alt=""></li>
                        <li><img src="img/i2.jpg" alt=""></li>
                        <li><img src="img/i3.jpg" alt=""></li>
                        <li><img src="img/i4.jpg" alt=""></li>
                        <li><img src="img/i5.jpg" alt=""></li>
                        <li><img src="img/i6.jpg" alt=""></li>
                        <li><img src="img/i7.jpg" alt=""></li>
                        <li><img src="img/i8.jpg" alt=""></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>{{ __('messages.follow_us') }}</h6>
                    <p>{{ __('messages.let_us_be_social') }}</p>
                    <div class="footer-social d-flex align-items-center">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
            <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                {{ __('messages.all_rights') }}<script>document.write(new Date().getFullYear());</script> {{ __('messages.all_rights_reserved') }} | {{ __('messages.template_made_with') }} <i class="fa fa-heart-o" aria-hidden="true"></i> {{ __('messages.by') }} <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div>
    </div>
</footer>
<!-- End footer Area -->

@yield('js')
</body>

</html>
