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

                if(isset($singlesindexes[$key]) && $singlesindexes[$key]==1){
                    $singleProducts[] = $productId;
                } else {
                    $comboProducts[] = $productId;
                }
            }


            // create orders for single products
            // 
           /* $shipStation = new ShipStation(env('SHIPSTATION_API_KEY'),env('SHIPSTATION_API_SECRET'), env('SHIPSTATION_API_URL'));
            $address = new Address();

            $address->name = $orderData['shipping_first_name']." ".$orderData['shipping_last_name'];
            $address->street1 = $orderData['shipping_address_1'];
            $address->city = $orderData['shipping_city'];
            $address->state = $orderData['address_1'];
            $address->postalCode = $orderData['shipping_postcode'];
            $address->country = "US";
            $address->phone = $orderData['phone'];

            foreach($singleProducts as $productId){
                $product = Product::find($productId);

                $productItem = new OrderItem();
                $productItem->lineItemKey = $product->uuid;
                $productItem->sku = $product->sku;
                $productItem->name = $product->name;
                $productItem->quantity = $productQuantities[$key];
                $productItem->unitPrice  = $product->base_price;
                
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
                $porder->items[] = $productItem;

                $response = $shipStation->orders->create($porder);

                if(isset($response->orderId) && $response->orderId!=''){
                    $orderProductData = OrderProduct::where('order_id',$orderData["id"])->where('product_id', $product->id)->first();
                    $orderProductData->shipstation_order_id = $response->orderId;
                    $orderProductData->save();
                }                
            }*/
            

            $shipStation2 = new ShipStation(env('SHIPSTATION_API_KEY'),env('SHIPSTATION_API_SECRET'), env('SHIPSTATION_API_URL'));
            $address = new Address();

            $address->name = $orderData['shipping_first_name']." ".$orderData['shipping_last_name'];
            $address->street1 = $orderData['shipping_address_1'];
            $address->city = $orderData['shipping_city'];
            $address->state = $orderData['address_1'];
            $address->postalCode = $orderData['shipping_postcode'];
            $address->country = "US";
            $address->phone = $orderData['phone'];

            // Combo product parameters
            $package_length = (isset($validatedData["package_length"])) ? $validatedData["package_length"] : 0;
            $package_width = (isset($validatedData["package_width"])) ? $validatedData["package_width"] : 0;
            $package_height = (isset($validatedData["package_height"])) ? $validatedData["package_height"] : 0;
            $package_size_unit = (isset($validatedData["package_size_unit"]) && $validatedData["package_size_unit"]=="cm") ? "centimeters" : 'inches';

            $package_weight = (isset($validatedData["package_weight"])) ? $validatedData["package_weight"] : 0;

            // create orders for combo products            
            $porder = new ProductOrder(); 
            $porder->orderNumber = $orderData['uuid'];
            $porder->orderKey = $orderData['uuid'];
            $porder->orderDate = $orderData['created_at'];
            $porder->orderStatus = 'awaiting_shipment';
            $porder->billTo = $address;
            $porder->shipTo = $address;

            $dimensions = new Dimensions();
            $dimensions->length = $package_length;
            $dimensions->width = $package_width;
            $dimensions->height = $package_height;
            $dimensions->units = 'inchs';
            
            $porder->dimensions = $dimensions;

            $weight = new Weight();
            $weight->value = $package_weight;
            $weight->units = 'Oz';

            $porder->weight = $weight;            

            foreach($comboProducts as $productId){
                $product = Product::find($productId);

                $productItem = new OrderItem();
                $productItem->lineItemKey = $product->uuid;
                $productItem->sku = $product->sku;
                $productItem->name = $product->name;
                $productItem->quantity = $productQuantities[$key];
                $productItem->unitPrice  = $product->base_price;
                
                $porder->amountPaid += $product->base_price;
                $porder->taxAmount += '0.00';
                $porder->shippingAmount += '0.00';
                $porder->items[] = $productItem;                                
            }

            $response = $shipStation2->orders->create($porder);

            print_r($response);die;

            if(isset($response->orderId) && $response->orderId!=''){
                $orderProductData = OrderProduct::where('order_id',$orderData["id"])->where('product_id', $product->id)->first();
                $orderProductData->shipstation_order_id = $response->orderId;
                $orderProductData->save();
            }

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

}
