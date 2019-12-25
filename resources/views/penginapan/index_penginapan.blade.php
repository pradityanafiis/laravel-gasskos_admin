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

    <div class="row justify-content-center">
        @if(!$penginapan->isEmpty())
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">Daftar Penginapan</p>
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
                                    <th style="width:10%">Gender</th>
                                    <th style="width:75x%">Nama Penginapan</th>
                                    <th style="width:15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($penginapan as $data)
                                <tr>
                                    <td>{{ $data->gender }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>
                                        <a class="btn btn-tool" href="{{ route('penginapan.show', [$data->id_penginapan]) }}" data-toggle="tooltip" title="View"><i class="far fa-eye"></i></a>
                                        <form onsubmit="return confirm('Penginapan beserta seluruh kamarnya akan dihapus')" class="d-inline" action="{{ route('penginapan.destroy', [$data->id_penginapan]) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" value="Delete" class="btn btn-tool" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                        <a class="btn btn-tool" href="{{ route('penginapan.edit', [$data->id_penginapan]) }}" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-8">
                <div class="card bg-danger">
                    <div class="card-header"><strong>Informasi</strong></div>
                    <div class="card-body">
                        <p class="card-text">Anda belum memiliki penginapan. Silakan tambahkan penginapan terlebih dahulu!</p>
                    </div>
                </div>
            </div>
        @endif
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
@endsection