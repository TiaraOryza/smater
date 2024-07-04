<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AlternatifModel extends Model
{
    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';
    protected $fillable = ['nama','poin'];
    public $timestamps = false;

    public static function get_poin()
    {
        return DB::table('alternatif')
            ->join('hasil', 'alternatif.id_alternatif', '=', 'hasil.id_alternatif')
            ->orderBy('poin', 'DESC')
            ->get();
    }
}
