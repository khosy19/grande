<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $table = 'station';
    protected $primaryKey = 'id_station';

    protected $fillable = [
        'nama_station',
        'ket_station',
        'jml_pekerja',
    ];
}
