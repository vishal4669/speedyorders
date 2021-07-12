<?php

namespace Modules\AdminProduct\Imports;

use Exception;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductImageImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {
        try{
            ProductGallery::create([
                'id'            =>  $row['product_image_id'],
                'product_id'    =>  $row['product_id'],
                'image'         =>  $row['image'],
                'order'         =>  $row['sort_order']
            ]);
        }  
        catch(Exception $e)
        {
            Log::info('Product Image File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
