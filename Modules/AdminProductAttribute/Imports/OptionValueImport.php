<?php

namespace Modules\AdminProductOption\Imports;

use Exception;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AttributeValueImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {    

        try{
            if($row["language_id"] == 1){
                AttributeValue::create([
                    'id'     => $row['attribute_value_id'],
                    'attributes_id'    => $row['attributes_id'],
                    'name' => $row['name'],
                 ]);
               
            }
        }
        catch(Exception $e)
        {
            Log::info('Attribute Value Description File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
