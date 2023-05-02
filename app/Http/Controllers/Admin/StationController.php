<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index(Request $request){
        // $station = $request->input('jml_pekerja');
        // if ($station == 'Makanan') {
        //     $data = Station::join('users','id_users', '=', 'station.id_users')
        //             ->where('id_station',1);
        // }else{}
    }
}
