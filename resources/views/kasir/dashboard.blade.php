@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="blue">
                <i class="material-icons">request_quote</i>
            </div>
            <div class="card-content">
                <p class="category">Transaksi Belum Bayar</p>
                <h3 class="card-title"> <br>
                    <center>
                        {{$status3}}
                    </center>
                </h3>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="blue">
                <i class="material-icons">request_quote</i>
            </div>
            <div class="card-content">
                <p class="category">Antrian Belum Eksekusi</p>
                <h3 class="card-title"> <br>
                    <center>
                        {{$status}}
                    </center>
                </h3>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="orange">
                <i class="material-icons">weekend</i>
            </div>
            <div class="card-content">
                <p class="category">Antrian Sudah Selesai</p>
                <h3 class="card-title"> <br>
                    <center>
                        {{$status2}}
                    </center>
                </h3>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
