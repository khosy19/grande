<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian_minum extends Model
{
    use HasFactory;

    protected $table = 'antrian_minum';
    protected $primaryKey = 'id_antrian_minum';

    protected $fillable = [
        'id_detail_transaksi_minum',
        'id_station_minum',
        'id_users_minum',
        'waktu_tiba_minum',
        'start_time_minum',
        'burst_time_minum',
        'finish_time_minum',
        'waiting_time_minum',
        'tat_minum',
    ];
}
