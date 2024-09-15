<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlternatifModel;
use App\Exports\AlternatifExport;
use App\Imports\AlternatifImport;
use Maatwebsite\Excel\Facades\Excel;

class AlternatifController extends Controller
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

        $data['page'] = "Alternatif";
        $data['list'] = AlternatifModel::all();
        return view('alternatif.index', $data);
    }

    public function tambah()
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

        $data['page'] = "Alternatif";
        return view('alternatif.tambah', $data);
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
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required'
            // 'poin'  => 'required'
        ]);

        $data = [
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat
            // 'poin' => $request->poin
        ];

        $result = AlternatifModel::create($data);

       if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect('Alternatif');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect('Alternatif/tambah');
        }
    }

    public function edit($id_alternatif)
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

        $data['page'] = "Alternatif";
        $data['alternatif'] = AlternatifModel::findOrFail($id_alternatif);
        return view('alternatif.edit', $data);
    }

    public function update(Request $request, $id_alternatif)
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
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required'
        ]);

        $data = [
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat
        ];

        $alternatif = AlternatifModel::findOrFail($id_alternatif);
        $alternatif->update($data);

        return redirect('Alternatif');
    }

        public function destroy(Request $request, $id_alternatif)
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

        AlternatifModel::findOrFail($id_alternatif)->delete();
        return redirect('Alternatif');
    }

    public function export()
    {
        return Excel::download(new AlternatifExport, 'alternatif.xlsx');
    }

    public function import(Request $request)
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

        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new AlternatifImport, $request->file('file'));

        return back()->with('message', 'Data berhasil diimport');
    }
}
