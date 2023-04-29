@extends('layouts.app')

@section('title', 'Foods List')

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
                <a href="{{ route('add_food') }}" class="btn btn-rose pull-right"><i class="material-icons">post_add</i> Add Food</a>
            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar              -->
                {{-- filter kategori --}}
                <form action="{{ route('food') }}" class="action" method="GET">
                    <div class="form-group">
                        <label for="tipe">Categories</label>
                        {{-- @if ('tipe')
                            
                        @endif --}}
                        <select name="tipe" class="form-control" required>
                            <option value="food">Foods</option>
                            <option value="drink">Drinks</option>
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
                            <th class="disabled-sorting text-center"></th>
                            <th>Items</th>
                            <th class="disabled-sorting">Descriptions</th>
                            <th class="disabled-sorting">Price</th>
                            <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                            <tr>
                                <td>
                                    <div class="img-container">
                                        <img src="{{url('assets/img').'/'.$data->foto}}">
                                    </div>    
                                </td>
                                <td>
                                    {{$data->nama_makanan}} 
                                    <br>
                                    @if ($data->tipe == 1)
                                        <button class="btn btn-xs btn-round btn-info" disabled>FOOD</button>
                                    @else
                                        <button class="btn btn-xs btn-round btn-info" disabled>DRINK</button>
                                    @endif
                                </td>
                                <td>{{$data->deskripsi}}</td>
                                <td style="width: 15%">Rp {{number_format($data->harga,2,',','.')}}</td>
                                <td class="text-center">
                                    <a href="{{ route('edit_food', $data->id_items) }}"
                                        class="btn btn-simple btn-warning btn-icon edit"><i
                                            class="material-icons">dvr</i></a>
                                    <a href="{{ route('delete_food', $data->id_items) }}"
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
