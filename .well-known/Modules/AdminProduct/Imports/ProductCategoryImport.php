<?php

namespace Modules\AdminProduct\Imports;

use Exception;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductCategoryImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {    
        try{
            ProductCategory::create([
                "product_id"    => $row['product_id'],
                "category_id"   => $row['category_id']
            ]);
        }
        catch(Exception $e)
        {
            Log::info('Product Category File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
