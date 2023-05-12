@extends('layouts.app')

@section('title', 'History')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Transaction Details</h4>
        </div>
        <div class="card-content">
            <div class="col-md-4">
                <div class="card card-product">
                    <div class="card-content">
                        <table>
                            {{-- <thead>
                                <th>Nama Makanan</th>
                                <th>Jumlah</th>
                            </thead> --}}
                                @foreach($detail as $val)
                                <tr>
                                    <br>
                                    <p> Waktu Pesan :
                                        <td>&nbsp;{{ $val->waktu_pesan }}</td>
                                        <td>&nbsp;{{ $val->nama_makanan }}</td>
                                        <td>&nbsp;x&nbsp;{{ $val->jumlah }}</td>
                                    </p>
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
