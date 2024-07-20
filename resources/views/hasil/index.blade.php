@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
    <div>
    <a href="{{ url('Laporan') }}" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
    <a href="{{ url('Hasil/generate') }}" class="btn btn-primary"><i class="fa fa-calculator"></i> Hitung Poin </a>
    </div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>Nama Alternatif</th>
                        <th>Nilai</th>
                        <th width="15%">Ranking</th>
                        <th width="15%">Tambahan Poin</th>
                        <th width="15%">Poin Sekarang</th>
                        <th width="15%">Level</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($hasil as $keys)
                    @php
                    // Mengubah logika penambahan poin di blade
                    $alt = $keys->nilai <= 0.5 ? 5 : 10;

                    // Mengambil nilai poin sekarang dari database
                    $poinSekarang = $keys->poin;

                    // Menentukan level berdasarkan poin sekarang
                    if ($poinSekarang > 100) {
                        $level = 'Gold';
                    } elseif ($poinSekarang > 80) {
                        $level = 'Bronze';
                    } elseif ($poinSekarang > 40) {
                        $level = 'Silver';
                    } elseif ($poinSekarang > 20){
                        $level = 'Platinum';
                    } else {
                        $level = 'No Level';
                    }
                    @endphp
                    <tr align="center">
                        <td align="left">{{ $keys->nama }}</td>
                        <td>{{ $keys->nilai }}</td>
                        <td>{{ $no }}</td>
                        <td>{{ $alt }}</td>
                        <td>{{ $poinSekarang}}</td>
                        <td>{{ $level }}</td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer_admin')
