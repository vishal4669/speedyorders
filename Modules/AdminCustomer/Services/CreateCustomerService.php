<?php
namespace Modules\AdminCustomer\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Log;

class CreateCustomerService
{

    public function handle(array $validatedData)
    {
        try
        {
            DB::beginTransaction();

                $validatedData['password'] = Hash::make(rand());

                $customer = Customer::create($validatedData);
                if($validatedData['c_first_name'])
                    $customer->addresses()->create($validatedData);

                if($validatedData['description'])
                    $customer->transactions()->create($validatedData);

            DB::commit();
            return true;
        }
        catch(\Exception $e)
        {
            //dd($e);
            Log::info('Error:'.$e->getMessage());
            DB::rollback();
            return false;
        }
    }

}
