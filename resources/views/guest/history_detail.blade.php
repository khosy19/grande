@extends('layouts.app')

@section('title', 'History')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Transaction Details</h4>
        </div>
        <div class="card-content">
            <div class="col-md-8">
                <div class="card card-product">
                    <div class="card-content">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="2 " width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    {{-- width="50%" style="width:50%" --}}
                                    <th class="disabled-sorting">Waktu Pesan</th>
                                    <th class="disabled-sorting">Nama Menu</th>
                                    <th class="disabled-sorting">Jumlah</th>
                                    <th class="disabled-sorting">Waktu Menu</th>
                                    <th class="disabled-sorting">Waktu Selesai</th>
                                    {{-- <th class="disabled-sorting">Waktu Tunggu</th>
                                    <th class="disabled-sorting">Waktu Selesai</th> --}}
                                </tr>
                            </thead>
                            {{-- <thead>
                                <th>Nama Makanan</th>
                                <th>Jumlah</th>
                            </thead> --}}                            
                                @foreach($detail as $val)
                                <tr>
                                        <td>&nbsp;{{ $val->waktu_pesan }}</td>
                                        <td>&nbsp;{{ $val->nama_makanan }}</td>
                                        <td>&nbsp;x&nbsp;{{ $val->jumlah }}</td>
                                        <td>&nbsp;{{ $val->waktu_menu }}&nbsp;Menit</td>
                                        {{-- @php
                                            $wt = $this->hitungWaktuTunggu();
                                            foreach ($pelangganPesan as $key => $value) {
                                                echo "Pelanggan harus menunggu selama".$wt[$key]." menit";
                                            }
                                        @endphp --}}
                                        <td>&nbsp;{{ ($val->jumlah*$val->waktu_menu) }}&nbsp;Menit</td>
                                    {{-- </p> --}}
                                </tr>
                                @endforeach
                                {{--                                 
                                @foreach ($waktu as $valwaktu)
                                <td>&nbsp;{{ $valwaktu->waktu_pesan }}</td>
                                <td>&nbsp;{{ $valwaktu->waktu_tunggu }}</td>
                                <td>&nbsp;{{ $valwaktu->waktu_selesai }}</td>
                                @endforeach --}}
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <a href="{{ route('history') }}" class="btn btn-danger btn-round">
        <i class="material-icons">arrow_back</i> Back
    </a>
    @endsection
