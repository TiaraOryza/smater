<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpanHasil extends Model
{
    use HasFactory;

    protected $table = 'simpan_hasil';

    // Menonaktifkan timestamps
    public $timestamps = false;

    protected $fillable = [
        'id_hasil',
        'id_alternatif',
        'tanggal',
        'nilai',
        'poin_smt',
        'level',
    ];
}
