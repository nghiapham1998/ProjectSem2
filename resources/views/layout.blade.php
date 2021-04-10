<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digital & Electronics</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{('public/fontend/images/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fontend/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fontend/css/chosen.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fontend/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fontend/css/color-01.css')}}">
</head>
<body class="home-page home-01 ">

<!-- mobile menu -->
<div class="mercado-clone-wrap">
    <div class="mercado-panels-actions-wrap">
        <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
    </div>
    <div class="mercado-panels"></div>
</div>

<!--header-->

<header id="header" class="header header-style-1">
    @include('include.header')
</header>

<!--main area-->
<main id="main" class="main-site left-sidebar">

    <div class="container">


        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Digital & Electronics</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                <div class="wrap-main-slide">
                    <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
                        <div class="item-slide">
                            <img src="{{URL::to('public/fontend/images/shop-banner.jpg')}}" alt="" class="img-slide">

                        </div>
                        <div class="item-slide">
                            <img src="{{URL::to('public/fontend/images/shop-banner.jpg')}}" alt="" class="img-slide">

                        </div>
                        <div class="item-slide">
                            <img src="{{URL::to('public/fontend/images/shop-banner.jpg')}}" alt="" class="img-slide">

                        </div>
                    </div>
                </div>

                @yield('content')

            </div><!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget mercado-widget categories-widget">
                    <h2 class="widget-title">All Categories</h2>
                    <div class="widget-content">
                        <ul class="list-category">
                            @foreach($category_product as $key => $cate)
                            <li class="category-item has-child-cate">
                                <a href="{{URL::to('/danhmucsanpham/'.$cate->category_id)}}" class="cate-link">{{$cate->category_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- Categories widget-->

                <div class="widget mercado-widget filter-widget brand-widget">
                    <h2 class="widget-title">Brand</h2>
                    <div class="widget-content">
                        <ul class="list-category">
                            @foreach($brand_product as $key => $brand)
                                <li class="category-item has-child-cate">
                                    <a href="{{URL::to('/thuonghieusanpham/'.$brand->brand_id)}}" class="cate-link">{{$brand->brand_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- brand widget-->

                <div class="widget mercado-widget filter-widget price-filter">
                    <h2 class="widget-title">Price</h2>
                    <div class="widget-content">
                        <div id="slider-range"></div>
                        <p>
                            <label for="amount">Price:</label>
                            <input type="text" id="amount" readonly>
                            <button class="filter-submit">Filter</button>
                        </p>
                    </div>
                </div><!-- Price-->



                <div class="widget mercado-widget filter-widget">

                    <div class="widget-content">

                        <div class="widget-banner">
                            <figure><img src="{{URL::to('public/fontend/images/size-banner-widget.jpg')}}" width="270" height="331" alt=""></figure>
                        </div>
                    </div>
                </div><!-- Size -->

                <div class="widget mercado-widget widget-product">
                    <h2 class="widget-title">Sản phẩm đề xuẤT</h2>
                    <div class="widget-content">
                        <ul class="products">
                            @foreach($export_product as $value)
                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="{{URL::to('/chitietsanpham/'.$value->product_id)}}" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                            <figure><img src="{{asset('public/upload/product/'.$value->product_image)}}" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                        <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                    </div>
                                </div>
                            </li>
                            @endforeach






                        </ul>
                    </div>
                </div><!-- brand widget-->

            </div><!--end sitebar-->

        </div><!--end row-->

    </div><!--end container-->

</main>
<!--main area-->

<!--footer area-->
<footer id="footer">
    @include('include.footer')
</footer>

<script src="{{asset('public/fontend/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
<script src="{{asset('public/fontend/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
<script src="{{asset('public/fontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/fontend/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('public/fontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('public/fontend/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('public/fontend/js/jquery.sticky.js')}}"></script>
<script src="{{asset('public/fontend/js/functions.js')}}"></script>
</body>
</html>
