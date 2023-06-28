@extends('layouts.app')

@section('title', 'Data Meja')

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
            <h4 class="card-title">Data Meja
                {{-- <a href="{{ route('cetakStruk') }}" class="btn btn-rose pull-right"><i class="material-icons">print</i> PRINT QR</a> --}}
                <a href="{{ route('add_room') }}" class="btn btn-rose pull-right"><i class="material-icons">person_add</i> ADD TABLE</a>
            </h4>
            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                    width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Table</th>
                            <th>QR Table</th>
                            <th>Cetak QR</th>
                            <th class="disabled-sorting text-center">Status</th>
                            <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td><button class="btn btn-primary btn-round"><i class="material-icons">meeting_room</i>{{ $data->room }}</button></td>
                                {{-- <td>{!! QrCode::size(60)->generate($data->link) !!}</td> --}}
                                {{-- <td>{!! QrCode::size(60)->generate(Request::url('http://127.0.0.1:8000/guest/dashboard')) !!}</td> --}}
                                <td>{!! QrCode::size(60)->generate(Request::url('https://6c2129e63586-12817177712444975226.ngrok-free.app')) !!}</td>
                                <td><a href="{{ route('cetakqr', $data->id) }}" class="btn btn-danger" target="_blank">Cetak QR</a></td>
                                <td class="text-center">
                                    @if($data->active == 1)
                                        <button class="btn btn-info btn-round">Active</button>
                                    @else
                                        <button class="btn btn-danger btn-round">Not Active</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('edit_room', $data->id) }}"
                                        class="btn btn-simple btn-warning btn-icon edit"><i
                                            class="material-icons">dvr</i></a>
                                    <a href="{{ route('delete_room', $data->id) }}"
                                        class="btn delete-confirm btn-simple btn-danger btn-icon remove"><i
                                            class="material-icons">close</i></a>
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
