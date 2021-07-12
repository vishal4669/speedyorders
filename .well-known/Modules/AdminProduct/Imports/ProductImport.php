<?php

namespace Modules\AdminProduct\Imports;

use Exception;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {    
        try{
            $productData = [
                "id"                => $row['product_id'],
                "sku"               => $row['sku'],
                "length"            => $row['length'],  
                "height"            => $row['height'],
                "width"             => $row['width'],
                "base_price"        => $row['price'],
                "quantity"          => $row['quantity'],
                "min_quantity"      => $row['minimum'],
                "subtract_stock"    => $row['subtract'],
                "sort_order"        => $row['sort_order'],
                "status"            => $row['status'],
                "image"             => $row['image'],
    
           ];
            Product::create($productData);

        }
        catch(Exception $e)
        {
            Log::info('Product File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
