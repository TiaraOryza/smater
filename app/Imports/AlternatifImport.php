<?php

namespace App\Imports;

use App\Models\AlternatifModel;
use Maatwebsite\Excel\Concerns\ToModel;

class AlternatifImport implements ToModel
{
    public function model(array $row)
    {
        return new AlternatifModel([
            'nama' => $row[0],
            'poin' => $row[1],
        ]);
    }
}
