@extends('layouts.app')
@section('title', 'GassKos - Detail Penginapan')
@section('title_2', 'Detail Penginapan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Penginapan</a></li>
    <li class="breadcrumb-item active">Detail Penginapan</li>
@endsection

@section('main_content')

    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                <p class="card-title">Detail Penginapan</p>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:25%">Gender</th>
                                <td>{{ $penginapan->gender }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $penginapan->nama }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $penginapan->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td>{{ $penginapan->telepon }}</td>
                            </tr>
                            <tr>
                                <th>Fasilitas</th>
                                <td>
                                    <ul>
                                        @foreach($fasilitas as $data)
                                            <li>{{ $data->nama}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
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
@endsection