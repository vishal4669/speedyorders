<?php
namespace Modules\AdminCustomer\Services;

use Illuminate\Support\Facades\DB;

class UpdateCustomerService
{

    public function handle(array $validatedData)
    {
        try
        {
            DB::beginTransaction();
                
            DB::commit();
            return true;
        }
        catch(\Exception $e)
        {
            DB::rollback();
           return false;
        }
    }

}
