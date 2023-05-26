<?php

namespace App\Http\Controllers\Admin;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    public function index(Request $request){
        // return $request->all();
        // $data = Items::all();
        $filter = $request->input('tipe');
        // $aktif = $request->input('aktif');
        if($filter == 'food') {
            $data = DB::table('items')->where('tipe', 1)->get();
        } elseif ($filter == 'drink') {
            $data = DB::table('items')->where('tipe', 2)->get();
        } else {
            $data = Items::all();
        }
        // $items = Items::when($tipe, function($query, $tipe) {
        //     return $query->where('tipe', $tipe);
        // })->get();
        // $data = Items::where('tipe', '=', 1)->get();

        return view('admin.food_list',[
            'data' => $data,
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'   => 'required|max:255',
            'desc'   => 'required|max:255',
            'price'  => 'required|numeric',
            'type'    => 'required|max:1',
            'display' => 'required|mimes:jpg,jpeg,bmp,png',
            'estimate'=> 'required|numeric',
            'aktif'   => 'required|max:1',
        ]);

        $file = $request->file('display');
        $nama_file = $file->hashName();
        $folder = 'assets/img';
        $file->move($folder,$nama_file);
       
        Items::create([
            'nama_makanan' => $request->name,
            'deskripsi'    => $request->desc,
            'harga'        => $request->price,
            'tipe'         => $request->type,
            'foto'         => $nama_file,
            'waktu_menu'   => $request->estimate,
            'aktif'        => $request->aktif,
        ]);
        
        $request->session()->flash('info', 'Items Add Successfully');
        return redirect('/admin/management/food');

    }

    public function edit($id){
        $items = Items::find($id);
        return view('admin.food_edit', [
            'data' => $items,
        ]);
    }

    public function update($id, Request $request){

         
        if ($request->file('display') != null) {

            $this->validate($request, [
                'name'   => 'required|max:255',
                'desc'   => 'required|max:255',
                'price'  => 'required|numeric',
                'type'    => 'required|max:1',
                'aktif'    => 'required|max:1',
                'display' => 'required|mimes:jpg,jpeg,bmp,png',
                'estimate'=> 'required|numeric',

            ]);

            $file = $request->file('display');
            $nama_file = $file->hashName();
            $folder = 'assets/img';
            $file->move($folder,$nama_file);

            $data               = Items::find($id);
            $data->nama_makanan = $request->name;
            $data->deskripsi    = $request->desc;
            $data->harga        = $request->price;
            $data->foto         = $nama_file;
            $data->tipe         = $request->type;
            $data->aktif         = $request->aktif;
            $data->waktu_menu   = $request->estimate;
            $data->save();

            $request->session()->flash('info', 'Items Edit Successfully');
            return redirect('/admin/management/food');
    
        }else {
            $this->validate($request, [
                'name'         => 'required|max:255',
                'desc'         => 'required|max:255',
                'estimate'     => 'required|numeric',
                'price'        => 'required|numeric',
                'type'         => 'required|max:1',
                'aktif'         => 'required|max:1',
            ]);

            $data               = Items::find($id);
            $data->nama_makanan = $request->name;
            $data->deskripsi    = $request->desc;
            $data->harga    = $request->price;
            $data->tipe     = $request->type;
            $data->aktif     = $request->aktif;
            $data->waktu_menu   = $request->estimate;
            $data->save();

            $request->session()->flash('info', 'Items Edit Successfully');
            return redirect('/admin/management/food');
    
        }
    }

    public function delete($id){
        $items = Items::find($id);
        $items->delete();

        return redirect('/admin/management/food')->with([
            'success' => 'Item Delete Successfully'
        ]);
    }
}
