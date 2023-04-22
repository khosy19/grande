@extends('layouts.app')

@section('title', 'Edit Users')

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
        <form id="RegisterValidation" action="{{route('update_users', $data->id)}}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <div class="card-header card-header-icon" data-background-color="blue">
                <i class="material-icons">account_circle</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Forms</h4>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Name
                        <small>*</small>
                    </label>
                    <input class="form-control" name="name" type="text" value="{{ $data->name }}" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Email
                        <small>*</small>
                    </label>
                    <input class="form-control" name="email" type="email" value="{{ $data->room }}" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Password
                        <small>*</small>
                    </label>
                    <input class="form-control" name="password" id="registerPassword" type="password" value="{{ $data->password }}"/>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Confirm Password
                        <small>*</small>
                    </label>
                    <input class="form-control" name="password_confirmation" id="password_confirmation" type="password"
                        equalTo="#registerPassword" />
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="selectpicker" data-style="select-with-transition" name="active">
                        <option value="1" {{ $data->active === 1 ? 'selected' : '' }}>ACTIVE</option>
                        <option value="0" {{ $data->active === 0 ? 'selected' : '' }}>NOT ACTIVE</option>
                    </select>
                </div>
                <div class="form-group">
                    <small>*</small> Required fields</div>
                <div class="form-footer">
                    <a href="{{ route('user') }}" class="btn btn-danger btn-fill pull-left">
                        <i class="material-icons">arrow_back</i> Back
                    </a>
                    <button type="submit" class="btn btn-blue btn-fill pull-right">Add Account</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
