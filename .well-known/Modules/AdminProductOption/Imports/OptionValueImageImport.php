<?php

namespace Modules\AdminProductOption\Imports;

use Exception;
use App\Models\OptionValue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class OptionValueImageImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {    
        try{
            $optionValue = OptionValue::where('id', $row['option_value_id'])
            ->where('option_id',$row['option_id'])
            ->first();
                if($optionValue){
                    $optionValue->update([
                    'image'=> $row['image'],
                    'sort_order' => $row['sort_order']
                    ]); 
                }
        }
        catch(Exception $e)
        {
            Log::info('Option Value Image File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
        }
       
        
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
    
}
