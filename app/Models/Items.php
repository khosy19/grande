<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $primaryKey = 'id_items';

    protected $fillable = [
        'nama_makanan',
        'deskripsi',
        'harga',
        'foto',
        'tipe',
        'waktu_menu',
    ];

    
}
