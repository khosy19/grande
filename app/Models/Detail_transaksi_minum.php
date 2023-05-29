<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_transaksi_minum extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi_minum';
    protected $primaryKey = 'id_detail_transaksi_minuman';

    protected $fillable = [
        'id_transaksi_minuman',
        'id_items_minuman',
        'jumlah_minuman',

    ];
}
