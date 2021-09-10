<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TempCart;
use App\Models\TempCustomerDetail;
use App\Models\TempProductOptionValue;
use DB;
use Illuminate\Http\Request;
use session;

class HomeController extends Controller {
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __construct(Request $request) {

	}

	public function index() {

		$products = Product::with('options')->with('delivery_time')->select('products.id', 'products.name', 'products.sku', 'products.base_price', 'products.sale_price', 'products.image', 'products.quantity', 'products.description', 'products.status', 'products.return_policy_days')
			->orderByDesc('id')
			->paginate(6);

		#print_r($products);die;

		return view('index', compact('products'));
	}

	public function addToCart(Request $request) {

		/*
			        quantity_48518: 1
			        option_1876_48518>: sd
			        option_1007_48518>: sd
			        option_1877_48518>:
			        options_ids_48518: [1876,1007,1877]
			        productId: 48518input
		*/

		$php_session_id = session()->getId();
		$product_id = $request->product_id;
		$quantity_input = "quantity_" . $product_id;
		$quantity = $request->input($quantity_input);
		$unit_price = Product::where("id", $request->product_id)->pluck('base_price')->first();

		$existsData = TempCart::where('php_session_id', $php_session_id)->where('product_id', $product_id)->first();
		if (!empty($existsData)) {

			$newquantity = $existsData->quantity + $quantity;
			$existsData->quantity = $newquantity;
			$existsData->save();

		} else {
			$tempcart = new TempCart();
			$tempcart->php_session_id = $php_session_id;
			$tempcart->product_id = $product_id;
			$tempcart->quantity = $quantity;
			$tempcart->unit_price = $unit_price;
			$tempcart->created_at = now();
			$tempcart->save();
		}

		// delete old options values and insert new one
		$existOptionValues = TempProductOptionValue::where('product_id', $product_id)->where('php_session_id', $php_session_id);
		if (!empty($existOptionValues)) {
			$existOptionValues->delete();
		}

		// Insert new values
		$option_ids_input = "options_ids_" . $product_id;
		$option_ids = json_decode($request->input($option_ids_input));
		foreach ($option_ids as $option_id) {
			$option_input = "option_" . $option_id . "_" . $product_id;
			$option_value = $request->input($option_input);

			$productOptionValue = new TempProductOptionValue();
			$productOptionValue->php_session_id = $php_session_id;
			$productOptionValue->product_id = $product_id;
			$productOptionValue->option_id = $option_id;
			$productOptionValue->option_value = $option_value;
			$productOptionValue->created_at = now();
			$productOptionValue->save();
		}

		return json_encode(array('success' => true));
	}

	public function cart() {
		$php_session_id = session()->getId();
		$cartItems = TempCart::leftjoin("products", "products.id", "=", "temp_cart.product_id")
			->where('php_session_id', $php_session_id)
			->select(['php_session_id', 'product_id', 'name', 'sku', 'image', 'temp_cart.quantity', 'unit_price', 'product_delivery_time_id', 'shipping_zone_price'])
			->get();

		#   print_r($cartItems);die;

		//$products = Product::select('id','name','sku','base_price','sale_price','image','quantity','description','status', 'return_policy_days')->orderByDesc('id')->get()->take(50);

		return view('cart', compact('cartItems', 'php_session_id'));
	}

	public function removeFromCart(Request $request) {

		$product_id = $request->product_id;

		TempCart::where('product_id', $product_id)->delete();

		return json_encode(array('success' => true));
	}

	public function checkout() {
		$php_session_id = session()->getId();

		$tempcustomer = TempCustomerDetail::where('php_session_id', $php_session_id)->first();
		$total_price_arr = DB::select('SELECT `temp_cart`.quantity, `temp_cart`.unit_price, shipping_zone_price FROM `temp_cart` where `temp_cart`.php_session_id = "' . $php_session_id . '" ');

		$grandtotal = 0;

		foreach($total_price_arr as $pricearr){
			$product_total = 0;
			$qty = $pricearr->quantity;
			$unit_price = $pricearr->unit_price;
			$shippingcharge = $pricearr->shipping_zone_price;

			$product_total = floatval($unit_price) * intval($qty);

			if($shippingcharge){
				$product_total = floatval($product_total) + floatval($shippingcharge);
			}

			$grandtotal += $product_total;

		}

		$final_price = $grandtotal;

		return view('checkout', compact('final_price', 'tempcustomer'));
	}

}
