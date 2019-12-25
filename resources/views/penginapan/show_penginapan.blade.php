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

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <div class="btn-group">
                <a class="btn btn-primary" href="{{ route('penginapan.edit', [$penginapan->id_penginapan]) }}">Ubah Penginapan</a>
                <button type="submit" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('destroy-form').submit();">Hapus Penginapan</button>
                <form id="destroy-form" class="d-inline" action="{{ route('penginapan.destroy', [$penginapan->id_penginapan]) }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                </form>
                <a class="btn btn-primary" href="{{ route('kamar.create') }}">Tambah Kamar</a>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Detail Penginapan</p>
                </div>

                <div class="card-body">
                        <table class="table table-borderless table-responsive">
                            <tr>
                                <th style="width:25%">Gender</th>
                                <th style="width:5%">:</th>
                                <td>{{ $penginapan->gender }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <th>:</th>
                                <td>{{ $penginapan->nama }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <th>:</th>
                                <td>{{ $penginapan->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <th>:</th>
                                <td>{{ $penginapan->telepon }}</td>
                            </tr>
                            <tr>
                                <th>Fasilitas</th>
                                <th>:</th>
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

        <div class="col-md-6">
            <!--
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Foto Penginapan</p>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <div id="carouselFotoPenginapan" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                                $urutanSlide = 0;
                                $urutanFoto = 0;
                            ?>
                            @foreach($foto as $data)
                                <li data-target="#carouselFotoPenginapan" data-slide-to="{{ $urutanSlide }}" class="{{ ($urutanSlide == '0') ? 'active' : '' }}"></li>
                                <?php $urutanSlide++ ?>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($foto as $fotopenginapan)
                                <div class="carousel-item {{ ($urutanFoto == '0') ? 'active' : '' }}">
                                    <img class="d-block w-100" src="{{ asset('foto_penginapan/'.$fotopenginapan->path.'') }}">
                                </div>
                                <?php $urutanFoto++ ?>
                            @endforeach()
                        </div>
                        <a class="carousel-control-prev" href="#carouselFotoPenginapan" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselFotoPenginapan" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>            
            </div>
            -->

            <div class="card">
                <div class="card-header">
                    <p class="card-title">Foto Penginapan</p>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width:10%">#</th>
                            <th style="width:80%">Nama File</th>
                            <th>View</th>
                        </tr>
                        @foreach($foto as $fotopenginapan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $fotopenginapan->path }}</td>
                                <td><a class="btn btn-tool" href="{{ asset('foto_penginapan/'.$fotopenginapan->path.'') }}" target="__blank" data-toggle="tooltip" title="Delete"><i class="far fa-eye"></i></a></td>
                            </tr>
                            
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(!$kamar->isEmpty())
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">Daftar Kamar</p>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th style="width:10%">#</th>
                                <th style="width:30%">Tipe</th>
                                <th>Harga</th>
                                <th>Kapasitas</th>
                                <th>Jumlah</th>
                            </tr>
                            @foreach($kamar as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->tipe }}</td>
                                    <td>Rp{{ number_format($data->harga, 0, ',', '.') }}</td>
                                    <td>{{ $data->kapasitas }} Orang</td>
                                    <td>{{ $data->jumlah }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>    
        </div>
    @endif
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