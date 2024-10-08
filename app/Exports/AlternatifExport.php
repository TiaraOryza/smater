<?php

namespace App\Exports;

use App\Models\AlternatifModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlternatifExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return AlternatifModel::select('nama','telepon','alamat','poin')->get();
    }

    public function headings(): array
    {
        return [
            'Nama Pelanggan (Member)',
            'No Telepon',
            'Alamat',
            'Jumlah Poin'
        ];
    }
}
