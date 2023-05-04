@extends('layouts.app')

@section('title', 'Edit Station')

@section('content')
@if(count($errors) > 0)
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    {{ $error }} <br/>
    @endforeach
</div>
@endif
<div class="col-md-12">
    <div class="card">
        <form id="RegisterValidation" action="{{ route('station_update', $data->id_station) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="card-header card-header-icon" data-background-color="blue">
                <i class="material-icons">restaurant</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Forms</h4>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Station Name
                        <small>*</small>
                    </label>
                    <input class="form-control" name="name" type="text" required="true" value="{{$data->nama_station}}" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Description
                        <small>*</small>
                    </label>
                    <input class="form-control" name="desc" type="text" required="true" value="{{$data->ket_station}}" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Amount (This Day)
                        <small>*</small>
                    </label>
                    <input class="form-control" name="amount" type="number" required="true" value="{{$data->jml_pekerja}}"/>
                </div>
                <div class="form-footer">
                    <a href="{{ route('station') }}" class="btn btn-danger btn-fill pull-left">
                        <i class="material-icons">arrow_back</i> Back
                    </a>
                    <button type="submit" class="btn btn-blue btn-fill pull-right">Edit Station</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
