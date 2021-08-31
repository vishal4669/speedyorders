<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductOption;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        
    }

    public function index(){

        $products = Product::select('id','name','sku','base_price','sale_price','image','quantity','description','status', 'return_policy_days')->orderByDesc('id')->paginate(6);
      
        return view('index',compact('products'));
    }

    public function cart(){

        //$products = Product::select('id','name','sku','base_price','sale_price','image','quantity','description','status', 'return_policy_days')->orderByDesc('id')->get()->take(50);
      
        return view('cart');
    }
}
