<?php

namespace App\Exports;

use App\Models\PenilaianModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenilaianExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil data dari PenilaianModel
        return PenilaianModel::join('alternatif', 'penilaian.id_alternatif', '=', 'alternatif.id_alternatif')
            ->join('kriteria', 'penilaian.id_kriteria', '=', 'kriteria.id_kriteria')
            ->select('alternatif.nama as Nama Member', 'kriteria.keterangan as Kriteria', 'penilaian.nilai as Nilai')
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Header kolom sesuai dengan data
        return [
            'Nama Member',
            'Kriteria',
            'Nilai',
        ];
    }
}
