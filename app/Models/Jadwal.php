<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'jadwal'; //nama tabel pada database
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'hari',
        'jam',
        'kelas_id',
        'mapel_id',
        'semester_id',
    ];
}
