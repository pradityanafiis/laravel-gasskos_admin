@extends('layouts.app')
@section('title', 'GassKos - Detail Penginapan')
@section('title_2', 'Detail Penginapan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Penginapan</a></li>
    <li class="breadcrumb-item active">Detail enginapan</li>
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

            @if ($message = Session::get('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    
    <table id="table_penginapan" class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Penginapan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @if($penginapan != null) 
                @foreach($penginapan as $data)
                <tr>
                    <td>{{ $data->nama }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/penginapan/{{ $data->id_penginapan }}"><i class="far fa-eye"></i></a>
                        <a class="btn btn-danger btn-sm" href="/penginapan/hapus/{{ $data->id_penginapan }}"><i class="far fa-trash-alt"></i></a>
                        <a class="btn btn-success btn-sm" href="/penginapan/ubah/{{ $data->id_penginapan }}"><i class="far fa-edit"></i></a>
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
            $('#table_penginapan').DataTable({
                responsive: true
            });
        });
    </script>
@endsection