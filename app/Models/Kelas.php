<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'kelas'; //nama tabel pada database
    protected $primaryKey = 'id_kelas';

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'nama_kelas',
    ];

}
