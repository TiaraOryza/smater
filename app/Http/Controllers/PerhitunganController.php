<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerhitunganModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Exports\PerhitunganExport;
use Maatwebsite\Excel\Facades\Excel;

class PerhitunganController extends Controller
{
    public function index()
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect('Dashboard')->with('error', 'Anda tidak berhak mengakses halaman ini!');
        }

        $data['page'] = "Perhitungan";
        $data['alternatifs'] = AlternatifModel::all();
        $data['kriterias'] = KriteriaModel::all();
        $data['subkriterias'] = SubKriteriaModel::all();

        // Validasi apakah data yang diperlukan ada
        if ($data['alternatifs']->isEmpty() || $data['kriterias']->isEmpty()) {
            return redirect()->route('perhitungan.index')->with('error', 'Data yang diperlukan tidak ditemukan. Pastikan data Alternatif dan Kriteria telah diisi dengan benar.');
        }

        return view('perhitungan.index', $data);
    }

    public function export()
    {
        return Excel::download(new PerhitunganExport, 'perhitungan.xlsx');
    }
}
