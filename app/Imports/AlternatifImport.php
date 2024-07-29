<?php

namespace App\Imports;

use App\Models\AlternatifModel;
use Maatwebsite\Excel\Concerns\ToModel;

class AlternatifImport implements ToModel
{
    public function model(array $row)
    {
        return new AlternatifModel([
            // 'id_alternatif' => $row[0],
            'nama' => $row[0],
            'telepon' => $row[1],
            'alamat' => $row[2],
            // 'poin' => $row[2],
        ]);
    }
}
