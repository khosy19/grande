@extends('layouts.app')

@section('title', 'Transaction List')

@section('content')
@include('sweetalert::alert')

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has($msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="purple">
            <i class="material-icons">assignment</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">List Transaksi
            </h4>
            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar              -->
                {{-- filter kategori --}}
                <form action="{{ route('transaksi_kasir') }}" class="action" method="GET">
                <div class="form-group">
                    {{-- <a href="{{ route('add_transaksi') }}" class="btn btn-rose pull-right"><i class="material-icons">post_add</i> Add Transaction</a> --}}
                    <label for="status">Status Pesanan</label>
                    <select name="status" class="form-control" required>
                        {{-- <option value="all">All</option> --}}
                        <option value="unpayment">Belum Bayar</option>
                        <option value="waiting" {{ Request::get('status') == 'waiting' ? 'selected' : '' }}>Waiting</option>
                        <option value="success" {{ Request::get('status') == 'success' ? 'selected' : '' }}>Finish</option>
                        {{-- <option value="waiting">Waiting</option>
                        <option value="finish">Finish</option> --}}
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                    width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th class="disabled-sorting">Description</th>
                            <th class="disabled-sorting text-center">Tables</th>
                            <th class="disabled-sorting">Total</th>
                            <th class="disabled-sorting text-center">Status</th>
                            <th class="disabled-sorting text-center">Method</th>
                            <th class="disabled-sorting text-center">Details</th>
                            <th class="disabled-sorting text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                            <tr>
                                <td>{{ $data->invoice }}</td>
                                <td>{{ $data->name }}</td>
                                <td class="text-center"><button class="btn btn-primary btn-round"><i class="material-icons">meeting_room</i>{{ $data->room }}</button></td>
                                <td>Rp {{number_format($data->total,2,',','.')}}</td>
                                <td class="text-center">
                                    @if($data->status == 2)
                                        <button class="btn btn-primary btn-round" >Unpayment</button>
                                    @elseif($data->status == 1)
                                        <button class="btn btn-success btn-round" disabled>Finish</button>
                                    @elseif($data->status == 0)
                                        <button class="btn btn-danger btn-round">Waiting</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($data->metode == 1)
                                    {{-- <form action="route('')"></form> --}}
                                    <button class="btn btn-info btn-round">Credit Card</button>
                                    @elseif ($data->metode == 2)
                                    <button class="btn btn-success btn-round" disabled>Cash</button>
                                    @else
                                        <button class="btn btn-warning btn-round" disabled>Include Bill</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('transaksi_detail_kasir', $data->id_transaksi) }}"
                                        class="edit">
                                        <i class="material-icons" style="font-size: 40px; color: rgb(86, 190, 86);">receipt_long</i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if ($data->status == 2)
                                        <form action="{{ route('transaksi_update_kasir', $data->id_transaksi) }}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="finish" value="0">
                                            <button type="submit" class="btn btn-rose btn-round remove">Bayar</button>
                                        </form>
                                    @elseif ($data->status == 0)
                                        <form action="{{ route('transaksi_update_kasir', $data->id_transaksi) }}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="finish" value="1">
                                            <button type="submit" class="btn btn-rose btn-round remove" disabled>Proses</button>
                                        </form>
                                    @else
                                    <i class="material-icons" style="font-size: 40px; color: rgb(182, 21, 21);">remove</i>
                                    @endif
                                    
                                    <p>
                                        <a href="{{ route('cetak_struk') }}" class="btn btn-rose btn-round" target="_blank" >CETAK</a>
                                    </p>
                                </td>
                                {{-- <td class="text-center">
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end content-->
    </div>
    <!--  end card  -->
</div>
@push('script')
    <script>
        $('.remove').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Konfirmasi Pesanan',
                text: 'Apakah anda yakin mengubah status transaksi?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: false
            }).then(function (value) {
                swal({
                    title: 'Status Pesanan Diubah!',
                    text: 'Perubahan Status Pelanggan Berhasil!, Pesanan akan segera diproses oleh pihak produksi.',
                    type: 'success',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                })
                setTimeout(function() {
                if (value) {
                    window.location.href = url;}
                }, 2000);

            }, function (dismiss) {
                // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                if (dismiss === 'cancel') {
                    swal({
                        title: 'Dicancel',
                        text: 'Status Pesanan Belum diganti',
                        type: 'error',
                        confirmButtonClass: "btn btn-info",
                        buttonsStyling: false
                    })
                }
            })
        });

        // npm sweet cc
    //     $('.cc-input').on('click', function (event) {
    //     Swal.fire({
    //     title: 'Masukkan Kode Referensi Kartu Kredit',
    //     input: 'text',
    //     inputAttributes: {
    //         autocapitalize: 'off'
    //     },
    //     showCancelButton: true,
    //     confirmButtonText: 'Look up',
    //     showLoaderOnConfirm: true,
    //     preConfirm: (login) => {
    //         return fetch(`//api.github.com/users/${login}`)
    //         .then(response => {
    //             if (!response.ok) {
    //             throw new Error(response.statusText)
    //             }
    //             return response.json()
    //         })
    //         .catch(error => {
    //             Swal.showValidationMessage(
    //             `Request failed: ${error}`
    //             )
    //         })
    //     },
    //     allowOutsideClick: () => !Swal.isLoading()
    //     }).then((result) => {
    //     if (result.isConfirmed) {
    //         Swal.fire({
    //         title: `${result.value.login}'s avatar`,
    //         imageUrl: result.value.avatar_url
    //         })
    //     }
    //     })
    // });


    //     $('.cc-ref').on('click', function (event) {
    //     Swal.fire({
    //     title: 'Masukkan Kode Referensi Kartu Kredit',
    //     html:
    //         '<input id="swal-input1" class="swal2-input" placeholder="***">' +
    //         '<input id="swal-input2" class="swal2-input" placeholder="Input 2">',
    //     focusConfirm: false,
    //     preConfirm: () => {
    //         return [
    //         document.getElementById('swal-input1').value,
    //         document.getElementById('swal-input2').value
    //         ]
    //     }
    //     }).then((result) => {
    //     if (result.isConfirmed) {
    //         const [input1] = result.value;
    //         const [input1, input2] = result.value;
    //         Lakukan sesuatu dengan nilai input1 dan input2
    //     }
    //     })
    // });

    </script>
@endpush
@endsection
