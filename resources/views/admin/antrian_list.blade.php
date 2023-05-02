@extends('layouts.app')

@section('title', 'Transaction List')

@section('content')

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has($msg))
<p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif

<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="material-icons">assignment</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">Antrian
            </h4>
            <div class="toolbar">
                <form action="#" class="action" method="GET">
                    <div class="form-group">
                        <label for="antrian">Urutkan Pesanan</label>
                        <select name="antrian" class="form-control">Terbaru</select>
                        <select name="antrian" class="form-control">Terlama</select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                    width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th class="disabled-sorting">Table</th>
                            <th class="disabled-sorting">Waktu Masuk</th>
                            <th class="disabled-sorting text-center">Waktu Keluar</th>
                            <th class="disabled-sorting text-center">Details</th>
                            <th class="disabled-sorting text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                            <tr>
                                <td class="text-center"><button class="btn btn-primary btn-round"><i class="material-icons">meeting_room</i>{{ $data->room }}</button></td>
                                <td>{{ $data->waktu_masuk }}</td>
                                <td>{{ $data->waktu_keluar }}</td>
                                <td class="text-center">
                                    <a href="{{ route('antrian', $data->id_transaksi) }}"
                                        class="edit">
                                        <i class="material-icons" style="font-size: 40px; color: rgb(86, 190, 86);">receipt_long</i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if ($data->waktu_masuk)
                                        <form action="{{ route('antrian_update', $data->id_antrian) }}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="finish" value="0">
                                            <button type="submit" class="btn btn-rose btn-round remove">Antri</button>
                                        </form>
                                    @elseif ($data->waktu_keluar)
                                        <form action="{{ route('antrian_update', $data->id_antrian) }}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="finish" value="1">
                                            <button type="submit" class="btn btn-rose btn-round remove">Finish</button>
                                        </form>
                                    @else
                                    <i class="material-icons" style="font-size: 40px; color: rgb(182, 21, 21);">remove</i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
