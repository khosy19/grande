<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'antrian';
    protected $primaryKey = 'id_antrian';

    protected $fillable = [
        'id_transaksi',
        'id_users',
        'jumlah_antrian',
        'waktu_masuk',
        'waktu_keluar',
    ];
}
