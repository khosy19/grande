@extends('layouts.app')

@section('title', 'Transaction List')

@section('content')
{{-- @include('sweetalert::alert') --}}

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has($msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="purple">
            <i class="material-icons">assignment</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">FCFS Antrian
            </h4>
            <div class="toolbar">
                {{-- Filter fcfs --}}
                <form action="{{ route('fcfs') }}" class="action" method="GET">
                    <div class="form-group">
                        {{-- <a href="{{ route('add_transaksi') }}" class="btn btn-rose pull-right"><i class="material-icons">post_add</i> Add Transaction</a> --}}
                        <label for="tipe">Pilih Station</label>
                        <select name="tipe" class="form-control" required>
                            <option value="makanan" {{ Request::get('tipe') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="minuman" {{ Request::get('tipe') == 'minuman' ? 'selected' : '' }}>Minuman</option>
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
                            <th class="text-center">Invoice</th>
                            <th class="text-center">Waktu Tiba</th>
                            <th class="text-center">Start Time</th>
                            <th class="text-center">Burst Time</th>
                            <th class="text-center">Finish Time</th>
                            <th class="text-center">Waiting Time</th>
                            {{-- <th class="text-center">TAT</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tipe as $fcfs)
                            <tr>
                                <td class="text-center">{{ $fcfs->invoice }}</td>
                                <td class="text-center">{{ $fcfs->waktu_tiba }}</td>
                                <td class="text-center">{{ $fcfs->start_time }}</td>
                                <td class="text-center">{{ $fcfs->burst_time }}</td>
                                <td class="text-center">{{ $fcfs->finish_time }}</td>
                                <td class="text-center">{{ $fcfs->waiting_time }}</td>
                                {{-- <td class="text-center">{{ $fcfs->tat }}</td> --}}
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

@endsection
