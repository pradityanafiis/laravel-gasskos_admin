@extends('layouts.app')
@section('title', 'GassKos - Ubah Kamar')
@section('title_2', 'Ubah Kamar')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Kamar</a></li>
    <li class="breadcrumb-item active">Ubah Kamar</li>
@endsection

@section('main_content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-primary">
            <form method="POST" action="{{ route('kamar.update', [$kamar->id_kamar]) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="card-body">
                <div class="form-group">
                    <label>Penginapan</label>
                    <select name="penginapan" class="form-control" required autofocus>
                        @foreach($penginapan as $data)
                            <option value="{{ $data->id_penginapan }}" @if($data->id_penginapan == $kamar->id_penginapan) selected @endif>{{ $data->nama }}</option>
                        @endforeach
                    </select>

                    @if($errors->has('penginapan'))
                        <div class="text-danger">{{ $errors->first('penginapan') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Tipe Kamar</label>
                    <input type="text" class="form-control" name="tipe" value="{{ $kamar->tipe }}" required autofocus>

                    @if($errors->has('tipe'))
                        <div class="text-danger">{{ $errors->first('tipe') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Harga Kamar</label>
                    <input type="number" class="form-control" name="harga" value="{{ $kamar->harga }}" min="1" required>
                    <small class="form-text text-muted">Harga kamar dalam satuan per hari</small>

                    @if($errors->has('harga'))
                        <div class="text-danger">{{ $errors->first('harga') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Kapasitas Kamar</label>
                    <input type="number" class="form-control" name="kapasitas" value="{{ $kamar->kapasitas }}" min="1" required>
                    <small class="form-text text-muted">Kapasitas (orang) yang diperbolehkan</small>

                    @if($errors->has('kapasitas'))
                        <div class="text-danger">{{ $errors->first('kapasitas')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Jumlah Kamar</label>
                    <input type="number" class="form-control" name="jumlah" value="{{ $kamar->jumlah }}" min="1" required>
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
    </div>
</div>
@endsection