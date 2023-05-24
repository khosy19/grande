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
                                    <th class="disabled-sorting">Waktu Pesan</th>
                                    <th class="disabled-sorting">Menu</th>
                                    <th class="disabled-sorting">Jumlah</th>
                                    {{-- <th class="disabled-sorting">Waktu</th> --}}
                                    {{-- <th class="disabled-sorting">Waktu Tiba</th>
                                    <th class="disabled-sorting">Start Time</th>
                                    <th class="disabled-sorting">Burst Time</th> --}}
                                    <th class="disabled-sorting">Selesai</th>
                                </tr>
                            </thead>                  
                            @foreach ($antrian_detail as $detail)
                            <tr>
                            
                                    <td>&nbsp;{{ $detail->created_at }}</td>
                                    <td>&nbsp;{{ $detail->nama_makanan }}</td>
                                    <td>&nbsp;x&nbsp;{{ $detail->jumlah }}</td>
                                    <td>&nbsp;{{ ($detail->finish_time) }}</td>
                            </tr>
                            @endforeach
                                    {{-- <td>&nbsp;{{ $detail->waktu_menu }}&nbsp;Menit</td>                                                        --}}
                                    {{-- <td>&nbsp;{{ $tb[0].':'.$tb[1].':'.$tb[2] }}</td>  
                                    <td>&nbsp;{{ $st[1] }}</td>                                                        --}}
                                    {{-- burst_time--}}
                                    {{-- <td>&nbsp;{{ ($detail->jumlah*$detail->waktu_menu) }}&nbsp;Menit</td> --}}
                                    {{-- finish_time--}}
                                    {{-- <td>&nbsp;{{ ($detail->waktu_tiba[1]) + ($detail->burst_time[1]) }}&nbsp;Menit</td> --}}
                                    {{-- <td>&nbsp;{{ ($bt[1]+$tb[1]) }}&nbsp;Menit</td> --}}
                                {{--                                 

                                    catatan
                                    waktu_tiba = 0
                                    start_time = 0 (explode)
                                    burst_time = waktu_menu*jumlah

                                    start_time2 = start_time + burst_time 
                                    finish_time = burst_time + start_time2
                                    turn_around_time = finish_time - waktu_tiba

                                --}}
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
