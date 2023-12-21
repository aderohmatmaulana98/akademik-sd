<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'nilai'; //nama tabel pada database
    protected $primaryKey = 'id_nilai';

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'siswa_id',
        'tugas',
        'uts',
        'uas',
        'nilai_akhir',
    ];
}
