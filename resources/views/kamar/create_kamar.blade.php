@extends('layouts.app')
@section('title', 'GassKos - Tambah Kamar')
@section('title_2', 'Tambah Kamar')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Kamar</a></li>
    <li class="breadcrumb-item active">Tambah Kamar</li>
@endsection

@section('main_content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(!$penginapan->isEmpty())
                <div class="card">
                    <form method="POST" action="{{ route('kamar.store') }}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Penginapan</label>
                            <select name="penginapan" class="form-control" required autofocus>
                                @foreach($penginapan as $data)
                                    <option value="{{ $data['id_penginapan'] }}">{{ $data['nama'] }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('penginapan'))
                                <div class="text-danger">{{ $errors->first('penginapan') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tipe Kamar</label>
                            <input type="text" class="form-control" name="tipe" value="{{ old('tipe') }}" required autofocus>

                            @if($errors->has('tipe'))
                                <div class="text-danger">{{ $errors->first('tipe') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Harga Kamar</label>
                            <input type="number" class="form-control" name="harga" value="{{ old('harga') }}" min="1" required>
                            <small class="form-text text-muted">Harga kamar dalam satuan per hari</small>

                            @if($errors->has('harga'))
                                <div class="text-danger">{{ $errors->first('harga') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Kapasitas Kamar</label>
                            <input type="number" class="form-control" name="kapasitas" value="{{ old('kapasitas') }}" min="1" required>
                            <small class="form-text text-muted">Kapasitas (orang) yang diperbolehkan</small>

                            @if($errors->has('kapasitas'))
                                <div class="text-danger">{{ $errors->first('kapasitas')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Jumlah Kamar</label>
                            <input type="number" class="form-control" name="jumlah" value="{{ old('jumlah') }}" min="1" required>
                            <small class="form-text text-muted">Jumlah kamar yang tersedia</small>

                            @if($errors->has('jumlah'))
                                <div class="text-danger">{{ $errors->first('jumlah')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            @else
                <div class="card bg-danger">
                    <div class="card-header"><strong>Informasi</strong></div>
                    <div class="card-body">
                        <p class="card-text">Anda belum memiliki penginapan. Silakan tambahkan penginapan terlebih dahulu!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection