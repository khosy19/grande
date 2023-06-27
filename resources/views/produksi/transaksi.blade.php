@extends('layouts.app')

@section('title', 'Transaction List')

@section('content')
{{-- @include('sweetalert::alert') --}}

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
            <h4 class="card-title">Antrian Pesanan
            </h4>
            <div class="toolbar">
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
                                    <a href="{{ route('transaksi_detail_produksi', $data->id_transaksi) }}"
                                        class="edit">
                                        <i class="material-icons" style="font-size: 40px; color: rgb(86, 190, 86);">receipt_long</i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if ($data->status == 0)
                                        <form action="{{ route('transaksi_update_produksi', $data->id_transaksi) }}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="finish" value="1">
                                            <button type="submit" class="btn btn-rose btn-round remove" onclick="notifProduksi()">Finish</button>
                                        </form>
                                    @else
                                    <i class="material-icons" style="font-size: 40px; color: rgb(182, 21, 21);">remove</i>
                                    @endif
                                </td>
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
<script>
    function notifProduksi() {
        var formcbckuser = event.target.form;
        // event.preventDefault(); // prevent form submit
        // var formcbckuser = event.target.form; // storing the form
        // console.log(formcbckuser);
        swal({
                title: "Apakah Anda Ingin Mengubah Status Transaksi?",
                text: "Ubah Status Transaksi",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    console.log(formcbckuser);
                    formcbckuser.submit();
                    swal("Success",
                        "Your data already updated :)",
                        "success");
                } else {
                    swal("Cancelled",
                        "You cancelled :)",
                        "error");
                }
            });
}
</script>
{{-- @push('script')
    <script>
        $('.remove').on('click', function (event) {
            event.preventDefault();
            const url = 'http://127.0.0.1:8000/produksi/transaksi';
            // console.log(url);
            swal({
                title: 'Konfirmasi Pesanan',
                text: 'Apakah anda yakin menu sudah siap diantar?',
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
                    text: 'Segera antarkan pesanan pelanggan sesuai nomor meja!.',
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

    </script>
@endpush --}}
@endsection
