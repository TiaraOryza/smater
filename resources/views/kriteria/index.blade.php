@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-database"></i> Daftar Data Kriteria Member</h1>
    <div style="display: flex; align-items: center;">
        <a href="{{ url('Kriteria/tambah') }}" class="btn btn-success" style="margin-right: 10px;"> <i class="fa fa-plus"></i> Tambah Data </a>
        <a href="{{ url('Kriteria/generate') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-calculator"></i> Hitung Bobot </a>
        <a href="{{ route('kriteria.export') }}" class="btn btn-info" style="margin-right: 10px;"> <i class="fa fa-download"></i> Export Excel </a>

        <button type="button" class="btn btn-primary" id="import-button" style="margin-right: 10px;"><i class="fa fa-upload"></i> Import Excel</button>

        <form id="import-form" action="{{ route('kriteria.import') }}" method="POST" enctype="multipart/form-data" style="display: none; margin-left: 10px;">
            @csrf
            <input type="file" name="file" id="file-input" required style="display: none;">
            <button type="submit" style="display: none;"></button>
        </form>
    </div>
</div>

@if (session('message'))
    {!! session('message') !!}
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Kode Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot Kriteria</th>
                        <th>Rangking Kriteria</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($list as $data)
                        <tr align="center">
                            <td>{{ $no }}</td>
                            <td>{{ $data->kode_kriteria }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>
                                @if($data->bobot == NULL)
                                    {{ "-" }}
                                @else
                                    {{ $data->bobot }}
                                @endif
                            </td>
                            <td>{{ $data->prioritas }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="{{ url('Kriteria/edit/'.$data->id_kriteria) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="{{ url('Kriteria/destroy/'.$data->id_kriteria) }}" onclick="return confirm('Apakah anda yakin untuk menghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
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

<script>
    document.getElementById('import-button').addEventListener('click', function() {
        document.getElementById('file-input').click(); // Trigger file input click
    });

    document.getElementById('file-input').addEventListener('change', function() {
        document.getElementById('import-form').submit(); // Submit the form automatically after file is selected
    });
</script>
