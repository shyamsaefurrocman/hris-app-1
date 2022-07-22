<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAbsen extends Model
{
    use HasFactory;
    protected $table = 'tb_user_absen';
    protected $fillable = [
        'id_absensi',
        'id_user',
        'keterangan',
        'created_at',
        'updated_at',
    ];
}
