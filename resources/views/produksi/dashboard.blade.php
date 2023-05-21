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
                <p class="category">Total Income</p>
                <h5 class="card-title">Rp {{number_format($total,2,',','.')}}</h5>
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
                <p class="category">Tables</p>
                <h3 class="card-title">{{$room}}</h3>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="blue">
                <i class="material-icons">receipt_long</i>
            </div>
            <div class="card-content">
                <p class="category">Orders</p>
                <h3 class="card-title">{{$trans}}</h3>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
