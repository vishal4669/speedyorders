<?php
namespace Modules\AdminStateTax\Services;

use App\Models\StateTax;
use Illuminate\Support\Facades\DB;


class CreateStateTaxService
{

    public function handle(array $validatedDatas)
    {
        try
        {
            DB::beginTransaction();

            if(isset($validatedDatas['image']))
            {
                $image = $validatedDatas['image'];
                $imageName = uniqid().time().$image->getClientOriginalName();
                $image->move(public_path('images/categories'),$imageName);
                $validatedDatas['image'] = $imageName;
            }
            
            StateTax::create($validatedDatas);
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
