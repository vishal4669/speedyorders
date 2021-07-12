<?php
namespace Modules\AdminFaq\Services;

use App\Models\Faq;
use Illuminate\Support\Facades\DB;
use App\Models\FaqCategory;
class UpdateFaqCategoryService
{

    public function handle(array $validatedData,$id)
    {
        try
        {
            DB::beginTransaction();
                $faqcategory = FaqCategory::find($id);
                $faqcategory->update($validatedData);
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
