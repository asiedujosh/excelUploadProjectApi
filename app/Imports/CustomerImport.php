<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CustomerImport implements ToCollection, WithBatchInserts, WithChunkReading, ShouldQueue
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        foreach ($rows as $row) 
        {
            Customer::create([
                "domain"=> $row[0],
                "subDomain"=> $row[1],
                "category"=> $row[2],
                "subCategory"=> $row[3],
                "healthOutcome"=> $row[4],
                "variable"=> $row[5],
                "variableName"=> $row[6],
                "variableDescription"=> $row[7],
                "sex"=> $row[8],
                "race"=> $row[9],
                "ethnicity"=> $row[10],
                "age" => $row[11],
                "geography"=> $row[12],
                "dataUnit"=> $row[13],
                "dataYear"=> $row[14],
                "dataSourceName"=> $row[15],
                "dataSource"=> $row[16],
                "dataPortalName"=> $row[17],
                "dataPortal"=> $row[18],
                "dataFormat"=> $row[19],
                "dataLocation"=> $row[20],
                "accessedDate"=> $row[21],
                "processed"=> $row[22],
                "note"=> $row[23],
            ]);
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }
}
