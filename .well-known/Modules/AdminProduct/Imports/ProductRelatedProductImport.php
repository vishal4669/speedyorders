<?php

namespace Modules\AdminProduct\Imports;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\ProductRelatedProduct;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductRelatedProductImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {         
      try{
        ProductRelatedProduct::create([
            "product_id"            => $row['product_id'],
            "related_product_id"    => $row['related_id'] 
        ]);
      }
      catch(Exception $e)
        {
            Log::info('Product Related Product File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
