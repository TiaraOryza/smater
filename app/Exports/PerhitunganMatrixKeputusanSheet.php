<?php



namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PerhitunganMatrixKeputusanSheet implements FromArray, WithHeadings, WithTitle
{
    private $data;
    private $kriterias;

    public function __construct($data, $kriterias)
    {
        $this->data = $data;
        $this->kriterias = $kriterias;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        $kriteriaCodes = $this->kriterias->pluck('kode_kriteria')->toArray();
        return ['No', 'Nama Alternatif', 'C1', 'C2'] + $kriteriaCodes;
    }

    public function title(): string
    {
        return 'Matrix Keputusan';
    }
}
