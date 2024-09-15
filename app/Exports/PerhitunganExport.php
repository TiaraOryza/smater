<?php

namespace App\Exports;

use App\Models\PerhitunganModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PerhitunganExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $alternatifs = AlternatifModel::all();
        $kriterias = KriteriaModel::all();

        // Konversi koleksi Eloquent ke array
        $kriteriasArray = $kriterias->toArray();

        // Data untuk setiap sheet
        $matriks_n = [];
        $matriks_x = [];
        $nilai_u = [];
        $total_nilai = [];
        $total_bobot = $kriterias->sum('bobot');

        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $id_alternatif = $alternatif->id_alternatif;
                $id_kriteria = $kriteria->id_kriteria;

                $data_pencocokan = PerhitunganModel::data_nilai($id_alternatif, $id_kriteria);
                $nilai_n = !empty($data_pencocokan['deskripsi']) ? $data_pencocokan['deskripsi'] : 0;
                $nilai_x = !empty($data_pencocokan['nilai']) ? $data_pencocokan['nilai'] : 0;

                $matriks_n[$id_kriteria][$id_alternatif] = $nilai_n;
                $matriks_x[$id_kriteria][$id_alternatif] = $nilai_x;
            }
        }

        foreach ($alternatifs as $alternatif) {
            $nilai_total = 0;
            $id_alternatif = $alternatif->id_alternatif;

            foreach ($kriterias as $kriteria) {
                $id_kriteria = $kriteria->id_kriteria;
                $bobot = $kriteria->bobot;
                $x = $matriks_x[$id_kriteria][$id_alternatif];
                $min = min($matriks_x[$id_kriteria]);
                $max = max($matriks_x[$id_kriteria]);

                $u = ($max != $min) ? (100 * (($x - $min) / ($max - $min))) : 0;
                $nilai_u[$id_kriteria][$id_alternatif] = $u;
                $nilai_total += $bobot * $u;
            }

            $total_nilai[$id_alternatif] = $nilai_total;
        }

        $perhitungan_matrix = [];
        foreach ($alternatifs as $alternatif) {
            $id_alternatif = $alternatif->id_alternatif;
            $perhitungan = [];
            foreach ($kriterias as $kriteria) {
                $id_kriteria = $kriteria->id_kriteria;
                $bobot_normalisasi = ($total_bobot != 0) ? ($kriteria->bobot / $total_bobot) : 0;
                $perhitungan[] = $nilai_u[$id_kriteria][$id_alternatif] . " x " . $bobot_normalisasi;
            }
            $perhitungan_matrix[] = [
                'No' => $alternatif->id_alternatif,
                'Nama Alternatif' => $alternatif->nama,
                'Perhitungan' => "SUM(" . implode(" + ", $perhitungan) . ")",
                'Total Nilai' => $total_nilai[$id_alternatif]
            ];
        }

        return [
            new PerhitunganMatrixKeputusanSheet(
                $this->generateMatrixKeputusan($matriks_n, $alternatifs, $kriteriasArray),
                $kriterias
            ),
            new PerhitunganNormalisasiSheet(
                $this->generateNormalisasi($matriks_x, $alternatifs, $kriteriasArray),
                $kriterias
            ),
            new PerhitunganBobotSheet($kriterias),
            new PerhitunganUtilitySheet(
                $this->generateUtility($nilai_u, $alternatifs, $kriteriasArray),
                $kriterias
            ),
            new PerhitunganNilaiAkhirSheet($perhitungan_matrix),
        ];
    }

    private function generateMatrixKeputusan($matriks_n, $alternatifs, $kriterias)
    {
        $data = [];
        foreach ($alternatifs as $no => $alternatif) {
            $row = [
                'No' => $no + 1,
                'Nama Alternatif' => $alternatif->nama
            ];
            foreach ($kriterias as $kriteria) {
                $row[$kriteria['kode_kriteria']] = $matriks_n[$kriteria['id_kriteria']][$alternatif->id_alternatif] ?? 0;
            }
            $data[] = $row;
        }
        return $data;
    }

    private function generateNormalisasi($matriks_x, $alternatifs, $kriterias)
    {
        $data = [];
        foreach ($alternatifs as $no => $alternatif) {
            $row = [
                'No' => $no + 1,
                'Nama Alternatif' => $alternatif->nama
            ];
            foreach ($kriterias as $kriteria) {
                $row[$kriteria['kode_kriteria']] = $matriks_x[$kriteria['id_kriteria']][$alternatif->id_alternatif] ?? 0;
            }
            $data[] = $row;
        }

        // Adding Max and Min rows
        $max_min_row = [
            'No' => '',
            'Nama Alternatif' => ''
        ];
        foreach ($kriterias as $kriteria) {
            $max_min_row[$kriteria['kode_kriteria']] = 'Max: ' . max($matriks_x[$kriteria['id_kriteria']]);
        }
        $data[] = $max_min_row;

        $min_row = [
            'No' => '',
            'Nama Alternatif' => ''
        ];
        foreach ($kriterias as $kriteria) {
            $min_row[$kriteria['kode_kriteria']] = 'Min: ' . min($matriks_x[$kriteria['id_kriteria']]);
        }
        $data[] = $min_row;

        return $data;
    }

    private function generateUtility($nilai_u, $alternatifs, $kriterias)
    {
        $data = [];
        foreach ($alternatifs as $no => $alternatif) {
            $row = [
                'No' => $no + 1,
                'Nama Alternatif' => $alternatif->nama
            ];
            foreach ($kriterias as $kriteria) {
                $row[$kriteria['kode_kriteria']] = $nilai_u[$kriteria['id_kriteria']][$alternatif->id_alternatif] ?? 0;
            }
            $data[] = $row;
        }
        return $data;
    }
}
