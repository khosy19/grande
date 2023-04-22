<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $trans = Transaksi::all()->count();
        $room = User::wherelevel('guest')->get()->count();
        $pendapatan = Transaksi::sum('total');

        return view('admin.dashboard',[
            'trans' => $trans,
            'room'  => $room,
            'total' => $pendapatan,
        ]);
    }
}
