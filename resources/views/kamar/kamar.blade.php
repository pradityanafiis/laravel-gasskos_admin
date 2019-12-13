@extends('layouts.app')
@section('title', 'GassKos - Kamar')
@section('title_2', 'Kamar')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Kamar</li>
@endsection

@section('main_content')
    <div class="row justify-content-center">
        <div class="col-6">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    
    <table id="table_kamar" class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Penginapan</th>
                <th>Tipe Kamar</th>
                <th>Harga Kamar</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @if($kamar != null) 
                @foreach($kamar as $data)
                <tr>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->tipe }}</td>
                    <td>Rp{{ number_format($data->harga, 0, ',', '.') }}</td>
                    <td>{{ $data->kapasitas }}</td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="/kamar/hapus/{{ $data->id_kamar }}"><i class="far fa-trash-alt"></i></a>
                        <a class="btn btn-success btn-sm" href="/kamar/ubah/{{ $data->id_kamar }}"><i class="far fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>

    </table>
@endsection

@section('javascript')
    <script>
        $(document).ready( function () {
            $('#table_kamar').DataTable({
                responsive: true
            });
        });
    </script>
@endsection