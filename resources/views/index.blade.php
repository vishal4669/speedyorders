@extends('layouts.app')

@section('content')

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

                                                                            
                                                                            <div class="quick-desc">
                                                                                <label>Quantity</label>
                                                                                <select class="themes-select-all-2" name="quantity_{{$product->id}}" id="quantity_{{$product->id}}">
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="4">4</option>
                                                                                        <option value="5">5</option>
                                                                                        <option value="6">6</option>
                                                                                        <option value="7">7</option>
                                                                                        <option value="8">8</option>
                                                                                        <option value="9">9</option>
                                                                                        <option value="10">10</option>
                                                                                        
                                                                                </select>
                                                                            </div>

                                                                            <div style="display: none;" class="alert alert-primary" id="alert_{{$product->id}}" role="alert">
                                                                             
                                                                            </div> 
                                                                            
                                                                            <div id="cart_btn_{{$product->id}}" class="addtocart-btn">
                                                                                <a onclick="addToCart('{{$product->id}}')" href="#">Add to cart</a>
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


<style type="text/css">
    
    .modal {
  overflow-y:auto;
}
</style>


@endsection

