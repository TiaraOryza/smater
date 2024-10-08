<?php

namespace App\Imports;

use App\Models\SubKriteriaModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubKriteriaImport implements ToModel, WithHeadingRow
{
    protected $id_kriteria;

    public function __construct($id_kriteria)
    {
        $this->id_kriteria = $id_kriteria;
    }

    public function model(array $row)
    {
        return new SubKriteriaModel([
            'id_kriteria' => $this->id_kriteria,
            'deskripsi' => $row['nama_sub_kriteria'],
            'prioritas' => $row['tingkat_prioritas'],
            // 'nilai' => $row['nilai'],
        ]);
    }
}
