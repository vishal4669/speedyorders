<?php

namespace Modules\AdminProductOption\Imports;

use Exception;
use App\Models\OptionValue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class OptionValueImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
{
    
    public function model(array $row)
    {    

        try{
            if($row["language_id"] == 1){
                OptionValue::create([
                    'id'     => $row['option_value_id'],
                    'option_id'    => $row['option_id'],
                    'name' => $row['name'],
                 ]);
               
            }
        }
        catch(Exception $e)
        {
            Log::info('Option Value Description File Import data:'.json_encode($row).' error:'.json_encode($e->getMessage()));
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
