<?php


namespace App\Imports;

use App\Models\KriteriaModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KriteriaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Pastikan bahwa keterangan tidak null
        if (!isset($row['keterangan']) || !isset($row['kode_kriteria']) || !isset($row['prioritas']) || !isset($row['bobot'])) {
            return null;
        }

        return new KriteriaModel([
            'id_kriteria' => $row['id_kriteria'],
            'keterangan' => $row['keterangan'],
            'kode_kriteria' => $row['kode_kriteria'],
            'prioritas' => $row['prioritas'],
            // 'bobot' => $row['bobot'],
        ]);
    }
}

