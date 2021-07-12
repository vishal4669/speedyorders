<?php


namespace Modules\AdminSetting\Services;


use App\Utils\Option;
use Illuminate\Support\Facades\DB;

class GeneralSettingService
{
    public function handle(array $data)
    {
        try {
            DB::beginTransaction();

            Option::set('company_name', $data['company_name']);
            Option::set('company_address', $data['company_address']);
            Option::set('company_email', $data['company_email']);
            Option::set('company_phone', $data['company_phone']);
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
