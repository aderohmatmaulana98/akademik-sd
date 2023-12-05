<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'siswa'; //nama tabel pada database
    protected $primaryKey = 'id_siswa';

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'user_id',
        'kelas_id',
        'nisn',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat',
        'no_hp',
        'tahun_masuk',
        'status_aktif',
    ];
    public function users()  {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
    public function kelas()  {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
        
    }
}
