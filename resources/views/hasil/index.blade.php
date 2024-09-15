@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
    <div>
        <a href="{{ url('Laporan') }}" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
        <a href="{{ route('log-hasil') }}" class="btn btn-info"><i class="fa fa-book"></i> Lihat Log Hasil</a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
    </div>

    <div class="card-body">
        <form action="{{ route('hasil.simpan') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mb-3">Simpan Hasil</button>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-success text-white">
                        <tr align="center">
                            <th>Nama Alternatif</th>
                            <th>Nilai</th>
                            <th width="15%">Ranking</th>
                            <th width="15%">Poin Awal</th>
                            <th width="15%">Tambahan Poin</th>
                            <th width="15%">Poin Sekarang</th>
                            <th width="15%">Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($hasil as $keys)
                        @php
                        // Mendefinisikan nilai poin
                        $poinTambahan = $keys->nilai <= 0.5 ? 5 : 10;
                        $poinAwal = $keys->poin;
                        // $poinTambahan = $keys->poin_smt;

                        //Menambahkan poin akhir
                        $poinSekarang = $poinAwal + $poinTambahan;

<<<<<<< HEAD
                    // Menentukan level berdasarkan poin sekarang
                    if ($poinSekarang > 100) {
                        $level = 'Gold';
                    } elseif ($poinSekarang > 80) {
                        $level = 'Bronze';
                    } elseif ($poinSekarang > 40) {
                        $level = 'Silver';
                    } elseif ($poinSekarang > 20){
                        $level = 'Platinum';
                    } else {
                        $level = 'No Level';
                    }
                    @endphp
                    <tr align="center">
                        <td align="left">{{ $keys->nama }}</td>
                        <td>{{ $keys->nilai }}</td>
                        <td>{{ $no }}</td>
                        <td>{{ $alt }}</td>
                        <td>{{ $poinSekarang}}</td>
                        <td>{{ $level }}</td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
=======
                            // Menentukan level berdasarkan poin sekarang
                            if ($poinSekarang > 100) {
                                $level = 'Gold';
                            } elseif ($poinSekarang > 80) {
                                $level = 'Bronze';
                            } elseif ($poinSekarang > 40) {
                                $level = 'Silver';
                            } elseif ($poinSekarang > 20){
                                $level = 'Platinum';
                            } else {
                                $level = 'No Level';
                            }
                        @endphp
                        <tr align="center">
                            <td align="left">{{ $keys->nama }}</td>
                            <td>{{ $keys->nilai }}</td>
                            <td>{{ $no }}</td>
                            <td>{{ $poinAwal }}</td>
                            <td>{{ $poinTambahan }}</td>
                            <td>{{ $poinSekarang }}</td>
                            <td>{{ $level }}</td>
                        </tr>
                        <input type="hidden" name="hasil[{{ $keys->id_hasil }}][id_hasil]" value="{{ $keys->id_hasil }}">
                        <input type="hidden" name="hasil[{{ $keys->id_hasil }}][id_alternatif]" value="{{ $keys->id_alternatif }}">
                        <input type="hidden" name="hasil[{{ $keys->id_hasil }}][nilai]" value="{{ $keys->nilai }}">
                        <input type="hidden" name="hasil[{{ $keys->id_hasil }}][tambahan_poin]" value="{{ $poinTambahan }}">
                        <input type="hidden" name="hasil[{{ $keys->id_hasil }}][poin_smt]" value="{{ $poinSekarang }}">
                        <input type="hidden" name="hasil[{{ $keys->id_hasil }}][level]" value="{{ $level }}">
                        @php
                            $no++;
                        @endphp
                        {{-- @php
                        AlternatifModel::update([
                            'id_alternatif' => $id_alternatif,
                            'poin' => $poinSekarang,
                            // 'tambahan_poin' => 0,
                        ]);
                        @endphp --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <button type="submit" class="btn btn-success mt-3">Simpan Hasil</button> --}}
        </form>
>>>>>>> 849c16bbee7c31193c9c93a334e598c95a9ad1d1
    </div>
</div>

@include('layouts.footer_admin')
