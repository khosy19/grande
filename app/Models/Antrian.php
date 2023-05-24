<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'antrian';
    protected $primaryKey = 'id_antrian';

    protected $fillable = [
        'id_detail_transaksi',
        'id_station',
        'id_users',
        'waktu_tiba',
        'start_time',
        'burst_time',
        'finish_time',
        'waiting_time',
        'tat',
        // 'tat',
    ];
}
