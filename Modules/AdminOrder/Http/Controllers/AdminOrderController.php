<?php

namespace Modules\AdminOrder\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Customer;
use App\Models\CustomerUser;
use App\Models\OrderHistory;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\CouponHistory;
use App\Models\ProductOption;
use App\Models\ProductGroup;
use App\Models\ShippingZonePrice;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AdminOrder\Services\CreateOrderService;
use Modules\AdminOrder\Services\UpdateOrderService;
use Modules\AdminOrder\Http\Requests\CreateOrderRequest;
use Modules\AdminOrder\Http\Requests\UpdateOrderRequest;
use Modules\AdminOrder\Services\CreateOrderHistoryService;
use Modules\AdminOrder\Http\Requests\CreateOrderHistoryRequest;
use Modules\AdminOrder\Services\CreateShipstationOrderService;
use LaravelShipStation\ShipStation;
use Log;
use DB;


class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = [
            'menu' => 'orders',
        ];

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $orders = Order::where('customer_user_id', 'LIKE', "%$keyword%")
                ->orWhere('invoice_number', 'LIKE', "%$keyword%")
                ->orWhere('invoice_prefix', 'LIKE', "%$keyword%")
                ->orWhere('first_name', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('address1', 'LIKE', "%$keyword%")
                ->orWhere('address2', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('postal_code', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('payment_first_name', 'LIKE', "%$keyword%")
                ->orWhere('payment_last_name', 'LIKE', "%$keyword%")
                ->orWhere('payment_company', 'LIKE', "%$keyword%")
                ->orWhere('payment_address1', 'LIKE', "%$keyword%")
                ->orWhere('payment_address2', 'LIKE', "%$keyword%")
                ->orWhere('payment_city', 'LIKE', "%$keyword%")
                ->orWhere('payment_postalcode', 'LIKE', "%$keyword%")
                ->orWhere('payment_country_name', 'LIKE', "%$keyword%")
                ->orWhere('payment_region', 'LIKE', "%$keyword%")
                ->orWhere('payment_method', 'LIKE', "%$keyword%")
                ->orWhere('payment_unique_code', 'LIKE', "%$keyword%")
                ->orWhere('shipping_first_name', 'LIKE', "%$keyword%")
                ->orWhere('shipping_last_name', 'LIKE', "%$keyword%")
                ->orWhere('shipping_company', 'LIKE', "%$keyword%")
                ->orWhere('shipping_address1', 'LIKE', "%$keyword%")
                ->orWhere('shipping_address2', 'LIKE', "%$keyword%")
                ->orWhere('shipping_city', 'LIKE', "%$keyword%")
                ->orWhere('shipping_postalcode', 'LIKE', "%$keyword%")
                ->orWhere('shipping_country_name', 'LIKE', "%$keyword%")
                ->orWhere('shipping_region', 'LIKE', "%$keyword%")
                ->orWhere('shipping_method', 'LIKE', "%$keyword%")
                ->orWhere('shipping_unique_code', 'LIKE', "%$keyword%")
                ->orWhere('shipping_tracking_code', 'LIKE', "%$keyword%")
                ->orWhere('comment', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('commisison', 'LIKE', "%$keyword%")
                ->orWhere('currency_code', 'LIKE', "%$keyword%")
                ->orWhere('currency_value', 'LIKE', "%$keyword%")
                ->orWhere('ip', 'LIKE', "%$keyword%")
                ->orderByDesc('id')
                ->latest()->paginate($perPage);
        } else {
            $orders = Order::latest()->orderByDesc('id')->paginate($perPage);
        }

        return view('adminorder::index', compact('orders'),$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'menu' => 'orders',
        ];
        $customers = CustomerUser::select('id','email')->get();
        $products = Product::select('id','name','base_price','sku')->get();
        $coupons = Coupon::select('id','code')->get();
        return view('adminorder::create',compact('customers','products','coupons'),$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateOrderRequest $request,CreateOrderService $service)
    {

        $validatedData = $request->validated();

        if($service->handle($validatedData))
        {
            session()->flash('success_message','Order created successfully.');
        }
        else
        {
            session()->flash('error_message','Order could not be created.');
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.orders.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data = [
            'menu' => 'orders',
        ];

        $order = Order::with('orderedProducts','orderedProducts.orderProductOptions')->findOrFail($id);

        return view('adminorder::show', compact('order'),$data);
    }

    /**
     * Process the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\Process
     */
    public function process($id)
    {
        $data = [
            'menu' => 'orders',
            'order_id' => $id
        ];

        $order = Order::with('orderedProducts','orderedProducts.orderProductOptions')->findOrFail($id);

        return view('adminorder::process', compact('order'),$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'menu' => 'orders',
        ];

        $order = Order::where('id',$id)->with('orderedProducts','orderedProducts.orderProductOptions')->first();
        $customers = CustomerUser::select('id','email')->get();
        $products = Product::select('id','name','base_price','sku')->get();
        $coupons = Coupon::get();
        return view('adminorder::edit', compact('order','customers','products','coupons'),$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateOrderRequest $request, $id,UpdateOrderService $service)
    {
        $validatedData = $request->validated();

        if($service->handle($validatedData,$id))
        {
            session()->flash('success_message','Order updated successfully.');
        }
        else
        {
            session()->flash('error_message','Order could not be updated.');
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.orders.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect()->route('admin.orders.index')->with('flash_message', 'Order deleted!');
    }

    public function updateOrderStatus($id)
    {
        try
        {
            $order = Order::find($id);
            if($order->status=='1')
            {
                $status = '0';
            }
            else
            {
                $status = '1';
            }
            Order::where('id',$id)->first()->update(['status' => $status]);
            session()->flash('success_message', 'Order updated successfully.');
        }
        catch (\Exception $e)
        {
            session()->flash('error_message','Order could not be updated.');
        }

        return redirect()->route('admin.orders.index');

    }

    public function optionValue(Request $request){

        if(!$request->productId){
            return;
        }

        $productOptions = ProductOption::where('product_id',$request->productId)
        ->with('product','optionValues','option')->get();

        $responseHtml = '';
        if(!empty($productOptions)){
            foreach($productOptions as $po){

                Log::info("PO:".json_encode($po));
                if(isset($po->option) && !empty($po->option)){
                    switch($po->option->type){
                        case 'input':
                            $returnHTML = view('adminorder::htmlelement.input',[
                                'option'=>$po->option,
                                'productId'=>$request->productId,
                                'productOption'=>$po
                                ])->render();
                            $responseHtml .= $returnHTML;
                        break;
                        case 'text':
                            $returnHTML = view('adminorder::htmlelement.input',[
                                'option'=>$po->option,
                                'productId'=>$request->productId,
                                'productOption'=>$po
                                ])->render();
                            $responseHtml .= $returnHTML;
                        break;
                        case 'select':
                            $returnHTML = view('adminorder::htmlelement.select',[
                                'option'=>$po->option,
                                'productId'=>$request->productId,
                                'productOption'=>$po
                            ])->render();
                            $responseHtml .= $returnHTML;
                        break;
                    }
                }
            }
        }
        return response()->json(array('success' => true, 'html'=>$responseHtml));
    }

    /**
     * All below packages will show based on the postal code used in the order and selected zone prices in the products edit
     * @param  Request productId 
     * @return json  return all available packages
     */
    public function packageValue(Request $request){

        if(!$request->productId){
            return;
        }

        $productId = $request->productId;
        $productPackages = ProductGroup::where('product_id',$productId)
                            ->join('shipping_zone_prices', 'shipping_zone_prices.shipping_zone_groups_id', '=', 'product_groups.group_id')
                            ->join('shipping_packages', 'shipping_packages.id', '=', 'shipping_zone_prices.shipping_packages_id')
                            ->select(['group_id', 'shipping_packages.id','shipping_packages.package_name']);

        if(isset($request->shipping_postcode) && $request->shipping_postcode!=''){                    
            $productPackages = $productPackages->where('shipping_zone_prices.zip_code', $request->shipping_postcode)
                            ->groupBy('shipping_packages.id')
                            ->get();                          
        } else{
            $productPackages = $productPackages->groupBy('product_groups.group_id')
                            ->get();
        }
                            
        $responseHtml = '';

       $selectname = 'single_product_package[]';

        $returnHTML = view('adminorder::htmlelement.package',[
            'option'=> 'Package',
            'productPackage'=>$productPackages,
            'productId'=>$request->productId,
            'selectname' => $selectname
            ])->render();
        
        $responseHtml .= $returnHTML;   
        
        return response()->json(array('success' => true, 'html'=>$responseHtml));
    }

    public function showOrderInvoices($id)
    {
        $order = Order::where('id',$id)->with('orderedProducts','orderedProducts.orderProductOptions')->first();
        $pdf = PDF::loadView('adminorder::report',compact('order'));
        return $pdf->stream('doc.pdf'); 
    }

    public function showOrderShippingInvoices($id)
    {
        $order = Order::where('id',$id)->with('orderedProducts','orderedProducts.orderProductOptions')->first();
        $pdf = PDF::loadView('adminorder::shipping-report',compact('order'));
        return $pdf->stream('shippingdoc.pdf');
    }

    public function adminOrderHistoryStore(CreateOrderHistoryRequest $request,CreateOrderHistoryService $service)
    {
        $validatedData = $request->validated();

        if($service->handle($validatedData))
        {
            session()->flash('success_message','Order history created successfully.');
        }
        else
        {
            session()->flash('error_message','Order history could not be created.');
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }

    public function getOrderData(){

        $shipStation = new ShipStation('28243d7551d441a3ac6acddcb937f255', 'b8adcebd9271434781d84f5ebca8e705', 'https://ssapi.shipstation.com');

      //  $order = $shipStation->orders->getOrderId('113-0885678-6154618'); // returns integer

         
       $order = $shipStation->orders->get([], $endpoint = '751103607'); // returns \stdClass


       print_r($order);die;

    }

    public function getStep2Html(Request $request){

        $productsIds = json_decode($request->productsIds);
        $productNames = json_decode($request->productNames);
        $listPackages = $request->listPackages;

        $singles = $request->listSingle;

        $singalarr = $comboarr = array();
        
        $indexsingle = $indexcombo = 0;
        foreach($singles as $key => $value){
            if($value==1){
                $singalarr[$indexsingle]["id"] = $productsIds[$key];
                $singalarr[$indexsingle]["name"] = $productNames[$key];
                $singalarr[$indexsingle]["package"] = $this->getPackageName($listPackages[$key]);
                $indexsingle++;
            }
            
            if($value==0){
                $comboarr[$indexcombo]["id"] = $productsIds[$key];
                $comboarr[$indexcombo]["name"] = $productNames[$key];
                $indexcombo++;
            }
        }

        $returnHTML = view('adminorder::htmlelement.step2',[
                            'singalarr' => $singalarr,
                            'comboarr' => $comboarr,
                            //'productUnitPrices' => $productUnitPrices,
                            //'productQuantities' => $productQuantities,
                            //'productTotals' => $productTotals,
                            //'listPackages' => $listPackages,
                        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }


    public function getPackageName($packageId){
        $package = DB::table('shipping_packages')->select('package_name')->where('id', $packageId)->first();

        return (isset($package->package_name)) ? $package->package_name : 'NA';
    }

    /**
     * added the order details related to send on shipstation and send the details there in pending state.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function processOrder(Request $request, CreateShipstationOrderService $shipstationService)
    {
        if($shipstationService->handle($request)){
            $message = 'Order successfully sent on shipstation.';
        } else {
            $message = 'Order could not be sent on shipstation, Please refresh the page and try again.';            
        }

        return response()->json(array('success' => true, 'message'=>$message));

    }

    /**
     * All below delivery times will show based on the postal code used in the order and selected package at order package
     * @param  Request productId 
     * @return json  return all available packages
     */
    public function packageDeliveryTimes(Request $request){

        if(!$request->productId || !$request->packageId){
            return;
        }

        $productId = $request->productId;
        $packageId = $request->packageId;
        $groups = $request->groups;

        $deliveryTimes = ShippingZonePrice::where('shipping_packages_id',$packageId)
                            ->leftjoin('shipping_delivery_times','shipping_delivery_times.id','=','shipping_zone_prices.shipping_delivery_times_id')
                            ->select(['shipping_zone_prices.id', 'shipping_packages_id as package_id','shipping_delivery_times.name', 'price']);



        if(isset($request->shipping_postcode) && $request->shipping_postcode!=''){                    
            $deliveryTimes = $deliveryTimes->where('shipping_zone_prices.zip_code', $request->shipping_postcode);                          
        } 
        
        if(isset($request->groups) && $request->groups!=''){  
            $groups_array = json_decode($groups);                  
            $deliveryTimes = $deliveryTimes->where('shipping_zone_prices.zip_code', $groups_array);                          
        } 

        $deliveryTimes = $deliveryTimes->get();

        $responseHtml = '';

        $selectname = 'product_delivery_time_'.$productId.'[]';

        $returnHTML = view('adminorder::htmlelement.deliverytime',[
            'option'=> 'Package',
            'deliveryTimes'=>$deliveryTimes,
            'productId'=>$request->productId,
            'selectname' => $selectname
            ])->render();
        
        $responseHtml .= $returnHTML;   
        
        return response()->json(array('success' => true, 'html'=>$responseHtml));
    }
}
