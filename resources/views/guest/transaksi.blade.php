@extends('layouts.app')

@section('title', 'Transaction Details')

@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
@endforeach
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                @if(empty($cart) || count($cart)==0)
                    Sorry, no orders have been placed yet :(
                @else
                    <div class="card-header card-header-icon" data-background-color="green">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">List Orders</h4>
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>Items</th>
                                <th>Price</th>
                                <th>Qty</th>
                                {{-- <th>Waktu Pesan</th> --}}
                                <th>Action</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                $grandtotal = 0;
                                // $waktu_pesan = 0;
                                ?>
                                @foreach($cart as $item =>$val)
                                    <?php 
                                $subtotal = $val['harga_items'] * $val['jumlah'];
                                $grandtotal+=$subtotal;
                                ?>
                                    <tr>
                                        <td>{{ $val['nama_items'] }}</td>
                                        <td>{{ number_format($val['harga_items'],2,',','.') }}
                                        </td>
                                        <td>{{ $val['jumlah'] }}</td>
                                        {{-- <td>{{ $val['waktu_pesan'] }}</td> --}}
                                        <td>
                                            <a href="{{ route('hapus_cart', $val['id_items']) }}"
                                                class="material-icons">highlight_off</a>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <h4 class="card-title pull-right" style="font-weight: 400;">Total Payment :
                            {{ number_format($grandtotal,2,',','.') }}
                        </h4>
                    </div>
                    </table>
                @endif
            </div>
        </div>
        @if(empty($cart) || count($cart)==0)
            <a href="{{ route('dashboard') }}" class="btn btn-danger btn-round">
                <i class="material-icons">arrow_back</i> Back
            </a>
        @else
            <div class="card">
                <div class="card-content">
                    <div class="card-header card-header-icon" data-background-color="green">
                        <i class="material-icons">receipt</i>
                    </div>
                    <h4>Payment Method</h4>
                    <form action="{{ route('pembayaran') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-10 checkbox-radios">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="method" value="1">
                                        <i class="material-icons">credit_card</i> Credit Card
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="method" value="2">
                                        <i class="material-icons">payments</i> Cash
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="method" value="3">
                                        <i class="material-icons">payments</i> Include Bill
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="total" value="{{$grandtotal}}">
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-danger btn-round">
                <i class="material-icons">arrow_back</i> Back
            </a>
            <button type="submit" class="btn btn-primary btn-round pull-right">
                <i class="material-icons">price_check</i> Payment
            </button>
            </form>
        @endif
    </div>
</div>
<br>
<br>
<br>
<br>
@endsection
