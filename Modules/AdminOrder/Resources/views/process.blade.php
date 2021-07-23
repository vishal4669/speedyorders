@extends('layouts.main')

@section('ext_css')

@endsection

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order Details</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Order ID</span>
                                    </td>
                                    <td>{{ $order->uuid }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Order Received</span>
                                    </td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Payment Method</span>
                                    </td>
                                    <td>{{ $order->payment_method }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Comment</span>
                                    </td>
                                    <td>{{ $order->comment }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Customer Details</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Full Name</span>
                                    </td>
                                    <td>{{ $order->first_name.' '.$order->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Address</span>
                                    </td>
                                    <td>{{ $order->address_1 }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Email</span>
                                    </td>
                                    <td>{{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Phone</span>
                                    </td>
                                    <td>{{ $order->phone }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <td><b>Product ID</b></td>
                                    <td><b>Product</b></td>
                                    <td class="text-right"><b>Unit Price</b></td>
                                    <td class="text-right"><b>Quantity</b></td>
                                    <td class="text-right"><b>Total</b></td>
                                    <td><b>Single</b></td>
                                    <td><b>Combo</b></td>
                                    <td><b>Select Package</b></td>
                                 </tr>
                              </thead>
                              <tbody>
                                   <?php
                                     $subTotal = 0;
                                     $totalTax=0;
                                     $totalShipping=0;
                                     ?>

                                  @forelse($order->orderedProducts as $orderedProduct)
                                  <?php

                                       $individualTotal = $orderedProduct->quantity*$orderedProduct->price;
                                       $subTotal += $individualTotal;
                                       $totalTax += $orderedProduct->tax;
                                       $totalShipping += $orderedProduct->shipping_price;

                                   ?>
                                 <tr>
                                    <td>{{ $orderedProduct->product->id }}</td>
                                    <td>
                                       {{ $orderedProduct->product->name }}

                                       @if(count($orderedProduct->orderProductOptions)>0)
                                        <p><b>Variant</b></p>
                                       @foreach($orderedProduct->orderProductOptions ??[] as $orderProductOption)

                                            <p>[{{$orderProductOption->productOption->option->name }} : {{($orderProductOption->productOption->option->type == "select")?$orderProductOption->productOptionValue->optionValue->name:$orderProductOption->value}} ]</p>


                                        @endforeach
                                       @endif
                                    </td>                                  
                                    <td class="text-right">{{ $orderedProduct->quantity }}</td>
                                    <td class="text-right">{{ $orderedProduct->price }}</td>
                                    <td class="text-right">{{ $individualTotal }}</td>
                                    <td><input type="checkbox" name="order_product_single[]" id="order_product_single_{{$orderedProduct->product->id}}"></td>
                                    <td><input type="checkbox" name="order_product_combo[]" id="order_product_combo_{{$orderedProduct->product->id}}"></td>
                                    <td></td>
                                 </tr>
                                 @empty
                                 <tr>
                                     No data found
                                 </tr>
                                 @endforelse
                              </tbody>
                           </table>

                        </div>
                    </div>
                </div>

              
            </div>
        </div>
    </div>
@endsection

@section('ext_js')

@endsection
