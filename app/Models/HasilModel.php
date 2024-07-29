<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HasilModel extends Model
{
    protected $table = 'hasil';
    protected $primaryKey = 'id_hasil';
    protected $fillable = ['id_alternatif', 'nilai', 'tambahan_poin','poin_smt'];
    public $timestamps = false;

    

    // public static function get_poin()
    // {
    //     return DB::table('hasil')
    //         ->join('alternatif', 'hasil.id_alternatif', '=', 'alternatif.id_alternatif')
    //         ->orderBy('poin', 'DESC')
    //         ->get();
    // }
}
