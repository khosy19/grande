@extends('layouts.app')

@section('title', 'Add Table')

@section('content')
<?php $pass = Str::random(4) ?>
<div class="col-md-12">
    <div class="card">
        <form id="RegisterValidation" action="{{ route('store_rooms') }}" method="POST">
            @csrf
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
                    <input class="form-control" name="name" type="text" required="true" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Number Table
                        <small>*</small>
                    </label>
                    <input class="form-control" name="email" type="text" required="true" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Password
                        <small>*</small>
                    </label>
                    <input class="form-control" name="password" id="registerPassword" type="text" required="true"  value="{{$pass}}"/>
                    {{-- <input type="hidden" name="password" value="{{$pass}}"> --}}
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Status
                        <small>*</small>
                    </label>
                    <select class="selectpicker" data-style="select-with-transition" name="status">
                        <option value="1" > ACTIVE</option>
                        <option value="0" > NOT ACTIVE</option>
                    </select>
                </div>
                <div class="form-group">
                    <small>*</small> Required fields</div>
                <div class="form-footer">
                    <a href="{{ route('room') }}" class="btn btn-danger btn-fill pull-left">
                        <i class="material-icons">arrow_back</i> Back
                    </a>
                    <button type="submit" class="btn btn-blue btn-fill pull-right">Add Room</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
