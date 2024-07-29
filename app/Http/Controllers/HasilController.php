<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerhitunganModel;
use App\Models\HasilModel;
use App\Models\SimpanHasil;

class HasilController extends Controller
{
    public function index()
    {
        $data['page'] = "Hasil";
        $data['hasil'] = PerhitunganModel::get_hasil();
        return view('hasil.index', $data);
    }

    public function Laporan()
    {
        $data['hasil'] = PerhitunganModel::get_hasil();
        return view('hasil.laporan', $data);
    }

    // untuk hitung poin
    public function generate(Request $request)
    {
        // sementara pakai all dulu
        $nilai = HasilModel::all();

        foreach ($nilai as $x) {
            $poinTambahan = $x->nilai <= 0.5 ? 5 : 10;
            $x->poin_smt += $poinTambahan;

            $x->save();
        }
        return redirect()->route('Hasil');
    }

    // method untuk menyimpan hasil
    public function simpan(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'tanggal' => 'required|date',
        ]);

        // Ambil data hasil dari request
        $hasilData = $request->input('hasil');

        // Looping dan simpan data ke database
        foreach ($hasilData as $data) {
            SimpanHasil::create([
                'id_hasil' => 1, // Sesuaikan dengan id hasil yang relevan jika ada
                'id_alternatif' => 1, // Sesuaikan dengan id alternatif yang relevan jika ada
                'tanggal' => $request->input('tanggal'),
                'nilai' => $data['nilai'],
                'poin_smt' => $data['poin_sekarang'], // Sesuaikan dengan poin_smt atau poin_sekarang
                'level' => $data['level'],
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
}
