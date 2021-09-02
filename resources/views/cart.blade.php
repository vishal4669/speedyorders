@extends('layouts.app')

@section('content')
<!-- cart-main-area start -->
<div class="cart-main-area ptb--120 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($cartItems))
                                    @php
                                        $total_amount = 0;
                                    @endphp
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="images/products/{{$item->image}}" alt="product img" /></a></td>
                                            <td class="product-name"><a href="#">{{$item->name}}</a></td>
                                            <td class="product-price"><span class="amount">${{$item->unit_price}}</span></td>
                                            <td class="product-quantity">{{$item->quantity}}</td>

                                            @php
                                                $total_amount += ($item->unit_price * $item->quantity); 
                                            @endphp

                                            <td class="product-subtotal">${{$item->unit_price * $item->quantity}}</td>
                                            <td class="product-remove"><a href="#" onclick="removeFromCart('{{$item->product_id}}')"><i class="ti-trash"></i></a></td>
                                        </tr>
                                    @endforeach    
                                @else
                                    <tr>

                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-7 col-xs-12">
                            
                        </div>
                        <div class="col-md-4 col-sm-5 col-xs-12">
                            <div class="">
                                <h2>Cart Totals</h2>
                                <br>
                                <table cellpadding="10" cellspacing="10">
                                    <tbody>
                                      
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td>
                                                <strong><span class="amount">&nbsp;&nbsp;&nbsp;${{$total_amount}}</span></strong>
                                            </td>
                                        </tr>                                           
                                    </tbody>
                                </table>
                                <br>
                                <div class="wc-proceed-to-checkout">
                                    <a href="{{route('checkout')}}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->
       @endsection
@section('ext_js')
    
@endsection