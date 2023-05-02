@extends('layouts.app')

@section('title', 'Detail')

@push('css')
    <style>
        .quantity {
            position: relative;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .quantity input {
            width: 85px;
            height: 52px;
            line-height: 1.65;
            float: left;
            display: block;
            padding: 0;
            margin: 0;
            padding-left: 20px;
            border: 1px solid #eee;
        }

        .quantity input:focus {
            outline: 0;
        }

        .quantity-nav {
            float: left;
            position: relative;
            height: 52px;
        }

        .quantity-button {
            position: relative;
            cursor: pointer;
            border-left: 1px solid #eee;
            width: 30px;
            text-align: center;
            color: #333;
            font-size: 20px;
            font-family: "Trebuchet MS", Helvetica, sans-serif !important;
            line-height: 1.5;
            -webkit-transform: translateX(-100%);
            transform: translateX(-100%);
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }

        .quantity-button.quantity-up {
            position: absolute;
            height: 50%;
            top: 0;
            border-bottom: 1px solid #eee;
        }

        .quantity-button.quantity-down {
            position: absolute;
            bottom: 5px;
            height: 50%;
        }

    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="blue">
                @if($items->tipe == 1)
                    <i class="material-icons">restaurant_menu</i>
                @elseif($items->tipe == 2)
                    <i class="material-icons">local_cafe</i>
                @else
                    <i class="material-icons">tapas</i>
                @endif
            </div>
            <div class="card-content">
                <h3 class="card-title" style="font-weight: bold">{{ $items->nama_makanan }}</h3>
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <img class="img img-rounded" src="{{url('assets/img').'/'.$items->foto}}">
                        </center>
                        <hr>
                        <h4 class="pull-right"> Rp
                            {{ number_format($items->harga,2,',','.') }}
                        </h4>
                        <h4 style="font-weight: bold"> Description</h4>
                        <p align="justify">
                            <br>
                            {{ $items->deskripsi }}
                        </p>
                        <p align="justify">
                            <br>
                            Estimate Time : {{ $items->waktu_menu }} (Minutes)
                        </p>
                        <br>
                        <form class="form" method="POST" action="{{ route('tambah_cart', $items->id_items) }}">
                        @csrf
                        <div class="quantity">
                            <input name="qty" type="number" min="1" max="9" step="1" value="1">
                        </div>
                        <button type="submit" class="btn btn-success pull-right">
                            Add To My Order
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-danger btn-round">
            <i class="material-icons">arrow_back</i> Back
        </a>
    </div>
</div>
@endsection

@push('script')
    <script>
        jQuery(
                '<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>')
            .insertAfter('.quantity input');
        jQuery('.quantity').each(function () {
            var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

            btnUp.click(function () {
                var oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

            btnDown.click(function () {
                var oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

        });

    </script>
@endpush
