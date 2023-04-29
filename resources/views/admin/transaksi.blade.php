@extends('layouts.app')

@section('title', 'Transaction List')

@section('content')
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
            <h4 class="card-title">List
            </h4>
            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar              -->
                {{-- filter kategori --}}
                <form action="{{ route('transaksi') }}" class="action" method="GET">
                <div class="form-group">
                    <label for="category">Status Pesanan</label>
                    <select name="category" class="form-control" required>
                        <option value="all">All</option>
                        <option value="waiting" {{ Request::get('status') == 'waiting' ? 'selected' : '' }}>Waiting</option>
                        <option value="success" {{ Request::get('status') == 'finish' ? 'selected' : '' }}>Finish</option>
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
                                    @if($data->status == 1)
                                        <button class="btn btn-success btn-round" disabled>Finish</button>
                                    @else
                                        <button class="btn btn-danger btn-round">Waiting</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($data->metode == 1)
                                    <button class="btn btn-info btn-round" disabled>Credit Card</button>
                                    @elseif ($data->metode == 2)
                                    <button class="btn btn-success btn-round" disabled>Cash</button>
                                    @else
                                        <button class="btn btn-warning btn-round" disabled>Include Bill</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('transaksi_detail', $data->id_transaksi) }}"
                                        class="edit">
                                        <i class="material-icons" style="font-size: 40px; color: rgb(86, 190, 86);">receipt_long</i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if ($data->status == 0)
                                        <form action="{{ route('transaksi_update', $data->id_transaksi) }}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="finish" value="1">
                                            <button type="submit" class="btn btn-rose btn-round">Finish</button>
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
@push('script')
    <script>
        $('.remove').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure ?',
                text: 'Deleted data cannot be recovered!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Clear data!',
                cancelButtonText: 'No, Leave data',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: false
            }).then(function (value) {
                swal({
                    title: 'Deleted data!',
                    text: 'Data deleted successfully!.',
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
                        title: 'Canceled',
                        text: 'Data is not deleted :)',
                        type: 'error',
                        confirmButtonClass: "btn btn-info",
                        buttonsStyling: false
                    })
                }
            })
        });
    </script>
@endpush
@endsection
