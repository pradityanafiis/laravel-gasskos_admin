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
        @if(!$kamar->isEmpty())
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
                                    <th style="width: 30%">Nama Penginapan</th>
                                    <th style="width: 20%">Tipe</th>
                                    <th style="width: 10%">Harga</th>
                                    <th style="width: 10%">Kapasitas</th>
                                    <th style="width: 10%">Jumlah</th>
                                    <th style="width: 20%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($kamar as $data)
                                <tr>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->tipe }}</td>
                                    <td>Rp{{ number_format($data->harga, 0, ',', '.') }}</td>
                                    <td>{{ $data->kapasitas }} Orang</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Kamar akan dihapus')" class="d-inline" action="{{ route('kamar.destroy', [$data->id_kamar]) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" value="Delete" class="btn btn-tool" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                        <a class="btn btn-tool" href="{{ route('kamar.edit', [$data->id_kamar]) }}"><i class="far fa-edit"></i></a>
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
                    <p class="card-text">Anda belum memiliki kamar. Silakan tambahkan kamar terlebih dahulu!</p>
                </div>
            </div>
        </div>
        @endif
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