<?php
namespace Modules\AdminCurrency\Services;

use Illuminate\Support\Facades\DB;

class UpdateCurrencyService
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
