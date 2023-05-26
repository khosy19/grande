<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $makanan = Items::wheretipe(1)->whereaktif(1)->get();
        $minuman = Items::wheretipe(2)->whereaktif(1)->get();
        $snack = Items::wheretipe(3)->get();
        // dd($makanan);
        $hour = date('H');
        if ($hour >= 20) {
            $greetings = "Good Night";
        } elseif ($hour > 17) {
            $greetings = "Good Evening";
        } elseif ($hour > 11) {
            $greetings = "Good Afternoon";
        } elseif ($hour < 12) {
            $greetings = "Good Morning";
        }

        return view('guest.dashboard', [
            'makanan' => $makanan,
            'minuman' => $minuman,
            'snack'   => $snack,
            'sapaan' => $greetings,
        ]);

        // return view('guest.payment_success');
    }
}
