<?php

namespace Modules\AdminCategory\Imports;

use Exception;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CategoryDescriptionImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {  
        try{
            $category = Category::where('id', $row['category_id'])->first();

            $category->update([
                'name'           => $row['name'],
                'description'    => $row['description'],
            ]);
        }
        catch(Exception $e)
        {
            Log::info('Category Description File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
