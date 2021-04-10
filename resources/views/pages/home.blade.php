@extends('layout')
@section('content')

    <div class="wrap-shop-control">

        <h1 class="shop-title">Latest product</h1>



    </div><!--end wrap shop control-->

    <div class="row">

        <ul class="product-list grid-products equal-container">
            @foreach($latest_product as $key => $latest)
            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                <div class="product product-style-3 equal-elem ">
                    <div class="product-thumnail">
                        <a href="{{URL::to('/chitietsanpham/'.$latest->product_id)}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                            <figure><img src="{{URL::to('public/upload/product/'.$latest->product_image)}}" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                        </a>
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-name"><span>{{$latest->product_name}}</span></a>
                        <div class="wrap-price"><span class="product-price">{{number_format($latest->product_price).' VND'}}</span></div>
                        <a href="{{URL::to('/save-cart/'.$latest->product_id)}}" class="btn add-to-cart">Add To Cart</a>

                    </div>
                    <div class="wrap-btn">
                        <a href="#" class="btn btn-compare">Add Compare</a>
                        <a href="#" class="btn btn-wishlist">Add Wishlist</a>
                    </div>
                </div>
            </li>
            @endforeach

        </ul>

    </div>

    <div class="wrap-pagination-info">
        <ul class="page-numbers">
            <li><span class="page-number-item current" >1</span></li>
            <li><a class="page-number-item" href="#" >2</a></li>
            <li><a class="page-number-item" href="#" >3</a></li>
            <li><a class="page-number-item next-link" href="#" >Next</a></li>
        </ul>
        <p class="result-count">Showing 1-8 of 12 result</p>
    </div>
@endsection
