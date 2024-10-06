@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Detail Data Member</h1>

    <div style="display: grid; grid-template-columns: auto auto auto; gap: 19px; align-items: center;">
        <a href="{{ url('Alternatif/edit') }}" class="btn btn-success" style="background-color: rgb(250, 121, 143);"> <i class="fa fa-edit"></i> Edit Data </a>
        <a href="{{ url('Alternatif/hapus') }}" class="btn btn-danger" style="background-color: rgb(255, 9, 50);"> <i class="fa fa-trash"></i> Hapus</a>
        {{-- <button type="button" class="btn btn-primary" id="import-button"><i class="fa fa-upload"></i> Import Excel</button>
        <a href="{{ route('alternatif.export') }}" class="btn btn-info"> <i class="fa fa-download"></i> Export Excel </a> --}}

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
                {{-- <thead class="bg-success text-white"> --}}

                    <tbody>
                        <tr align="center">
                            <td colspan="2" class="section-header" ><B>INFORMASI PRIBADI</B></td>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 200px;">NAMA</th>
                            <td>{{$listdet->nama}}</td>
                        </tr>
                        <tr>
                            <th scope="row">JENIS KELAMIN</th>
                            <td>{{$listdet->jenis_kelamin}}</td>
                        </tr>
                        <tr>
                            <th scope="row">UMUR</th>
                            <td>{{$listdet->umur}}</td>
                        </tr>
                        <tr>
                            <th scope="row">NO TELEPON</th>
                            <td>{{$listdet->telepon}}</td>
                        </tr>
                        <tr>
                            <th scope="row">EMAIL</th>
                            <td>{{$listdet->email}}</td>
                        </tr>
                        <tr>
                            <th scope="row">ALAMAT</th>
                            <td>{{$listdet->alamat}}</td>
                        </tr>
                        <tr align="center">
                            <td colspan="2" class="section-header"><b>INFORMASI KARTU</b></td>
                        </tr>
                        <tr>
                            <th scope="row">TANGGAL JOIN</th>
                            <td>{{$listdet->tanggal_join}}</td>
                        </tr>
                        <tr>
                            <th scope="row">MASA BERLAKU</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">JUMLAH POIN</th>
                            <td>Blitar, 03-03-2002</td>
                        </tr>

                        <tr align="center">
                            <td colspan="2" class="section-header"><b>E-KARTU</b></td>
                        </tr>
                        <tr>
                            <th scope="row">PRINT</th>
                            <td>XXXXXXX</td>
                        </tr>
                    </tbody>
                {{-- </thead> --}}
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
