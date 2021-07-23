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
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AdminOrder\Services\CreateOrderService;
use Modules\AdminOrder\Services\UpdateOrderService;
use Modules\AdminOrder\Http\Requests\CreateOrderRequest;
use Modules\AdminOrder\Http\Requests\UpdateOrderRequest;
use Modules\AdminOrder\Services\CreateOrderHistoryService;
use Modules\AdminOrder\Http\Requests\CreateOrderHistoryRequest;
use LaravelShipStation\ShipStation;

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


        print_r($productOptions);die;

        $responseHtml = '';
        foreach($productOptions as $po){
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
        return response()->json(array('success' => true, 'html'=>$responseHtml));
    }

    public function packageValue(Request $request){

        if(!$request->productId){
            return;
        }

        $productPackages = ProductGroup::where('product_id',$request->productId)
                            ->join('shipping_zone_prices', 'shipping_zone_prices.shipping_zone_groups_id', '=', 'product_groups.group_id')
                            ->join('shipping_packages', 'shipping_packages.id', '=', 'shipping_zone_prices.shipping_packages_id')
                            ->select(['group_id', 'shipping_packages.id','shipping_packages.package_name'])
                            ->groupBy('product_groups.group_id')
                            ->get();

                            
        $responseHtml = '';

        $returnHTML = view('adminorder::htmlelement.package',[
            'option'=> 'Package',
            'productPackage'=>$productPackages,
            'productId'=>$request->productId,
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
}
