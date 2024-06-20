@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Edit Data Alternatif</h1>

    <a href="{{ url('Alternatif') }}" class="btn btn-secondary btn-6icon-split" style="background-color: rgb(85, 121, 176)">
        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text"> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    {{-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-edit"></i> Edit Data Alternatif</h6>
    </div> dihapus--}}

    <form method="POST" action="{{ url('Alternatif/update/'.$alternatif->id_alternatif) }}">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <input type="hidden" name="id_alternatif" value="{{ $alternatif->id_alternatif }}">
                <div class="form-group col-md-12">
                    <label class="font-weight-bold">Nama Alternatif</label>
                    <input autocomplete="off" type="text" name="nama" value="{{ $alternatif->nama }}" required class="form-control"/>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success"> Simpan</button>
            <button type="reset" class="btn btn-info"> Reset</button>
        </div>
    </form>

</div>

@include('layouts.footer_admin')
