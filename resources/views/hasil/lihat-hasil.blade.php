@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Detail Hasil</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Detail Hasil untuk Tanggal: {{ $hasil->first()->tanggal }}</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>Nama Alternatif</th>
                        <th>Nilai</th>
                        <th>Tambah Poin</th>
                        <th>Poin Akhir</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasil as $data)
                    <tr align="center">
                        <td>{{ $data->id_alternatif }}</td>
                        <td>{{ $data->nilai }}</td>
                        <td>{{ $data->tambahan_poin }}</td>
                        <td>{{ $data->poin_smt }}</td>
                        <td>{{ $data->level }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer_admin')
