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
                                @foreach($detail as $val)
                                <tr>
                                    <td>- &nbsp;</td>
                                    <td>&nbsp;{{ $val->nama_makanan }}</td>
                                    <td>&nbsp;x&nbsp;{{ $val->jumlah }}</td>
                                    {{-- <td>&nbsp;x&nbsp;{{ $val->name }}</td> --}}
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <a href="{{ route('transaksi_kasir') }}" class="btn btn-danger btn-round">
        <i class="material-icons">arrow_back</i> Back
    </a>
    @endsection
