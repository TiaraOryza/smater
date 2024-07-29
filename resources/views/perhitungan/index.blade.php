@include('layouts.header_admin')

<?php
\App\Models\PerhitunganModel::hapus_hasil();

// Matrix Keputusan (nyoba)
$matriks_n = [];
$matriks_x = [];
$penilaian_ada = false;
foreach ($alternatifs as $alternatif) {
    foreach ($kriterias as $kriteria) {
        $id_alternatif = $alternatif->id_alternatif;
        $id_kriteria = $kriteria->id_kriteria;

        $data_pencocokan = \App\Models\PerhitunganModel::data_nilai($id_alternatif, $id_kriteria);
        $nilai_n = !empty($data_pencocokan['deskripsi']) ? $data_pencocokan['deskripsi'] : 0;
        $nilai_x = !empty($data_pencocokan['nilai']) ? $data_pencocokan['nilai'] : 0;

        $matriks_n[$id_kriteria][$id_alternatif] = $nilai_n;
        $matriks_x[$id_kriteria][$id_alternatif] = $nilai_x;

        if ($nilai_n != 0 || $nilai_x != 0) {
            $penilaian_ada = true;
        }
    }
}

// Total Bobot
$total_bobot = $kriterias->sum('bobot');

// Matrix Keputusan (X)
$nilai_u = [];
$total_nilai = [];
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
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan Metode</h1>
    <a href="{{ route('perhitungan.export') }}" class="btn btn-info" style="margin-right: 10px;"> <i class="fa fa-download"></i> Export Excel </a>
</div>

@if (!$penilaian_ada)
    <div class="alert alert-info" role="alert">
        Silahkan inputkan nilai sekarang, data masih kosong karena nilai belum diinput.
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Penilaian Matrix Keputusan [X]</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th width="5%" rowspan="2">No</th>
                        <th>Nama Alternatif</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $no => $alternatif)
                    <tr align="center">
                        <td>{{ $no + 1 }}</td>
                        <td align="left">{{ $alternatif->nama }}</td>
                        @foreach ($kriterias as $kriteria)
                            <td>{{ $matriks_n[$kriteria->id_kriteria][$alternatif->id_alternatif] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Normalisasi Matrix Keputusan [X]</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th width="5%" rowspan="2">No</th>
                        <th>Nama Alternatif</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $no => $alternatif)
                    <tr align="center">
                        <td>{{ $no + 1 }}</td>
                        <td align="left">{{ $alternatif->nama }}</td>
                        @foreach ($kriterias as $kriteria)
                            <td>{{ $matriks_x[$kriteria->id_kriteria][$alternatif->id_alternatif] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                    <tr align="center" class="bg-light">
                        <th colspan="2">Max</th>
                        @foreach ($kriterias as $kriteria)
                        <th>{{ max($matriks_x[$kriteria->id_kriteria]) }}</th>
                        @endforeach
                    </tr>
                    <tr align="center" class="bg-light">
                        <th colspan="2">Min</th>
                        @foreach ($kriterias as $kriteria)
                        <th>{{ min($matriks_x[$kriteria->id_kriteria]) }}</th>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Bobot Kriteria (W)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        @foreach ($kriterias as $kriteria)
                        <th>{{ $kriteria->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr align="center">
                        @foreach ($kriterias as $kriteria)
                        <td>{{ $kriteria->bobot }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Nilai Utility (U)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th width="5%" rowspan="2">No</th>
                        <th>Nama Alternatif</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $no => $alternatif)
                    <tr align="center">
                        <td>{{ $no + 1 }}</td>
                        <td align="left">{{ $alternatif->nama }}</td>
                        @foreach ($kriterias as $kriteria)
                            <td>{{ $nilai_u[$kriteria->id_kriteria][$alternatif->id_alternatif] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Perhitungan Nilai Akhir</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th width="5%" rowspan="2">No</th>
                        <th>Nama Alternatif</th>
                        <th>Perhitungan</th>
                        <th>Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $no => $alternatif)
                    <tr align="center">
                        <td>{{ $no + 1 }}</td>
                        <td align="left">{{ $alternatif->nama }}</td>
                        <td>
                        <?php
                        $id_alternatif = $alternatif->id_alternatif;
                        $perhitungan = [];
                        foreach ($kriterias as $kriteria) {
                            $id_kriteria = $kriteria->id_kriteria;
                            $bobot_normalisasi = ($total_bobot != 0) ? ($kriteria->bobot / $total_bobot) : 0;
                            $perhitungan[] = $nilai_u[$id_kriteria][$id_alternatif] . " x " . $bobot_normalisasi;
                        }
                        echo "SUM(" . implode(" + ", $perhitungan) . ")";
                        ?>
                        </td>
                        <td>{{ $total_nilai[$id_alternatif] }}</td>
                    </tr>
                    <?php
                    DB::table('hasil')->insert([
                        'id_alternatif' => $id_alternatif,
                        'nilai' => $total_nilai[$id_alternatif],
                    ]);
                    ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer_admin')
