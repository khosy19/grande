@extends('layouts.app')

@section('title', 'History')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Transaction History</h4>
        </div>
        <div class="card-content">
            @foreach($transaksi as $val)
                <div class="col-md-4">
                    <div class="card card-product">
                        <div class="card-content">
                            <table>
                                <p>====={{ $val->created_at }}=====
                                </p>

                                <tr>
                                    <td>Invoice&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;{{ $val->invoice }}</td>
                                </tr>
                                <tr>
                                    <td>Description&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;{{ $val->name }}</td>
                                </tr>
                                <tr>
                                    <td>Table Number&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;{{ $val->room }}</td>
                                </tr>
                                <tr>
                                    <td>Total&nbsp;</td>
                                    <td>:</td>
                                    <td>&nbsp;Rp {{ number_format($val->total,2,',','.')}}</td>
                                </tr>
                            </table>
                            <br>
                        </div>
                        <div class="card-footer pull-right">
                            @if ($val->status == 1)
                                <button class="btn btn-xs btn-round btn-success" disabled>FINISH</button>
                            @else
                                <button class="btn btn-xs btn-round btn-danger" disabled>PROCESS</button>
                            @endif
                            <a href="{{route('history_detail', $val->id_transaksi)}}" class="btn btn-rose btn-round btn-fab btn-fab-mini">
                                <i class="material-icons">info</i>
                            </a>
                            {{-- <a href="" class="btn btn-warning btn-round btn-fab btn-fab-mini">
                                <i class="material-icons">star</i>
                            </a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <a href="{{ route('dashboard') }}" class="btn btn-danger btn-round">
        <i class="material-icons">arrow_back</i> Back
    </a>
    @endsection
