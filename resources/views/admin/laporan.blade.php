@extends('layouts.app')

@section('title', 'Transaction List')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="material-icons">assignment</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">Laporan Grande Garden Cafe
            </h4>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                    width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th class="disabled-sorting">Laporan</th>
                            <th class="disabled-sorting">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                1. Laporan Penjualan
                            </td>
                            <td>
                                <a href="{{ route('laporan_penjualan') }}" class="btn btn-rose" target="_blank">Cetak Laporan</a>
                            {{-- <button type="submit" class="btn btn-rose">Cetak Laporan</button>       --}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                2. Laporan Menu Paling Banyak Terjual
                            </td>
                            <td>
                                <a href="{{ route('menu_favorit') }}" class="btn btn-rose" target="_blank">Cetak Laporan</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                3. Laporan FCFS
                            </td>
                            <td>
                                <a href="{{ route('laporan_fcfs') }}" class="btn btn-rose" target="_blank">Cetak Laporan</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
