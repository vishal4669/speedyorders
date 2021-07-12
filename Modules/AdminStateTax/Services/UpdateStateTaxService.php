<?php
namespace Modules\AdminCategory\Services;

use App\Models\StateTax;
use Illuminate\Support\Facades\DB;


class UpdateStateTaxService
{

    public function handle(array $validatedDatas,$id)
    {
        try
        {
            DB::beginTransaction();

            $category = StateTax::find($id);
        
            if(isset($validatedDatas['image']))
            {
                $image = $validatedDatas['image'];
                $imageName = uniqid().time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/categories'),$imageName);
                @unlink(public_path('images/categories/'.$category->image));
                $validatedDatas['image'] = $imageName;
            }
           
            $category->update($validatedDatas);
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
