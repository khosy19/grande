@extends('layouts.app')

@section('title', 'Table Edit')

@section('content')
@if(count($errors) > 0)
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    {{ $error }} <br/>
    @endforeach
</div>
@endif
<?php $pass = Str::random(4) ?>
<div class="col-md-12">
    <div class="card">
        <form id="RegisterValidation" action="{{route('update_rooms', $data->id)}}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <div class="card-header card-header-icon" data-background-color="blue">
                <i class="material-icons">account_circle</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Forms</h4>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Description
                        <small>*</small>
                    </label>
                    <input class="form-control" name="name" type="text" value="{{ $data->name }}" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Number Table
                        <small>*</small>
                    </label>
                    <input class="form-control" type="email" value="{{ $data->room }}" disabled />
                    <input type="hidden" name="email" value="{{ $data->room }}">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Password
                        <small>*</small>
                    </label>
                    <input class="form-control" name="password" id="registerPassword" type="text" value="{{$pass}}"/>
                    {{-- <input type="hidden" name="password" value="{{$pass}}"> --}}
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Levels
                        <small>*</small>
                    </label>
                    <select class="selectpicker" data-style="select-with-transition" name="status">
                        <option {{ $data->active == 1 ? 'selected' : '' }} value="1" > ACTIVE</option>
                        <option {{ $data->active == 0 ? 'selected' : '' }} value="0" > NOT ACTIVE</option>
                    </select>
                </div>
                <div class="form-group">
                    <small>*</small> Required fields</div>
                <div class="form-footer">
                    <a href="{{ route('room') }}" class="btn btn-danger btn-fill pull-left">
                        <i class="material-icons">arrow_back</i> Back
                    </a>
                    <button type="submit" class="btn btn-blue btn-fill pull-right">Update Room</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
