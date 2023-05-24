@extends('layouts.app')

@section('title', 'Transaction List')

@section('content')
@if (session('success_message'))
<div class="alert alert-success">
    {{ session('success_message') }}
</div>
@endif
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="purple">
            <i class="material-icons">assignment</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">List Transaksi
            </h4>
            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar              -->
                {{-- filter kategori --}}
                <form action="{{ route('transaksi_kasir') }}" class="action" method="GET">
                <div class="form-group">
                    {{-- <a href="{{ route('add_transaksi') }}" class="btn btn-rose pull-right"><i class="material-icons">post_add</i> Add Transaction</a> --}}
                    <label for="status">Status Pesanan</label>
                    <select name="status" class="form-control" required>
                        {{-- <option value="all">All</option> --}}
                        <option value="unpayment">Belum Bayar</option>
                        <option value="waiting" {{ Request::get('status') == 'waiting' ? 'selected' : '' }}>Waiting</option>
                        <option value="success" {{ Request::get('status') == 'success' ? 'selected' : '' }}>Finish</option>
                        {{-- <option value="waiting">Waiting</option>
                        <option value="finish">Finish</option> --}}
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                    width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th class="disabled-sorting">Description</th>
                            <th class="disabled-sorting text-center">Tables</th>
                            <th class="disabled-sorting">Total</th>
                            <th class="disabled-sorting text-center">Status</th>
                            <th class="disabled-sorting text-center">Method</th>
                            <th class="disabled-sorting text-center">Details</th>
                            <th class="disabled-sorting text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                            <tr>
                                <td>{{ $data->invoice }}</td>
                                <td>{{ $data->name }}</td>
                                <td class="text-center"><button class="btn btn-primary btn-round"><i class="material-icons">meeting_room</i>{{ $data->room }}</button></td>
                                <td>Rp {{number_format($data->total,2,',','.')}}</td>
                                <td class="text-center">
                                    @if($data->status == 2)
                                        <button class="btn btn-primary btn-round" >Unpayment</button>
                                    @elseif($data->status == 1)
                                        <button class="btn btn-success btn-round" disabled>Finish</button>
                                    @elseif($data->status == 0)
                                        <button class="btn btn-danger btn-round">Waiting</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($data->metode == 1)
                                    {{-- <form action="route('')"></form> --}}
                                    <button class="btn btn-info btn-round">Credit Card</button>
                                    @elseif ($data->metode == 2)
                                    <button class="btn btn-success btn-round" disabled>Cash</button>
                                    @else
                                        <button class="btn btn-warning btn-round" disabled>Include Bill</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('transaksi_detail_kasir', $data->id_transaksi) }}"
                                        class="edit">
                                        <i class="material-icons" style="font-size: 40px; color: rgb(86, 190, 86);">receipt_long</i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if ($data->status == 2)
                                        <form action="{{ route('transaksi_update_kasir', $data->id_transaksi) }}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="finish" value="0">
                                            <button type="submit" class="btn btn-rose btn-round remove">Bayar</button>
                                        </form>
                                    @elseif ($data->status == 0)
                                        <form action="{{ route('transaksi_update_kasir', $data->id_transaksi) }}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="finish" value="1">
                                            <button type="submit" class="btn btn-rose btn-round remove" disabled>Proses</button>
                                        </form>
                                    @else
                                    <i class="material-icons" style="font-size: 40px; color: rgb(182, 21, 21);">remove</i>
                                    @endif
                                    
                                    <p>
                                        <a href="{{ route('cetak_struk') }}" class="btn btn-rose btn-round" target="_blank" >CETAK</a>
                                    </p>
                                </td>
                                {{-- <td class="text-center">
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end content-->
    </div>
    <!--  end card  -->
</div>
@include('sweetalert::alert')
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection
