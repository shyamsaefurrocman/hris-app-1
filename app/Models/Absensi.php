<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'tb_absensi';
    protected $fillable = [
        'id_user',
        'tgl_absen',
        'time_start',
        'time_end',
        'keterangan',
        'created_at',
        'updated_at',
    ];

}
