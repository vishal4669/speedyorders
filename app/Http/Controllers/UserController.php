<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\TempCart;
use App\Models\TempCustomerDetail;
use App\Models\TempProductOptionValue;
use DB;
use Illuminate\Http\Request;
use App\Models\Category;
use session;

class UserController extends Controller {

	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __construct(Request $request) {

	}

	public function index() {
        $activePage = 'categories';
   
		$products = Product::with('options')->with('delivery_time')->select('products.id', 'products.name', 'products.sku', 'products.base_price', 'products.sale_price', 'products.image', 'products.quantity', 'products.description', 'products.status', 'products.return_policy_days')
			->orderByDesc('id')
			->paginate(6);

		return view('index', compact('products', 'activePage'));
	}

}
