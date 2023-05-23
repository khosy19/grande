@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <center>
            <i class="material-icons" style="font-size: 120px; color: rgb(86, 190, 86);">
                credit_score
            </i>
            <h5 class="card-title" >
                {{$text}}
            </h5>
            <a href="{{ route('dashboard') }}" class="btn btn-danger btn-round" style="padding: 18px 120px;">
                <i class="material-icons">arrow_back</i> Back
            </a>
        </center>
        <hr>
    </div>
</div>
@endsection
