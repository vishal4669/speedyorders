<?php
namespace Modules\AdminFaq\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Faq;

class UpdateFaqService
{

    public function handle(array $validatedData,$id)
    {
        try
        {
            DB::beginTransaction();
                $faq = Faq::find($id);
                $faq->update($validatedData);
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
