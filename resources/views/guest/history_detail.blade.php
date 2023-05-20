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
                                    <th class="disabled-sorting">Nama Menu</th>
                                    <th class="disabled-sorting">Jumlah</th>
                                    <th class="disabled-sorting">Waktu Menu</th>
                                    <th class="disabled-sorting">Waktu Tiba</th>
                                    <th class="disabled-sorting">Start Time</th>
                                    <th class="disabled-sorting">Burst Time</th>
                                    <th class="disabled-sorting">Finish Time</th>
                                </tr>
                            </thead>                     
                                <tr>
                                        <td>&nbsp;{{ nama_makanan }}</td>
                                        <td>&nbsp;x&nbsp;{{jumlah }}</td>
                                        <td>&nbsp;{{ waktu_menu }}</td>                                                       
                                        <td>&nbsp;{{ waktu_tiba }}</td>  
                                        <td>&nbsp;{{ start_time }}</td>                                                       
                                        {{-- burst_time--}}
                                        <td>&nbsp;{{ (jumlah*waktu_menu) }}&nbsp;Menit</td>
                                        {{-- finish_time--}}
                                        <td>&nbsp;{{ (burst_time+start_time) }}&nbsp;Menit</td>
                                </tr>
                                {{--                                 

                                    catatan
                                    waktu_tiba = 0
                                    start_time = 0
                                    burst_time = waktu_menu*jumlah
                                    finish_time = burst_time + start_time
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
