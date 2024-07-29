<?php

namespace App\Exports;

use App\Models\SubKriteriaModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubKriteriaExport implements FromCollection, WithHeadings
{
    protected $id_kriteria;
    protected $header;

    public function __construct($id_kriteria, $header)
    {
        $this->id_kriteria = $id_kriteria;
        $this->header = $header;
    }

    public function collection()
    {
        return SubKriteriaModel::where('id_kriteria', $this->id_kriteria)->get();
    }

    public function headings(): array
    {
        return $this->header;
    }
}

