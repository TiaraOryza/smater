@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Alternatif</h1>

    <div style="display: grid; grid-template-columns: auto auto auto; gap: 19px; align-items: center;">
        <a href="{{ url('Alternatif/tambah') }}" class="btn btn-success" style="background-color: rgb(250, 121, 143);"> <i class="fa fa-plus"></i> Tambah Data </a>
        <button type="button" class="btn btn-primary" id="import-button"><i class="fa fa-upload"></i> Import Excel</button>

        <a href="{{ route('alternatif.export') }}" class="btn btn-info"> <i class="fa fa-download"></i> Export Excel </a>

        <form id="import-form" action="{{ route('alternatif.import') }}" method="POST" enctype="multipart/form-data" style="display: none;">
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
                    <tr align="center" style="background-color: rgb(250, 121, 143)">
                        <th width="5%">No</th>
                        <th>Nama Pelanggan (Member)</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Jumlah Poin</th>
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
                            <td class="text-left">{{ $data->nama }}</td>
                            <td class="text-left">{{ $data->telepon }}</td>
                            <td class="text-left">{{ $data->alamat }}</td>
                            <td class="text-left">{{ $data->poin }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="{{ url('Alternatif/edit/'.$data->id_alternatif) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="{{ url('Alternatif/destroy/'.$data->id_alternatif) }}" onclick="return confirm('Apakah anda yakin untuk menghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
