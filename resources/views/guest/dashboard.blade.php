@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
@endforeach
<div class="row">
    <div class="col-md-12">
        <h4 class="title text-center">{{ $sapaan." Pelanggan " }}</h4>
        {{-- <h4 class="title text-center">{{ $sapaan." ".Auth::user()->name }}</h4> --}}
        <br />
        <div class="nav-center">
            <ul class="nav nav-pills nav-pills-success nav-pills-icons" role="tablist">
                <!--
                    color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                -->
                <li class="active">
                    <a href="#foods" role="tab" data-toggle="tab">
                        <i class="material-icons">restaurant_menu</i> Foods
                    </a>
                </li>
                <li>
                    <a href="#drinks" role="tab" data-toggle="tab">
                        <i class="material-icons">local_cafe</i> Drinks
                    </a>
                </li>
                {{-- <li>
                    <a href="#snacks" role="tab" data-toggle="tab">
                        <i class="material-icons">tapas</i> Snacks
                    </a>
                </li> --}}
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="foods">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Foods</h4>
                        <p class="category">
                            More information here
                        </p>
                    </div>
                    <div class="card-content">
                        @foreach($makanan as $item)
                            <div class="col-md-4">
                                <div class="card card-product">
                                    <div class="card-image">
                                        <a href="#pablo">
                                            <img class="img" src="{{url('assets/img').'/'.$item->foto}}">
                                        </a>
                                    </div>
                                    <div class="card-content">
                                        <h4 class="card-title">
                                            <a href="#pablo">{{ $item->nama_makanan }}</a>
                                        </h4>
                                        <div class="card-description">
                                            {{ substr($item->deskripsi, 0, 200).'...' }}
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <center>
                                            <div>
                                                <a href="{{ route('details_items', $item->id_items) }}"
                                                    class="btn btn-rose btn-round">
                                                    <i class="material-icons">favorite</i> Details
                                                </a>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="drinks">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Drinks</h4>
                        <p class="category">
                            More information here
                        </p>
                    </div>
                    <div class="card-content">
                        @foreach($minuman as $item)
                            <div class="col-md-4">
                                <div class="card card-product">
                                    <div class="card-image">
                                        <a href="#pablo">
                                            <img class="img" src="{{url('assets/img').'/'.$item->foto}}">
                                        </a>
                                    </div>
                                    <div class="card-content">
                                        <h4 class="card-title">
                                            <a href="#pablo">{{ $item->nama_makanan }}</a>
                                        </h4>
                                        <div class="card-description">
                                            {{ substr($item->deskripsi, 0, 200).'...' }}
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <center>
                                            <div>
                                                <a href="{{ route('details_items', $item->id_items) }}"
                                                    class="btn btn-rose btn-round">
                                                    <i class="material-icons">favorite</i> Details
                                                </a>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
