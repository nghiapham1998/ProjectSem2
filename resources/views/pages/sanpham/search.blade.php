@extends('layout')
@section('content')
    <div class="wrap-shop-control">

            <h1 class="shop-title" style="font-size: 30px; color: #e74c3c;">Kết quả tìm kiếm</h1>



    </div><!--end wrap shop control-->

    <div class="row">

        <ul class="product-list grid-products equal-container">
            @foreach($search_product as $key => $search)
                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                    <div class="product product-style-3 equal-elem ">
                        <div class="product-thumnail">
                            <a href="{{URL::to('/chitietsanpham/'.$search->product_id)}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="{{URL::to('public/upload/product/'.$search->product_image)}}" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>{{$search->product_name}}</span></a>
                            <div class="wrap-price"><span class="product-price">{{number_format($search->product_price).'$'}}</span></div>
                            <a href="#" class="btn add-to-cart">Add To Cart</a>

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


@endsection


