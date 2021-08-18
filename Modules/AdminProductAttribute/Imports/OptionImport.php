<?php

namespace Modules\AdminProductAttribute\Imports;

use Exception;
use App\Models\Attribute;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AttributeImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {    
       try{

            Option::create([
                'id'     => $row['id'],
                'type'    => $row['type'],
                'sort_order' => $row['sort_order'],
             ]);
            }
            catch(Exception $e)
            {
                Log::info('Option Type File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
