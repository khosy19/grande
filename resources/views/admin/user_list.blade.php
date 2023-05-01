@extends('layouts.app')

@section('title', 'List Users')

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
            <h4 class="card-title">Data User
                <a href="{{ route('add_user') }}" class="btn btn-rose pull-right"><i class="material-icons">person_add</i> Add Account</a>
            </h4>
            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                    width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="disabled-sorting text-center">Level</th>
                            <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->room }}</td>
                                <td>{{ $data->active === 1 ? "Aktif" : "Tidak Aktif"}}</td>
                                <td class="text-center">
                                    @if($data->level == 'admin')
                                        <button class="btn btn-info btn-round">{{ $data->level }}</button>
                                    @endif
                                    {{-- @if($data->level == 'kasir')
                                        <button class="btn btn-info btn-round">{{ $data->level }}</button>
                                    @endif
                                    @if($data->level == 'produksi')
                                        <button class="btn btn-info btn-round">{{ $data->level }}</button>
                                    @endif --}}
                                    @if($data->level == 'guest')
                                        <button class="btn btn-default btn-round">{{ $data->level }}</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('edit_user', $data->id) }}"
                                        class="btn btn-simple btn-warning btn-icon edit"><i
                                            class="material-icons">dvr</i></a>
                                    <a href="{{ route('delete_user', $data->id) }}"
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
