<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\TempCustomerDetail;
use DB;
use Log;
   
class MoneySetupController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {

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

        return view('stripe', compact('final_price'));
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {

        $php_session_id = session()->getId();

        $tempcustomer = TempCustomerDetail::where('php_session_id', $php_session_id)->first();


        $total_price = DB::select('SELECT sum(quantity * unit_price) as total FROM `temp_cart` where php_session_id = "'.$php_session_id.'" GROUP BY `php_session_id` ASC');

        $final_price = (isset($total_price[0]->total)) ? $total_price[0]->total : 0;

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


        $chargeArry = [
                "amount" => $final_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Speedy Order Payment for the user "
        ];

        $response = \Stripe\Charge::create($chargeArry);

        Log::info('Stripe Response : '.json_encode($response));
  
        Session::flash('success', 'Payment Successful!');
          
        return redirect('/stripeform');


    }
}
