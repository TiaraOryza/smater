<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SimpanHasil extends Model
{
    use HasFactory;

    protected $table = 'simpan_hasil';
    protected $primaryKey = 'id_simpan';

    protected $fillable = [
        'id_hasil',
        'tanggal',
        'id_alternatif',
        'nilai',
        'tambahan_poin',
        'poin_smt',
        'level',
    ];

    public $timestamps = false;

    public static function get_nilai($tanggal)
    {
        return DB::table('simpan_hasil')
            ->join('alternatif', 'simpan_hasil.id_alternatif', '=', 'alternatif.id_alternatif')
            ->orderBy('nilai', 'DESC')
            ->where('tanggal', $tanggal)
            ->get();
    }
}
