<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'mapel'; //nama tabel pada database
    protected $primaryKey = 'id_mapel';

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'kode_mapel',
        'nama_mapel',
    ];
}
