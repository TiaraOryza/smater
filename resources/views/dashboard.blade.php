@include('layouts.header_admin')

@if(session('log.id_user_level') == '1')

<div class="mb-4">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-home"></i> Dashboard</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Selamat datang <span class="text-uppercase"><b>{{ session('log.nama') }}!</b></span> Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.
    </div> --}}
    <div class="row">

        {{-- <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('Kriteria') }}" class="text-secondary text-decoration-none">Data Kriteria</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-database    "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('SubKriteria') }}" class="text-secondary text-decoration-none">Data Sub Kriteria</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

		{{-- <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('Alternatif') }}" class="text-secondary text-decoration-none">Data Member</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

		{{-- <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('Penilaian') }}" class="text-secondary text-decoration-none">Data Penilaian</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-edit fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('Perhitungan') }}" class="text-secondary text-decoration-none">Perhitungan</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calculator fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

		{{-- <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('Hasil') }}" class="text-secondary text-decoration-none">Hasil Akhir</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <!-- rubah clas bg-sucses jadi bg-pink -->
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Nama Member </th>
                        <th>Rangking </th>
                        <th>Jumlah Poin</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    {{-- @foreach --}}
                        <tr align="center">
                            <td>1</td>
                            <td>Puja Shindu</td>
                            <td>1</td>
                            <td>1000</td>
                            <td>Gold</td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif



@if(session('log.id_user_level') == '2')
<div class="mb-4">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-home"></i> Dashboard</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Selamat datang <span class="text-uppercase"><b>{{ session('log.nama') }}!</b></span> Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.
    </div> --}}
    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('Dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
                            </div>
                        </div>
                        {{-- <div class="col-auto">
                            <i class="fas fa-home fa-2x text-gray-300"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('Hasil') }}" class="text-secondary text-decoration-none">Hasil Akhir</a>
                            </div>
                        </div>
                        {{-- <div class="col-auto">
                            <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ url('Profile') }}" class="text-secondary text-decoration-none">Profile</a>
                            </div>
                        </div>
                        {{-- <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


@include('layouts.footer_admin')
