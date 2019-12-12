@extends('layouts.app')
@section('title', 'GassKos - Ubah Penginapan')
@section('title_2', 'Ubah Penginapan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Penginapan</a></li>
    <li class="breadcrumb-item active">Ubah Penginapan</li>
@endsection

@section('main_content')
<div class="card card-primary">
    <form method="POST" action="{{ route('penginapan.update', [$penginapan['id_penginapan']]) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="card-body">
        <div class="form-group">
            <label>Nama Penginapan</label>
            <input type="text" class="form-control" name="nama" value="{{ $penginapan['nama'] }}" required autofocus>

            @if($errors->has('nama'))
                <div class="text-danger">{{ $errors->first('nama')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label>Alamat Penginapan</label>
            <textarea class="form-control" name="alamat" required>{{ $penginapan['alamat'] }}</textarea>

            @if($errors->has('alamat'))
                <div class="text-danger">{{ $errors->first('alamat')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="text" class="form-control" name="telepon" value="{{ $penginapan['telepon'] }}" required>

            @if($errors->has('telepon'))
                <div class="text-danger">{{ $errors->first('telepon')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label>Fasilitas Penginapan</label>
            @foreach($masterfasilitas as $data)
                
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $data->id_fasilitas }}" @foreach ($fasilitas as $available) @if($data->id_fasilitas == $available->id_fasilitas ) checked @endif @endforeach>
                        <label class="form-check-label">{{ $data->nama }}</label>
                    </div>
                
            @endforeach
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>
<!-- /.card -->
@endsection

@section('javascript')

@endsection