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
        $data['page'] = "Laporan";
        $data['hasil'] = PerhitunganModel::get_hasil();
        return view('hasil.laporan', $data);
    }

    public function generate(Request $request)
    {
        $nilai = HasilModel::all();

        foreach ($nilai as $x) {
            $poinTambahan = $x->nilai <= 0.5 ? 5 : 10;
            $x->poin += $poinTambahan;
            $x->save();
        }
        return redirect()->route('Hasil');
    }

    public function simpan(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $hasilData = $request->input('hasil');

        foreach ($hasilData as $data) {
            SimpanHasil::create([
                'id_hasil' => $data['id_hasil'],
                'tanggal' => $tanggal,
                'id_alternatif' => $data['id_alternatif'],
                'nilai' => $data['nilai'],
                'poin_smt' => $data['tambahan_poin'],
                'level' => $data['level'],
            ]);
        }

        return redirect()->route('log-hasil');
    }


    public function logHasil()
    {
        $data['page'] = "Log Hasil";
        $data['logHasil'] = SimpanHasil::select('tanggal')->distinct()->get();
        return view('hasil.log-hasil', $data);
    }

    public function hapusLogHasil($tanggal)
    {
        SimpanHasil::where('tanggal', $tanggal)->delete();
        return redirect()->route('log-hasil')->with('success', 'Data berhasil dihapus');
    }

    public function lihatHasil($tanggal)
    {
        $data['page'] = "Lihat Hasil";
        $data['hasil'] = SimpanHasil::where('tanggal', $tanggal)->get();
        return view('hasil.lihat-hasil', $data);
    }
}
