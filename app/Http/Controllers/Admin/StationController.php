<?php

namespace App\Http\Controllers\Admin;

use App\Models\Station;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index(Request $request){
        // $data=$request->input('station');
        $data = Station::all();
        // echo $station;
        // die();
        return view('admin.station_list',[
            'data' => $data,
        ]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'name'   => 'required|max:255',
            'desc'   => 'required|max:255',
            'amount'  => 'required|numeric',
        ]);
    }
    public function edit($id){
        $station = Station::find($id);
        return view('admin.station_edit', [
            'data' => $station,
        ]);
    }
    public function update($id, Request $request){

        $this->validate($request, [
            'name'         => 'required|max:255',
            'desc'         => 'required|max:255',
            'amount'       => 'required|numeric',
        ]);

        $data               = Station::find($id);
        $data->nama_station = $request->name;
        $data->ket_station    = $request->desc;
        $data->jml_pekerja    = $request->amount;
        $data->save();

        $request->session()->flash('info', 'Station Data Edit Successfully');
        return redirect('/admin/management/station');
    
        
    }

}
