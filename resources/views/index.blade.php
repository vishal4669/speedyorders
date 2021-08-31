@extends('layouts.app')

@section('content')

<!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="#" method="get">
                                    <input placeholder="Search here... " type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
            <!-- Start Offset MEnu -->
            <div class="offsetmenu">
                <div class="offsetmenu__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="off__contact">
                        <div class="logo">
                            <a href="index.html">
                                <img src="tmart/images/logo/logo.png" alt="logo">
                            </a>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetu adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
                    </div>
                    <ul class="sidebar__thumd">
                        <li><a href="#"><img src="tmart/images/sidebar-img/1.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="tmart/images/sidebar-img/2.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="tmart/images/sidebar-img/3.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="tmart/images/sidebar-img/4.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="tmart/images/sidebar-img/5.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="tmart/images/sidebar-img/6.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="tmart/images/sidebar-img/7.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="tmart/images/sidebar-img/8.jpg" alt="sidebar images"></a></li>
                    </ul>
                    <div class="offset__widget">
                        <div class="offset__single">
                            <h4 class="offset__title">Language</h4>
                            <ul>
                                <li><a href="#"> Engish </a></li>
                                <li><a href="#"> French </a></li>
                                <li><a href="#"> German </a></li>
                            </ul>
                        </div>
                        <div class="offset__single">
                            <h4 class="offset__title">Currencies</h4>
                            <ul>
                                <li><a href="#"> USD : Dollar </a></li>
                                <li><a href="#"> EUR : Euro </a></li>
                                <li><a href="#"> POU : Pound </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="offset__sosial__share">
                        <h4 class="offset__title">Follow Us On Social</h4>
                        <ul class="off__soaial__link">
                            <li><a class="bg--twitter" href="#"  title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                            
                            <li><a class="bg--instagram" href="#" title="Instagram"><i class="zmdi zmdi-instagram"></i></a></li>

                            <li><a class="bg--facebook" href="#" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>

                            <li><a class="bg--googleplus" href="#" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a></li>

                            <li><a class="bg--google" href="#" title="Google"><i class="zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Offset MEnu -->
            <!-- Start Cart Panel -->
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="tmart/images/product/sm-img/1.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$105.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="tmart/images/product/sm-img/2.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">Brone Candle</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$25.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price">$130.00</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.html">View Cart</a></li>
                        <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
        <!-- Start Feature Product -->
        <section class="categories-slider-area bg__white">
            <div class="container">
                <div class="row flex-row-reverse">
                    <!-- Start Left Feature -->
                    <div class="col-lg-12 col-xl-12 col-md-12 col-xs-12">
                        <!-- Start Slider Area -->
                        <div class="slider__container slider--one">
                            <div class="slider__activation__wrap owl-carousel owl-theme">
                                <!-- Start Single Slide -->
                                <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: rgba(0, 0, 0, 0) url(images/products/Product_90Lgj05s91.jpg) no-repeat scroll center center / cover ;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-10 col-xl-8 ms-auto col-md-12 col-xs-12">
                                                <div class="slider__inner">
                                                    <h1>Featured <span class="text--theme">Collection</span></h1>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slide -->
                                <!-- Start Single Slide -->
                                <div class="slide slider__full--screen slider-height-inherit  slider-text-left" style="background: rgba(0, 0, 0, 0) url(images/products/Product_AxoBZJA44Z.jpg) no-repeat scroll center center / cover ;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 col-xl-8 col-md-12 col-xs-12">
                                                <div class="slider__inner">
                                                    <h1>Latest <span class="text--theme">Collection</span></h1>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slide -->
                            </div>
                        </div>
                        <!-- Start Slider Area -->
                    </div>
                   
                </div>
            </div>
        </section>
      
      

        
        <!-- Start Our Product Area -->
        <section class="htc__product__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-style-tab">
                      
                            <div class="tab-content another-product-style">
                                <div class="tab-pane active" id="home9">
                                    <div class="product-slider-active2">
                                        <div class="row">

                                            @if(!empty($products))
                                                @foreach($products as $product)
                                                    <div class="col-lg-4 single__pro col-xl-4 cat--1 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="product">
                                                            <div class="product__inner">
                                                                <div class="pro__thumb">
                                                                    <a href="#">
                                                                        <img src="images/products/{{$product->image}}" alt="product images">
                                                                    </a>
                                                                </div>
                                                                <div class="product__hover__info">
                                                                    <ul class="product__action">
                                                                        <li><a data-bs-toggle="modal" data-bs-target="#productModal_{{$product->id}}" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                                                        <li><a title="Add TO Cart" href="{{route('cart')}}"><span class="ti-shopping-cart"></span></a></li>
                                                                       
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="product__details">
                                                                <h2><a href="product-details.html">{{$product->name}}</a></h2>
                                                                <ul class="product__price">
                                                                    <li class="old__price">${{$product->base_price}}</li>
                                                                    <li class="new__price">${{$product->sale_price}}</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <!-- Modal -->
                                                    <div class="modal fade" id="productModal_{{$product->id}}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal__container" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="modal-product">
                                                                        <!-- Start product images -->
                                                                        <div class="product-images">
                                                                            <div class="main-image images">
                                                                                <img alt="big images" src="images/products/{{$product->image}}">
                                                                            </div>
                                                                        </div>
                                                                        <!-- end product images -->
                                                                        <div class="product-info">
                                                                            <h1>{{$product->name}}</h1>
                                                                            <div class="price-box-3">
                                                                                <div class="s-price-box">
                                                                                    <span class="new-price">${{$product->base_price}}</span>
                                                                                    <span class="old-price">${{$product->sale_price}}</span>
                                                                                </div>
                                                                            </div>

                                                                            <?php /*
                                                                            <div class="quick-desc">
                                                                                {!! $product->description !!}
                                                                            </div> */?>
                                                                            
                                                                            <div class="addtocart-btn">
                                                                                <a href="{{route('cart')}}">Add to cart</a>
                                                                            </div>
                                                                        </div><!-- .product-info -->
                                                                    </div><!-- .modal-product -->
                                                                </div><!-- .modal-body -->
                                                            </div><!-- .modal-content -->
                                                        </div><!-- .modal-dialog -->
                                                    </div>
                                                    <!-- END Modal -->

                                                @endforeach
                                                <hr style="margin-top:20px;">
                                                {{$products->links()}}

                                            @endif

                                           
                                        </div>
                                    </div>
                                </div>
                               
                               
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Our Product Area -->





@endsection
@section('ext_js')
    
@endsection
