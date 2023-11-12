<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun_ajaran extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'tahun_ajaran'; //nama tabel pada database
    protected $primaryKey = 'id_tahun_ajaran';

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'th_ajaran',
    ];
}
