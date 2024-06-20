<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKriteriaModel;
use App\Models\KriteriaModel;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $data['page'] = "Sub Kriteria";
        $data['kriteria'] = KriteriaModel::all();
        $data['subkriteria'] = SubKriteriaModel::all();
        return view('sub_kriteria.index', $data);
    }

    public function generate(Request $request)
    {
        $kriteria = KriteriaModel::all();
        foreach ($kriteria as $key){
            $sub_kriteria = SubKriteriaModel::data_sub_kriteria($key->id_kriteria);
            foreach ($sub_kriteria as $x){
                $total = count($sub_kriteria);
                $b = 0;
                foreach ($sub_kriteria as $y){
                    if($y->prioritas >= $x->prioritas){
                        $b += 1/$y->prioritas;
                    }
                }
                $id_kriteria = $key->id_kriteria;
                $id_sub_kriteria = $x->id_sub_kriteria;
                $nilai = $b/$total;

                $data = [
                    'nilai' => $nilai,
                ];
        
                $skrt = SubKriteriaModel::findOrFail($id_sub_kriteria);
                $skrt->update($data);
            }
        }
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data nilai bobot berhasil digenerate!</div>');
        return redirect()->route('SubKriteria');
    }

    public function simpan(Request $request)
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $this->validate($request, [
            'id_kriteria' => 'required',
            'deskripsi' => 'required',
            'prioritas' => 'required'
        ]);

        $data = [
            'id_kriteria' => $request->id_kriteria,
            'deskripsi' => $request->deskripsi,
            'prioritas' => $request->prioritas
        ];

        $result = SubKriteriaModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect('SubKriteria');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect('SubKriteria');
        }
    }

    public function edit(Request $request, $id_sub_kriteria)
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $this->validate($request, [
            'id_kriteria' => 'required',
            'deskripsi' => 'required',
            'prioritas' => 'required'
        ]);

        $data = [
            'id_kriteria' => $request->id_kriteria,
            'deskripsi' => $request->deskripsi,
            'prioritas' => $request->prioritas
        ];

        $subkriteria = SubKriteriaModel::findOrFail($id_sub_kriteria);
        $subkriteria->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('SubKriteria');
    }

    public function destroy(Request $request, $id_sub_kriteria)
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }
        
        SubKriteriaModel::findOrFail($id_sub_kriteria)->delete();
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('SubKriteria');
    }
}
