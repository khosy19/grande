@extends('layouts.app')

@section('title', 'Add Account')

@section('content')
<div class="col-md-12">
    <div class="card">
        <form id="RegisterValidation" action="{{ route('store_users') }}" method="POST">
            @csrf
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
                    <input class="form-control" name="name" type="text" required="true" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Email
                        <small>*</small>
                    </label>
                    <input class="form-control" name="email" type="email" required="true" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Password
                        <small>*</small>
                    </label>
                    <input class="form-control" name="password" id="registerPassword" type="password" required="true" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Confirm Password
                        <small>*</small>
                    </label>
                    <input class="form-control" name="password_confirmation" id="password_confirmation" type="password"
                        required="true" equalTo="#registerPassword" />
                </div>
                <div class="dropdown">
                    <label for="control-label">Level</label>
                    <select id="level" name="level">
                        <option value="kasir">Kasir</option>
                        <option value="produksi">Produksi</option>
                        <option value="admin">Admin</option>
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
