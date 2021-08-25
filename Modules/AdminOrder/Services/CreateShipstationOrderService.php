<?php

namespace Modules\AdminOrder\Services;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderProduct;
use App\Models\CouponHistory;
use App\Models\CustomerTransaction;
use App\Models\CustomerUser;
use App\Models\OrderProductOption;
use App\Models\ProductOptionValue;
use LaravelShipStation\ShipStation;
use LaravelShipStation\Models\Address;
use LaravelShipStation\Models\OrderItem;
use LaravelShipStation\Models\Dimensions;
use LaravelShipStation\Models\Weight;
use LaravelShipStation\Models\Order as ProductOrder;
use Log;
use Str;
use DB;


class CreateShipstationOrderService
{
    public function handle($validatedData)
    {   

        $shipStation = new ShipStation(env('SHIPSTATION_API_KEY'),env('SHIPSTATION_API_SECRET'), env('SHIPSTATION_API_URL'));

        #echo "<pre>";
        #print_r($validatedData->all());die;

        $productQuantities = json_decode($validatedData['productQuantities']);
        $productTotals = json_decode($validatedData['productTotals']);
    
        $orderId = $validatedData->orderId;
        $orderData = Order::find($orderId)->toArray();

        try {
            DB::beginTransaction();

            $orderuuid = $orderData['uuid'];

            $total_amt = 0; 
            $products = json_decode($validatedData["productsIds"]);

            // separate the sinngle and combo products 
            $singleProducts = array();
            $comboProducts = array();
            $singlesindexes = $validatedData['listSingle'];

            foreach ($products as $key => $productId) {
                //if(isset($singlesindexes[$key]) && $singlesindexes[$key]==1){
                    $singleProducts[] = $productId;
                //} else {
                  //  $comboProducts[] = $productId;
                //}
            }


            // create orders for single products
            //$shipStation = new ShipStation(env('SHIPSTATION_API_KEY'),env('SHIPSTATION_API_SECRET'), env('SHIPSTATION_API_URL'));
            $address = new Address();

            $address->name = $orderData['shipping_first_name']." ".$orderData['shipping_last_name'];
            $address->street1 = $orderData['shipping_address_1'];
            $address->city = $orderData['shipping_city'];
            $address->state = $orderData['address_1'];
            $address->postalCode = $orderData['shipping_postcode'];
            $address->country = "US";
            $address->phone = $orderData['phone'];


            $indexv = 1;
            foreach($singleProducts as $productId){

                Log::info("indexv : ".$indexv);

                //get product quantities
                $quantity = OrderProduct::where('order_id', $orderId)->where('product_id', $productId)->pluck('quantity')->first();

                $product = Product::find($productId);

                $productItem2 = new OrderItem();
                $productItem2->lineItemKey = $product->uuid;
                $productItem2->sku = $product->sku;
                $productItem2->name = $product->name;
                $productItem2->quantity = $quantity;
                $productItem2->unitPrice  = $product->base_price;
                
                $porder = new ProductOrder();

                $porder->orderNumber = $product->uuid;
                $porder->orderKey = $orderData['uuid'];
                $porder->orderDate = $orderData['created_at'];
                $porder->orderStatus = 'awaiting_shipment';
                $porder->amountPaid += $product->base_price;
                $porder->taxAmount = '0.00';
                $porder->shippingAmount = '0.00';
                $porder->billTo = $address;
                $porder->shipTo = $address;
                $porder->items[] = $productItem2;

                $total_amt += $product->base_price;

                Log::info('Order Data : '.json_encode($porder));

                $response_single = $shipStation->orders->create($porder);

                if(isset($response_single->orderId) && $response_single->orderId!=''){
                    $orderProductData = OrderProduct::where('order_id',$orderData["id"])->where('product_id', $product->id)->first();
                    $orderProductData->shipstation_order_id = $response_single->orderId;
                    $orderProductData->save();
                }  


                $indexv++;     
            }

            //$shipStation2 = new ShipStation(env('SHIPSTATION_API_KEY'),env('SHIPSTATION_API_SECRET'), env('SHIPSTATION_API_URL'));
           /* $address2 = new Address();

            $address2->name = $orderData['shipping_first_name']." ".$orderData['shipping_last_name'];
            $address2->street1 = $orderData['shipping_address_1'];
            $address2->city = $orderData['shipping_city'];
            $address2->state = $orderData['address_1'];
            $address2->postalCode = $orderData['shipping_postcode'];
            $address2->country = "US";
            $address2->phone = $orderData['phone'];

            // Combo product parameters
            $package_length = (isset($validatedData["package_length"])) ? $validatedData["package_length"] : 0;
            $package_width = (isset($validatedData["package_width"])) ? $validatedData["package_width"] : 0;
            $package_height = (isset($validatedData["package_height"])) ? $validatedData["package_height"] : 0;
            $package_size_unit = (isset($validatedData["package_size_unit"]) && $validatedData["package_size_unit"]=="cm") ? "cm" : 'inchs';

            if($package_size_unit=="cm"){
                $package_length = $package_length * env('CM_TO_INCH');
                $package_width = $package_width * env('CM_TO_INCH');
                $package_height = $package_height * env('CM_TO_INCH');
            }

            $dimensions = new Dimensions();
            $dimensions->length = $package_length;
            $dimensions->width = $package_width;
            $dimensions->height = $package_height;
            $dimensions->units = 'inchs';

            $package_weight = (isset($validatedData["package_weight"])) ? $validatedData["package_weight"] : 0;
            $package_weight_unit = (isset($validatedData["package_weight_unit"])) ? $validatedData["package_weight_unit"] : '';

            if($package_weight_unit=="kg"){
                $package_weight = $package_weight * env('KG_TO_OZ');
            } else if($package_weight_unit=="lb"){
                $package_weight = $package_weight * env('LB_TO_OZ');
            }

            $weight = new Weight();
            $weight->value = $package_weight;
            $weight->units = 'oz';

            // create orders for combo products            
            $porder2 = new ProductOrder(); 
            $porder2->orderNumber = $orderData['uuid'];
            $porder2->orderKey = $orderData['uuid'];
            $porder2->orderDate = $orderData['created_at'];
            $porder2->orderStatus = 'awaiting_shipment';
            $porder2->billTo = $address2;
            $porder2->shipTo = $address2;
            $porder2->dimensions = $dimensions;
            $porder2->weight = $weight;            

            foreach($comboProducts as $productId){

                //get product quantities
                $quantity = OrderProduct::where('order_id', $orderId)->where('product_id', $productId)->pluck('quantity')->first();

                $product = Product::find($productId);

                $productItem = new OrderItem();
                $productItem->lineItemKey = $product->uuid;
                $productItem->sku = $product->sku;
                $productItem->name = $product->name;
                $productItem->quantity = $quantity;
                $productItem->unitPrice  = $product->base_price;
                
                $porder2->amountPaid += $product->base_price;
                $porder2->taxAmount += '0.00';
                $porder2->shippingAmount += '0.00';
                $porder2->items[] = $productItem;                                
            }


            $response_combo = $shipStation->orders->create($porder2);

            if(isset($response_combo->orderId) && $response_combo->orderId!=''){

                foreach($comboProducts as $productId){
                    $orderProductData = OrderProduct::where('order_id',$orderData["id"])->where('product_id', $productId)->first();
                    $orderProductData->shipstation_order_id = $response_combo->orderId;
                    $orderProductData->save();
                }
                
            }*/
            
            
                $customerTransaction = CustomerTransaction::create([
                    'order_id' => $orderData["id"],
                    'customer_user_id' => $orderData['customer_user_id'],
                    'type' => 'debit',
                    'amount' => $total_amt,
                    'currency' => $orderData['currency_code'],
                    'status' => 'initialize',
                    'remarks' =>  $orderData['comment']
                ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            Log::info("Exception Message : ".json_encode($e->getMessage()));
            dd($e);
            DB::rollback();
            return false;
        }
    }


    public function saveProductProcessData(){

        $productQuantities = json_decode($validatedData['productQuantities']);
        $productTotals = json_decode($validatedData['productTotals']);
    
        $orderId = $validatedData->orderId;
        $orderData = Order::find($orderId)->toArray();

        try {
            DB::beginTransaction();

            $orderuuid = $orderData['uuid'];

            $total_amt = 0; 
            $products = json_decode($validatedData["productsIds"]);

            // separate the sinngle and combo products 
            $singleProducts = array();
            $comboProducts = array();
            $singlesindexes = $validatedData['listSingle'];

            foreach ($products as $key => $productId) {
                //if(isset($singlesindexes[$key]) && $singlesindexes[$key]==1){
                    $singleProducts[] = $productId;
                //} else {
                  //  $comboProducts[] = $productId;
                //}
            }

            $indexv = 1;
            foreach($singleProducts as $productId){

                Log::info("indexv : ".$indexv);

                //get product quantities
                $quantity = OrderProduct::where('order_id', $orderId)->where('product_id', $productId)->pluck('quantity')->first();

                $total_amt += $product->base_price;

                Log::info('Order Data : '.json_encode($porder));

                $response_single = $shipStation->orders->create($porder);

                if(isset($response_single->orderId) && $response_single->orderId!=''){
                    $orderProductData = OrderProduct::where('order_id',$orderData["id"])->where('product_id', $product->id)->first();
                    $orderProductData->shipstation_order_id = $response_single->orderId;
                    $orderProductData->save();
                }  

                $indexv++;     
            }


            DB::commit();
            return true;
        } catch (\Exception $e) {
            Log::info("Exception Message : ".json_encode($e->getMessage()));
            dd($e);
            DB::rollback();
            return false;
        }
    
    }
}
