<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
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

    // public function generate(Request $request)
    // {
    //     $nilai = HasilModel::all();
    //     $poin_awal = AlternatifModel::all();

    //     foreach ($nilai as $x) {
    //         $x->tambahan_poin = $x->nilai <= 0.5 ? 5 : 10;
    //         $x->poin_smt = $poin_awal->poin + $x->tambahan_poin ;

    //         $id_hasil = $x->id_hasil;

    //         $data = [
    //             'poin_smt' => $x->poin_smt,
    //         ];

    //         $hsl = HasilModel::findOrFail($id_hasil);
    //         $hsl->update($data);
    //     }
    //     return redirect()->route('Hasil');
    // }

    // UPDATE POIN
    public function generate(Request $request)
    {
        // $hasilData = SimpanHasil::all();

        // foreach ($hasilData as $data) {
        //     AlternatifModel::all()
        //         ->where('id_alternatif', $data->id_alternatif)
        //         ->update(['poin' => $data->poin_smt]);
        // }

        // return redirect()->route('log-hasil');

        $hasilData = SimpanHasil::all();

        foreach ($hasilData as $data) {
            $alternatif = AlternatifModel::where('id_alternatif', $data->id_alternatif)->first();
            if ($alternatif) {
                $alternatif->update(['poin' => $data->poin_smt]);
            }
        }

        return redirect()->route('log-hasil');
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
                'tambahan_poin' => $data['tambahan_poin'],
                'poin_smt' => $data['poin_smt'], // Sesuaikan dengan poin_smt atau poin_sekarang
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
