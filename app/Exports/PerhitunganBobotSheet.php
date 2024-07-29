<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PerhitunganBobotSheet implements FromArray, WithHeadings, WithTitle
{
    private $kriterias;

    public function __construct($kriterias)
    {
        $this->kriterias = $kriterias;
    }

    public function array(): array
    {
        return [$this->kriterias->pluck('bobot')->toArray()];
    }

    public function headings(): array
    {
        return $this->kriterias->pluck('kode_kriteria')->toArray();
    }

    public function title(): string
    {
        return 'Bobot';
    }
}
