<?php

namespace Modules\AdminCustomer\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CustomerAddress;
use App\Models\CustomerIpAddress;
use Illuminate\Routing\Controller;
use App\Models\CustomerTransaction;
use Modules\AdminCustomer\Services\CreateCustomerService;
use Modules\AdminCustomer\Http\Requests\CreateCustomerRequest;
use Modules\AdminCustomer\Http\Requests\UpdateCustomerRequest;

class AdminCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [
            'menu' => 'customers',
        ];

        $customers = Customer::orderByDesc('id')->get();
        return view('admincustomer::index',compact('customers'),$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = [
            'menu' => 'customers',
        ];
        return view('admincustomer::create',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateCustomerRequest $request,CreateCustomerService $service)
    {
        $validatedData = $request->validated();
        if($service->handle($validatedData))
        {
            session()->flash('success_message','Customer created successfully.');
        }
        else
        {
            session()->flash('error_message','Coupon could not be created.');
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.customers.index');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admincustomer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = [
            'menu' => 'customers',
        ];
        $customer = Customer::where('id',$id)->first();
        return view('admincustomer::edit',compact('customer'),$data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCustomerAddressDetails($id)
    {
        $customerAddress = CustomerAddress::find($id);
        $customerAddress->makeHidden(['created_at','updated_at']);
        return response()->json($customerAddress, 200);
    }

    public function getCustomerTransactionDetails($id)
    {
        $customerAddress = CustomerTransaction::find($id);
        $customerAddress->makeHidden(['created_at','updated_at']);
        return response()->json($customerAddress, 200);
    }

    public function getCustomerIpAddressDetails($id)
    {
        $customerAddress = CustomerIpAddress::find($id);
        $customerAddress->makeHidden(['created_at','updated_at']);
        return response()->json($customerAddress, 200);
    }

    public function updateCustomerStatus($id)
    {
        try
        {
            $customer = Customer::find($id);
            if($customer->status=='1')
            {
                $status = '0';
            }
            else
            {
                $status = '1';
            }
            Customer::where('id',$id)->first()->update(['status' => $status]);
            session()->flash('success_message', 'Customer updated successfully.');
        }
        catch (\Exception $e)
        {
            session()->flash('error_message','Customer could not be updated.');
        }

        return redirect()->route('admin.customers.index');
    }

}
