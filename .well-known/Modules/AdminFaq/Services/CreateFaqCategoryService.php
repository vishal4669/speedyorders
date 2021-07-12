<?php
namespace Modules\AdminFaq\Services;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Support\Facades\DB;

class CreateFaqCategoryService
{

    public function handle(array $validatedData)
    {
        try
        {
            DB::beginTransaction();
                FaqCategory::create($validatedData);
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
