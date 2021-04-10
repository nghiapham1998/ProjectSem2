<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digital & Electronics</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/Fontend/images/favicon.ico')}}">
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

    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                <div class="container">
                    <div class="topbar-menu left-menu">
                        <ul>
                            <li class="menu-item" >
                                <a title="Hotline: (+123) 456 789" href="#" ><span class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
                            </li>
                        </ul>
                    </div>
                    <div class="topbar-menu right-menu">
                        <ul>

                            <?php
                               $customer_id = \Illuminate\Support\Facades\Session::get('customer_id');
                               if ($customer_id != null){

                            ?>
                            <li class="menu-item" ><a title="Register or Login" href="{{URL::to('/logout-checkout')}}">Đăng xuất</a></li>
                            <?php
                         }else { ?>
                             <li class="menu-item" ><a title="Register or Login" href="{{URL::to('/login-checkout')}}">Đăng nhập</a></li>
                            <li class="menu-item" ><a title="Register or Login" href="{{URL::to('/register')}}">Đăng kí</a></li>
                               <?php  }?>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        <a href="index.html" class="link-to-home"><img src="{{asset('public/Fontend/images/logo-top-1.png')}}" alt="mercado"></a>
                    </div>

                    <div class="wrap-search center-section">
                        <div class="wrap-search-form">
                            <form action="{{URL::to('/tim-kiem')}}" id="form-search-top" name="form-search-top" method="get">
                                {{csrf_field()}}
                                <input type="text" name="search"  placeholder="Search here...">
                                <button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>

                            </form>
                        </div>
                    </div>

                    <div class="wrap-icon right-section">
                        <div class="wrap-icon-section wishlist">
                            <a href="#" class="link-direction">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <div class="left-info">
                                    <span class="index">0 item</span>
                                    <span class="title">Wishlist</span>
                                </div>
                            </a>
                        </div>
                        <div class="wrap-icon-section minicart">
                            <a href="#" class="link-direction">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <div class="left-info">
                                    <span class="index">4 items</span>
                                    <span class="title">CART</span>
                                </div>
                            </a>
                        </div>
                        <div class="wrap-icon-section show-up-after-1024">
                            <a href="#" class="mobile-navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="nav-section header-sticky">
                <div class="header-nav-section">
                    <div class="container">
                        <ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info" >
                            <li class="menu-item"><a href="#" class="link-term">Weekly Featured</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Hot Sale items</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top new items</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top Selling</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top rated items</a><span class="nav-label hot-label">hot</span></li>
                        </ul>
                    </div>
                </div>

                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                            <li class="menu-item home-icon">
                                <a href="{{URL::to('/trang-chu')}}" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{URL::to('/about-us')}}" class="link-term mercado-item-title">About Us</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{URL::to('/shop')}}" class="link-term mercado-item-title">Shop</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{URL::to('/show-cart')}}" class="link-term mercado-item-title">Cart</a>
                            </li>
                            <?php
                            $customer_id = \Illuminate\Support\Facades\Session::get('customer_id');
                            $shipping_id =  \Illuminate\Support\Facades\Session::get('shipping_id');
                            $cart_session = \Illuminate\Support\Facades\Session::get('cart_id');
                            if ($customer_id != null && $shipping_id == null && $cart_session != null){ ?>
                            <li class="menu-item">
                                <a href="{{URL::to('/checkout')}}" class="link-term mercado-item-title">Thanh toán</a>
                            </li>
                            <?php }elseif($customer_id != null && $shipping_id != null && $cart_session != null) { ?>
                            <li class="menu-item" ><a title="Register or Login" href="{{URL::to('/payment')}}">Thanh toán</a></li>
                            <?php  }elseif($customer_id != null && $shipping_id == null && $cart_session == null){?>
                            <li class="menu-item" ><a title="Register or Login" href="{{URL::to('/')}}">Thanh toán</a></li>
                            <?php } ?>
                            <li class="menu-item">
                                <a href="{{URL::to('/contact-us')}}" class="link-term mercado-item-title">Contact Us</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
