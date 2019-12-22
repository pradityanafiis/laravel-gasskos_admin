@extends('layouts.app')
@section('title', 'GassKos - Kamar')
@section('title_2', 'Kamar')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Kamar</li>
@endsection

@section('main_content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Daftar Kamar</p>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="card-body">
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
                                        <a class="btn btn-tool" href="/kamar/hapus/{{ $data->id_kamar }}"><i class="far fa-trash-alt"></i></a>
                                        <a class="btn btn-tool" href="/kamar/ubah/{{ $data->id_kamar }}"><i class="far fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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