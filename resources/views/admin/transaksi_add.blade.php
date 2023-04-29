@extends('layouts.app')

@section('title', 'Add Transaction')

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
        <form id="RegisterValidation" action="{{ route('store_transaksi') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header card-header-icon" data-background-color="blue">
                <i class="material-icons">restaurant</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Forms</h4>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Item Name
                        <small>*</small>
                    </label>
                    <input class="form-control" name="name" type="text" required="true" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Description
                        <small>*</small>
                    </label>
                    <input class="form-control" name="desc" type="text" required="true" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Price
                        <small>*</small>
                    </label>
                    <input class="form-control" name="price" type="number" required="true" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Type
                        <small>*</small>
                    </label>
                    <select class="selectpicker" data-style="select-with-transition" name="type">
                        <option value="1"> FOOD</option>
                        <option value="2"> DRINK</option>
                    </select>
                </div>
                <h5>Upload Display</h5>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                        <img src="{{url('assets/img/image_placeholder.jpg')}}" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="display" required />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i
                                class="fa fa-times"></i> Remove</a>
                    </div>
                </div>
                <div class="form-group">
                    <small>*</small> Required fields</div>
                <div class="form-footer">
                    <a href="{{ route('transaksi') }}" class="btn btn-danger btn-fill pull-left">
                        <i class="material-icons">arrow_back</i> Back
                    </a>
                    <button type="submit" class="btn btn-blue btn-fill pull-right">Add Transaksi</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
