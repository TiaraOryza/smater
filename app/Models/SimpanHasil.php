<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'poin_smt',
        'level',
    ];

    public $timestamps = false;
}
