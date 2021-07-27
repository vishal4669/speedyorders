@extends('layouts.main')

@section('ext_css')

@endsection

@section('content')

<style type="text/css">
    #wrapper{
        min-height: 1100px !important;
    }
</style>

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
                                    <td style="width:10%;"><b>Product ID</b></td>
                                    <td style="width:10%;"><b>Product</b></td>
                                    <td style="width:10%;" class="text-right"><b>Unit Price</b></td>
                                    <td style="width:10%;" class="text-right"><b>Quantity</b></td>
                                    <td style="width:10%;" class="text-right"><b>Total</b></td>
                                    <td style="width:10%;"><b>Single</b></td>
                                    <td style="width:10%;"><b>Combo</b></td>
                                    <td style="width:30%;"><b>Select Package</b></td>
                                 </tr>
                              </thead>
                              <tbody>
                                   <?php

                                     $subTotal = 0;
                                     $totalTax=0;
                                     $totalShipping=0;

                                     // define all the selected fields
                                     $productIds = [];
                                     $productNames = [];
                                     $productUnitPrices = [];
                                     $productQuantities = [];
                                     $productTotals = [];
                                     $productSingle = [];
                                     $productCombos = [];
                                     ?>

                                  @forelse($order->orderedProducts as $orderedProduct)
                                  <?php

                                       $individualTotal = $orderedProduct->quantity*$orderedProduct->price;
                                       $subTotal += $individualTotal;
                                       $totalTax += $orderedProduct->tax;
                                       $totalShipping += $orderedProduct->shipping_price;

                                       $productIds[] = $orderedProduct->product->id;
                                       $productNames[] = $orderedProduct->product->name;                                       
                                       $productUnitPrices[] = $orderedProduct->price;    
                                       $productQuantities[] = $orderedProduct->quantity;
                                       $productTotals[] = $individualTotal;

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
                                    <td><input type="checkbox" onclick="getProductPackages('{{$orderedProduct->product->id}}', '{{$order->shipping_postcode}}')" name="order_product_single[]" id="order_product_single_{{$orderedProduct->product->id}}"></td>
                                    <td><input type="checkbox" onclick="resetPackages('{{$orderedProduct->product->id}}')"  name="order_product_combo[]" id="order_product_combo_{{$orderedProduct->product->id}}"></td>
                                    <td><div id="packages_{{$orderedProduct->product->id}}">
                                        <b>Package</b> <select class="form-control" name="single_product_package[]">
                                            
                                        </select>
                                    </div></td>
                                 </tr>
                                 @empty
                                 <tr>
                                     No data found
                                 </tr>
                                 @endforelse
                              </tbody>
                           </table>

                        </div>

                         <div class="row">
                               <div class="col-md-12">  
                                <button type="button" id="" onclick="showSelectedDetails()" class="btn btn-primary pull-right">Continue Shipping</button>
                               </div>
                           </div>
                    </div>


                </div>

              
            </div>

             <div class="col-md-12" id="step_2_div">
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="table-responsive" id="step_2_data">
                        
                        </div>

                         <div class="row">
                               <div class="col-md-12">  
                                <button type="button" id="" class="btn btn-primary pull-right">Mark As Fullfill</button>
                               </div>
                           </div>
                    </div>


                </div>
            </div>

        </div>

        <br>
    </div>
@endsection

@section('ext_js')
<script type="text/javascript">
const productsIds = '<?php echo json_encode($productIds)?>';
const productNames = '<?php echo json_encode($productNames)?>';
const productUnitPrices = '<?php echo json_encode($productUnitPrices)?>';
const productQuantities = '<?php echo json_encode($productQuantities)?>';
const productTotals = '<?php echo json_encode($productTotals)?>';
function showSelectedDetails(){

    var listSingle = $("input[name='order_product_single[]']").map(function () {
        if(this.checked){
            return 1;
        } else{
            return 0;
        }
    }).get();
    
    var listCombo = $("input[name='order_product_combo[]']").map(function () {
        if(this.checked){
            return 1;
        } else{
            return 0;
        }
    }).get();

    var listPackages = $("select[name='single_product_package[]']").map(function () {
        return this.value;
    }).get();

    var url = "{{ route('admin.orders.steptwo.html') }}";

    $.ajax({
        url: url,
        type: 'post',
        data: {
            "_token": "{{ csrf_token() }}",
            "productsIds": productsIds,
            "productNames" : productNames,
            "productUnitPrices" : productUnitPrices,
            "productQuantities" : productQuantities,
            "productTotals" : productTotals,
            "listSingle" : listSingle,
            "listCombo" : listCombo,
            "listPackages" : listPackages
        },
        dataType: 'JSON',
        success: function(data) {
           $("#step_2_data").html(data.html);
        }
    });
}
        

function getProductPackages(productId, shipping_postcode){
    var checkoboxId = "order_product_single_"+productId;
    var checkoboxIdCombo = "order_product_combo_"+productId;


    if($("#"+checkoboxId).prop("checked")){
        $("#"+checkoboxIdCombo).attr("checked", false)
        var url = '{{ route('admin.orders.product.packages') }}';

        $.ajax({
            url: url,
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "productId": productId,
                "shipping_postcode" : shipping_postcode,
                "selectname" : "single_product_package_"+productId
            },
            dataType: 'JSON',
            success: function(data) {
               $("#packages_"+productId).html(data.html);
            }
        });
    } else {
        $("#packages_"+product_id).html('<select style="visibility:hidden" name="single_product_package[]"></select>');
    }

    
}

function resetPackages(product_id){
    var checkoboxIdSingle = "order_product_single_"+product_id;

    $("#packages_"+product_id).html('<select style="visibility:hidden" name="single_product_package[]"></select>');
    $("#"+checkoboxIdSingle).attr("checked", false);
}
        
</script>
@endsection
