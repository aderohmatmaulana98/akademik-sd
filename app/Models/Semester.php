<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'semester'; //nama tabel pada database
    protected $primaryKey = 'id_semester';

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'smt',
        'tahun_ajaran_id',
    ];

    public function tahun_ajaran()
    {
        return $this->belongsTo(Tahun_ajaran::class, 'tahun_ajaran_id', 'id_tahun_ajaran');
    }

}
