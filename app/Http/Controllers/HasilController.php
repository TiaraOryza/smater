<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerhitunganModel;
use App\Models\HasilModel;

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

    //untuk hitung poin
    public function generate(Request $request)
    {
        //sementara pakai all dulu 
        $nilai = HasilModel::all();

        foreach ($nilai as $x) {
            $poinTambahan = $x->nilai <= 0.5 ? 5 : 10;
            $x->poin += $poinTambahan;

            $x->save();
        }
        return redirect()->route('Hasil');
    }
}
