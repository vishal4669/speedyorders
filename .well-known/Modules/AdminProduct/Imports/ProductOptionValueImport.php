<?php

namespace Modules\AdminProduct\Imports;


use Exception;
use App\Models\ProductOptionValue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductOptionValueImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {    
   
        try{
            ProductOptionValue::create([
                "id"                    => $row['product_option_value_id'],
                "product_option_id"     => $row['product_option_id'],
                "option_id"             => $row['option_id'],
                "option_value_id"       => $row['option_value_id'],
                "quantity"              => $row['quantity'],
                "subtract_from_stock"   => $row['subtract'],
                "price"                 => $row['price'],
                "price_prefix"          => $row['price_prefix']
    
            ]);
        }
        catch(Exception $e)
        {
            Log::info('Product Option Value File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
