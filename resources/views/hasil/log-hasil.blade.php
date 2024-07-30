@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Log Hasil</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Log Hasil</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logHasil as $hasil)
                    <tr align="center">
                        <td>{{ $hasil->tanggal }}</td>
                        <td>
                            <a href="{{ url('Hasil/generate') }}" class="btn btn-primary">
                                <i class="fa fa-calculator"></i> Update Poin
                            </a>
                            <form action="{{ route('log-hasil.hapus', $hasil->tanggal) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                            <a href="{{ route('hasil.lihat', $hasil->tanggal) }}" class="btn btn-info">
                                <i class="fa fa-eye"></i> Lihat
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer_admin')
