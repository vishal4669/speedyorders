<?php

namespace Modules\AdminProduct\Imports;


use Exception;
use App\Models\ProductOption;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductOptionImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {    
   
        try{
            ProductOption::create([
                "id"            => $row['product_option_id'],
                "product_id"    => $row['product_id'],
                "option_id"     => $row['option_id'],
                "required"      => $row['required']
            ]);
            
        }
        catch(Exception $e)
        {
            Log::info('Product Option File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
