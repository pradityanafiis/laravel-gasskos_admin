@extends('layouts.app')
@section('title', 'GassKos - Penginapan')
@section('title_2', 'Penginapan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Penginapan</li>
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

    <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>

        <div class="card-body">
            <table id="table_penginapan" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Gender</th>
                        <th>Nama Penginapan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @if($penginapan != null) 
                        @foreach($penginapan as $data)
                        <tr>
                            <td>{{ $data->gender }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/penginapan/{{ $data->id_penginapan }}"><i class="far fa-eye"></i></a>
                                <form onsubmit="return confirm('Hapus penginapan beserta seluruh kamarnya?')" class="d-inline" action="{{route('penginapan.destroy', [$data->id_penginapan])}}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" value="Delete" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                </form>
                                <a class="btn btn-success btn-sm" href="{{route('penginapan.edit', [$data->id_penginapan])}}"><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready( function () {
            $('#table_penginapan').DataTable({
                responsive: true
            });
        });
    </script>
<!--
    <script>
        $(document).ready(function(){
            $('#table_penginapan').DataTable({
                "ajax": {
                "type"   : "GET",
                "url"    : 'http://localhost/penginapan-api/api/penginapan',
                "data"   : {
                        "iduser" : "1"
                    },
                "dataSrc": "data"
                },
                'columns': [
                {"title" : "Nama", "data" : "nama"},
                {"title" : "Alamat", "data" : "alamat"},
                {"title" : "Nomor Telepon", "data" : "telepon"}
                ]
            });
        });
    </script>
-->
@endsection