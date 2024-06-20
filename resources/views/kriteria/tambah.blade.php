@include('layouts.header_admin')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-database"></i> Tambah Data Kriteria Member</h1>

        <a href="{{ url('Kriteria') }}" class="btn btn-secondary btn-6icon-split" style="background-color: rgb(85, 121, 176)">
            <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
            <span class="text">Kembali</span>
    </a>
    </div>

@if (session('message'))
    {!! session('message') !!}
@endif

<div class="card shadow mb-4">
    {{-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success" style="-webkit-text-fill-color: rgb(109, 107, 107)"> Tambah Data Kriteria</h6>
    </div> --}}

    <form action="{{ url('Kriteria/simpan') }}" method="POST">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold" style="-webkit-text-fill-color: rgb(109, 107, 107)">Kode Kriteria </label>
                    <input autocomplete="off" type="text" name="kode_kriteria" required class="form-control"/>
                </div>

                <div class="form-group col-md-4">
                    <label class="font-weight-bold" style="-webkit-text-fill-color: rgb(109, 107, 107)">Nama Kriteria</label>
                    <input autocomplete="off" type="text" name="keterangan" required class="form-control"/>
                </div>

                <div class="form-group col-md-4">
					<label class="font-weight-bold" style="-webkit-text-fill-color: rgb(109, 107, 107)">Tingkat Prioritas (Rangking Kriteria)</label>
					<input autocomplete="off" type="number" name="prioritas" required class="form-control"/>
				</div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success"> Simpan</button>
            <button type="reset" class="btn btn-info"> Hapus</button>
        </div>
    </form>
</div>

@include('layouts.footer_admin')
