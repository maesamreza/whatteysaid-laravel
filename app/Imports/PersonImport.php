<?php

namespace App\Imports;

use App\Models\Person;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class PersonImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public function transformDate($value, $format = 'Y-m-d')
    {
    try{
        return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
    } 
    catch (\ErrorException $e) {
        return \Carbon\Carbon::createFromFormat($format, $value);

        
    }
    }
    public function model(array $row)
    {
        if($row[4]=="" || $row[4]==null){
            return new Person([
            //
            'person_A'     => $row[0],
            'person_B'    => $row[1], 
            'statement'    => $row[2], 
            'link_statement'    => $row[3],
            'date'    => null

        ]);
        }
        return new Person([
            //
            'person_A'     => $row[0],
            'person_B'    => $row[1], 
            'statement'    => $row[2], 
            'link_statement'    => $row[3],
            'date'    => $this->transformDate($row[4])

        ]);
    }
}
