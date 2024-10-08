<?php

namespace App\Exports;

use App\Models\KriteriaModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KriteriaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return KriteriaModel::select('keterangan', 'kode_kriteria', 'prioritas', 'bobot')->get();
    }

    public function headings(): array
    {
        return [
            'Keterangan',
            'Kode Kriteria',
            'Prioritas',
            'Bobot'
        ];
    }
} 
