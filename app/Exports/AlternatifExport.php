<?php

namespace App\Exports;

use App\Models\AlternatifModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlternatifExport implements FromCollection
{
    public function collection()
    {
        return AlternatifModel::all();
    }
}

