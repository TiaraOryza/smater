@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-database"></i> Data Sub Kriteria Member</h1>

    <?php
    $jml_sb = count($subkriteria);
    if ($jml_sb > 0){ ?>
    <a href="{{ url('SubKriteria/generate') }}" class="btn btn-primary">
        <i class="fa fa-calculator"></i> Hitung Bobot </a>
    <?php } ?>
</div>

{!! session('message') !!}

@if (count($kriteria) == 0)
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="alert alert-info">
            Data masih kosong.
        </div>
    </div>
</div>
@endif

@foreach ($kriteria as $key)
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> {{ $key->keterangan }} ({{ $key->kode_kriteria }})</h6>
            <div style="display: flex; align-items: center;">
                <a href="#tambah{{ $key->id_kriteria }}" data-toggle="modal" class="btn btn-sm btn-success" style="margin-right: 10px;"> <i class="fa fa-plus"></i> Tambah Data </a>
                <a href="{{ route('subkriteria.export', $key->id_kriteria) }}" class="btn btn-sm btn-info" style="margin-right: 10px;"><i class="fa fa-download"></i> Export Excel</a>

                <button type="button" class="btn btn-sm btn-primary" id="import-button-{{ $key->id_kriteria }}" style="margin-right: 10px;"><i class="fa fa-upload"></i> Import Excel</button>

                <form id="import-form-{{ $key->id_kriteria }}" action="{{ route('subkriteria.import', $key->id_kriteria) }}" method="POST" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <input type="file" name="file" id="file-input-{{ $key->id_kriteria }}" required>
                    <button type="submit" style="display: none;"></button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambah{{ $key->id_kriteria }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Data {{ $key->keterangan }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form action="{{ url('SubKriteria/simpan') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="id_kriteria" value="{{ $key->id_kriteria }}">
                        <div class="form-group">
                            <label for="deskripsi" class="font-weight-bold">Nama Sub Kriteria</label>
                            <input autocomplete="off" type="text" id="deskripsi" class="form-control" name="deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Rangking (Tingkat Prioritas)</label>
                            <input autocomplete="off" type="number" name="prioritas" required class="form-control"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> Kembali</button>
                        <button type="submit" class="btn btn-success"> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Nama Sub Kriteria</th>
                        <th>Tingkat Prioritas</th>
                        <th>Nilai</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sub_kriteria1 = \App\Models\SubKriteriaModel::data_sub_kriteria($key->id_kriteria);
                    $no = 1;
                    ?>

                    @foreach ($sub_kriteria1 as $key)
                    <tr align="center">
                        <td>{{ $no }}</td>
                        <td align="left">{{ $key->deskripsi }}</td>
                        <td>{{ $key->prioritas }}</td>
                        <td>
                            @if($key->nilai == NULL)
                                {{ "-" }}
                            @else
                                {{ $key->nilai }}
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a data-toggle="modal" title="Edit Data" href="#editsk{{ $key->id_sub_kriteria }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="{{ url('SubKriteria/destroy/'.$key->id_sub_kriteria) }}" onclick="return confirm('Apakah anda yakin untuk menghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="editsk{{ $key->id_sub_kriteria }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit data {{ $key->deskripsi }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form action="{{ url('SubKriteria/edit/'.$key->id_sub_kriteria) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <input type="hidden" name="id_kriteria" value="{{ $key->id_kriteria }}">
                                        <div class="form-group">
                                            <label for="deskripsi" class="font-weight-bold">Nama Sub Kriteria</label>
                                            <input type="text" id="deskripsi" autocomplete="off" class="form-control" value="{{ $key->deskripsi }}" name="deskripsi" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tingkat Prioritas (Rangking Kriteria)</label>
                                            <input autocomplete="off" type="number" name="prioritas" value="{{ $key->prioritas }}" required class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-success"> Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    $no++;
                    ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach

@include('layouts.footer_admin')

<script>
@foreach ($kriteria as $key)
    document.getElementById('import-button-{{ $key->id_kriteria }}').addEventListener('click', function() {
        document.getElementById('file-input-{{ $key->id_kriteria }}').click();
    });

    document.getElementById('file-input-{{ $key->id_kriteria }}').addEventListener('change', function() {
        document.getElementById('import-form-{{ $key->id_kriteria }}').submit();
    });
@endforeach
</script>
