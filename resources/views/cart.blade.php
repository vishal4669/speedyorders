@extends('layouts.app')

@section('content')
<!-- cart-main-area start -->
<div class="cart-main-area ptb--120 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th style="width:5%" class="product-thumbnail">Image</th>
                                    <th style="width:12%"  class="product-name">Product</th>
                                    <th style="width:8%"  class="product-price">Price</th>
                                    <th style="width:5%"  class="product-quantity">Quantity</th>
                                    <th style="width:25%"  class="product-options">Options</th>
                                    <th style="width:10%"  class="product-subtotal">Total</th>
                                    <th style="width:5%"  class="product-remove">Remove</th>
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

                                             <td>                                                
                                                <?php 
                                                    $options_data = App\Models\TempProductOptionValue::leftjoin('options','options.id','=','temp_product_option_value.option_id')
                                                                ->where('product_id', $item->product_id)
                                                                ->where('php_session_id', $php_session_id)
                                                                ->select(['options.name','temp_product_option_value.option_value'])
                                                                ->get();
                                                    if(!empty($options_data)){
                                                        foreach($options_data as $option_data){
                                                            echo "<b>".$option_data->name."</b> : ".$option_data->option_value."<br>";
                                                        }
                                                    } 
                                                ?>
                                            </td>
                                            <td class="product-subtotal">${{$item->unit_price * $item->quantity}}</td>
                                           
                                            <td class="product-remove"><a href="#" onclick="removeFromCart('{{$item->product_id}}')"><i class="ti-trash"></i></a></td>
                                        </tr>
                                    @endforeach    
                                @endif
                                @if(count($cartItems)==0)
                                    <tr>
                                        <th colspan="7">No Item in the cart</th>
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