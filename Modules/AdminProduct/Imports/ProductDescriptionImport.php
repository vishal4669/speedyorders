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

class ProductDescriptionImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {    
   
        try{
            $product = Product::where('id', $row['product_id'])->first();
            if($product){
                $product->update([
                    "name"              => $row['name'],
                    "description"       => $row['description'],
                    "meta_title"        => $row['meta_title'],
                    "meta_description"  => $row['meta_description']
                ]);       
            }
        }
        catch(Exception $e)
        {
            Log::info('Product Description File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
