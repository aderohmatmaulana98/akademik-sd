<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'role'; //nama tabel pada database
    protected $primaryKey = 'id_user';

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'role',
    ];
}
