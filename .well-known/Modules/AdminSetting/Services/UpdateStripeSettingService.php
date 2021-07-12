<?php


namespace Modules\AdminSetting\Services;


use App\Utils\Option;
use Illuminate\Support\Facades\DB;

class UpdateStripeSettingService
{
    public function handle(array $validatedData)
    {
        try
        {
            DB::beginTransaction();
            Option::set('stripe_key', $validatedData['stripe_key']);
            Option::set('stripe_secret', $validatedData['stripe_secret']);
            DB::commit();
            return true;
        }
        catch (\Exception $e)
        {
            DB::rollback();
            return false;
        }
    }
}
