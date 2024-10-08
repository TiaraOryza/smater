@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Member (Alternatif)</h1>

    <a href="{{ url('Alternatif') }}" class="btn btn-secondary btn-6icon-split" style="background-color: rgb(85, 121, 176)">
        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

@if (session('message'))
    {!! session('message') !!}
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Tambahkan Data Member Disini</h6>
    </div>

    <form action="{{ url('Alternatif/simpan') }}" method="POST">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="font-weight-bold">Nama Member</label>
                    <input autocomplete="off" type="text" name="nama" required class="form-control"/>
                </div>
                <div class="form-group col-md-12">
                    <label class="font-weight-bold">Telepon</label>
                    <input autocomplete="off" type="text" name="telepon" required class="form-control"/>
                </div>
                <div class="form-group col-md-12">
                    <label class="font-weight-bold">Alamat</label>
                    <input autocomplete="off" type="text" name="alamat" required class="form-control"/>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success"></i> Simpan</button>
            <button type="reset" class="btn btn-info"></i> Reset</button>
        </div>
    </form>
</div>

@include('layouts.footer_admin')
