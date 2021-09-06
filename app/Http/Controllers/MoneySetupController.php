<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\TempCart;
use App\Models\TempCustomerDetail;
use App\Models\TempCustomerTransaction;
use App\Models\TempProductOptionValue;
use DB;
use Log;
use App\Models\CustomerUser;
use App\Models\Customer;
use Hash;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductOption;
use Str;
use App\Utils\Option;
   
class MoneySetupController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {

        //Option::get('stripe_enable_status');

        $publisher_key = Option::get('stripe_key');
        $stripe_secret = Option::get('stripe_secret');

        $stripe_payment_mode = Option::get('stripe_payment_mode');
        if($stripe_payment_mode=="SANDBOX"){
            $publisher_key = Option::get('stripe_key');
            $stripe_secret = Option::get('stripe_secret');
        } else if($stripe_payment_mode=="LIVE"){
            $publisher_key = Option::get('live_stripe_key');
            $stripe_secret = Option::get('live_stripe_secret');
        } 


        $php_session_id = session()->getId();

        $total_price = DB::select('SELECT sum(quantity * unit_price) as total FROM `temp_cart` where php_session_id = "'.$php_session_id.'" GROUP BY `php_session_id` ASC LIMIT 1');

        $final_price = (isset($total_price[0]->total)) ? $total_price[0]->total : 0;

        $inputs = $request->all();

        if(!empty($inputs) && isset($request->first_name) && $request->first_name!=''){

            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $address_1 = $request->address_1;
            $address_2 = $request->address_2;
            $email = $request->email;
            $phone = $request->phone;
            $shipping_country_name = $request->shipping_country_name;
            $region = $request->region;
            $city = $request->city;
            $postcode = $request->postcode;
            $comment = $request->comment;            

            $tempcustomer = TempCustomerDetail::where('php_session_id', $php_session_id)->first();
            if(empty($tempcustomer)){
                $tempcustomer = new TempCustomerDetail(); 
                $tempcustomer->php_session_id = $php_session_id; 
                $tempcustomer->created_at = now();         
            }

            $tempcustomer->first_name = $first_name;
            $tempcustomer->last_name = $last_name;
            $tempcustomer->address_1 = $address_1;
            $tempcustomer->address_2 = $address_2;
            $tempcustomer->email = $email;
            $tempcustomer->postcode = $postcode;
            $tempcustomer->phone = $phone;

            $tempcustomer->payment_first_name = $first_name;
            $tempcustomer->payment_last_name = $last_name;
            $tempcustomer->payment_company = '';
            $tempcustomer->payment_address_1 = $address_1;
            $tempcustomer->payment_address_2 = $address_2;
            $tempcustomer->payment_city = $city;
            $tempcustomer->payment_region = $region;
            $tempcustomer->payment_postcode = $postcode;
            $tempcustomer->payment_country_name = $shipping_country_name;

            $tempcustomer->payment_method = 'stripe';
            $tempcustomer->payment_unique_code = '';

            $tempcustomer->shipping_first_name = $first_name;
            $tempcustomer->shipping_last_name = $last_name;
            $tempcustomer->shipping_company = '';
            $tempcustomer->shipping_address_1 = $address_1;
            $tempcustomer->shipping_address_2 = $address_2;
            $tempcustomer->shipping_city = $city;
            $tempcustomer->shipping_region = $region;
            $tempcustomer->shipping_postcode = $postcode;
            $tempcustomer->shipping_country_name = $shipping_country_name;

            $tempcustomer->shipping_method = 'shipstation';
            $tempcustomer->shipping_unique_code = '';
            $tempcustomer->shipping_tracking_code = '';
            
            $tempcustomer->comment = $comment;

            $tempcustomer->status = $comment;
            $tempcustomer->currency_code = 'USD';
            $tempcustomer->currency_value = '';

            $tempcustomer->save();
        }

