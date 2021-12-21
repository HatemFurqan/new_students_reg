<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $serial_number = trim($row['alrkm_altslsly']);
        $name    = trim($row['alasm']);
        $section = trim($row['alksm']);
        $status  = trim($row['odaa_altalb']);
        $path  = trim($row['almsar']);

        if(!is_null($serial_number) && !is_null($name) && !is_null($section) && !is_null($status) && !is_null($path)){

            Student::query()->updateOrCreate([
                'serial_number' => $serial_number,
                'section' => $section == 'بنين' ? '1' : '2',
                ],
                [
                'name'    => $name,
                'status'  => $status == 'منتظم' ? '1' : '0',
                'path'    => $path,
            ]);

        }
    }

    public function batchSize(): int
    {
        return 300;
    }

    public function chunkSize(): int
    {
        return 300;
    }

}