        return view('stripe', compact('final_price', 'publisher_key'));
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        try
        {
            DB::beginTransaction();

            $php_session_id = session()->getId();

            $tempcustomer = TempCustomerDetail::where('php_session_id', $php_session_id)->first();

            // Now need to create user if not exists
            $customer_user_id = CustomerUser::where('email', $tempcustomer->email)->pluck('id')->first();

            $total_price = DB::select('SELECT sum(quantity * unit_price) as total FROM `temp_cart` where php_session_id = "'.$php_session_id.'" GROUP BY `php_session_id` ASC');

            $final_price = (isset($total_price[0]->total)) ? $total_price[0]->total : 0;

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $chargeArry = [
                    "amount" => $final_price * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Speedy Order Payment for the user ",
                    "receipt_email" => $tempcustomer->email

            ];

            $response = \Stripe\Charge::create($chargeArry);

            $paymentStatus = (isset($response->status)) ? $response->status : '';
            
            if($paymentStatus && $paymentStatus=="succeeded"){

                Log::info("Payment Success");

                $temptransaction = new TempCustomerTransaction();
                $temptransaction->description = '';
                $temptransaction->php_session_id = $php_session_id;
                $temptransaction->status = $paymentStatus;
                $temptransaction->amount = $final_price;
                $temptransaction->created_at = now();
                $temptransaction->save();


                Log::info("Check customer user id : ".$customer_user_id);

                if(!$customer_user_id){

                    Log::info("Found customer user id : ".$customer_user_id);

                    $password = Hash::make(rand());
                    $customeruser = new CustomerUser();
                    $customeruser->email = $tempcustomer->email;
                    $customeruser->password = $password;
                    $customeruser->status = 1;
                    $customeruser->created_at = now();
                    $customeruser->save();

                    $customer_user_id = $customeruser->id;

                    Log::info("Found customer user id : ".$customer_user_id);

                    // create new customer
                   
                    $customer = new Customer();
                    $customer->first_name = $tempcustomer->first_name;
                    $customer->last_name = $tempcustomer->last_name;
                    $customer->email = $tempcustomer->email;
                    $customer->telephone = $tempcustomer->phone;
                    $customer->status = 1;
                    $customer->customer_user_id = $customer_user_id;
                    $customer->phone = $tempcustomer->phone;
                    $customer->save();
                }

                // create entry in orders table and order products related tables

                Log::info("get customer details : ".json_encode($tempcustomer));


                $orderData = new Order();
                $orderuuid = (string) Str::uuid();
                $orderData->uuid = $orderuuid;
                $orderData->customer_user_id = $customer_user_id;

                $orderData->first_name = $tempcustomer->first_name;
                $orderData->last_name = $tempcustomer->last_name;
                $orderData->address_1 = $tempcustomer->address_1;
                $orderData->address_2 = $tempcustomer->address_2;
                $orderData->email = $tempcustomer->email;
                $orderData->postcode = $tempcustomer->postcode;
                $orderData->phone = $tempcustomer->phone;

                $orderData->payment_first_name = $tempcustomer->first_name;
                $orderData->payment_last_name = $tempcustomer->last_name;
                $orderData->payment_company = '';
                $orderData->payment_address_1 = $tempcustomer->address_1;
                $orderData->payment_address_2 = $tempcustomer->address_2;
                $orderData->payment_city = $tempcustomer->payment_city;
                $orderData->payment_region = $tempcustomer->payment_region;
                $orderData->payment_state = $tempcustomer->payment_region;
                $orderData->payment_postcode = $tempcustomer->postcode;
                $orderData->payment_country_name = $tempcustomer->shipping_country_name;

                $orderData->payment_method = 'stripe';
                $orderData->payment_unique_code = '';

                $orderData->shipping_first_name = $tempcustomer->first_name;
                $orderData->shipping_last_name = $tempcustomer->last_name;
                $orderData->shipping_company = '';
                $orderData->shipping_address_1 = $tempcustomer->address_1;
                $orderData->shipping_address_2 = $tempcustomer->address_2;
                $orderData->shipping_city = $tempcustomer->shipping_city;
                $orderData->shipping_region = $tempcustomer->shipping_region;
                $orderData->shipping_state = $tempcustomer->shipping_region;
                $orderData->shipping_postcode = $tempcustomer->postcode;
                $orderData->shipping_country_name = $tempcustomer->shipping_country_name;

                $orderData->shipping_method = 'shipstation';
                $orderData->shipping_unique_code = '';
                $orderData->shipping_tracking_code = '';
                
                $orderData->comment = $tempcustomer->comment;

                $orderData->status = 2; // for processing
                $orderData->currency_code = 'USD';
                $orderData->currency_value = 50;

                $orderData->save();

                // now add order products 
                $tempCartItems = TempCart::where('php_session_id', $php_session_id)->get();
                foreach($tempCartItems as $tempitem){
                    $itemuuid = (string) Str::uuid();   

                    $orderProduct = OrderProduct::create([
                        'uuid' => $itemuuid,
                        'sku' => $tempitem->sku,
                        'quantity' => $tempitem->quantity,
                        'price' => $tempitem->unit_price,
                        'order_id' => $orderData->id,
                        'product_id' => $tempitem->product_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);


                    // check if options found for the cart product
                    $tempCartItemOptions = TempProductOptionValue::where('php_session_id', $php_session_id)->where('product_id', $tempitem->product_id)->get();
                    if(!empty($tempCartItemOptions)){
                        foreach($tempCartItemOptions as $optionItem){
                            $orderProductOption = OrderProductOption::create([
                                'order_id' => $orderData->id,
                                'order_product_id' => $orderProduct->id,
                                'product_option_id' => $optionItem->option_id,
                                'value' => $optionItem->option_value,
                                'type' => 'input',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }

                // Now delete all temprary data
                DB::delete('delete from temp_cart where php_session_id = ?',[$php_session_id]);
                #DB::delete('delete from temp_customer_details where php_session_id = ?',[$php_session_id]);
                DB::delete('delete from temp_product_option_value where php_session_id = ?',[$php_session_id]);
                DB::delete('delete from temp_customer_transaction where php_session_id = ?',[$php_session_id]);



                Log::info('Stripe Response : '.json_encode($response));  
                Session::flash('success', 'Payment Successful!');
            } else {

                $temptransaction = new TempCustomerTransaction();
                $temptransaction->description = '';
                $temptransaction->php_session_id = $php_session_id;
                $temptransaction->status = $paymentStatus;
                $temptransaction->amount = $final_price;
                $temptransaction->created_at = now();
                $temptransaction->save();

                Log::info('Stripe Response : '.json_encode($response));  
                Session::flash('error', 'Something went wrong, please try again');
            }
            DB::commit();
        } catch (\Exception $e){

            Log::info("Exception : ".$e->getMessage());
            DB::rollback();
            return false;
        }

          
        return redirect('/stripeform');
   

    }
}
