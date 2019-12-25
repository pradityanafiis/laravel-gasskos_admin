@extends('layouts.app')
@section('title', 'GassKos - Ubah Penginapan')
@section('title_2', 'Ubah Penginapan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Penginapan</a></li>
    <li class="breadcrumb-item active">Ubah Penginapan</li>
@endsection

@section('main_content')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Ubah Data Penginapan</p>
            </div>
            <form method="POST" action="{{ route('penginapan.update', [$penginapan->id_penginapan]) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="card-body">
                <div class="form-group">
                    <label>Gender Penginapan</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Pria" @if($penginapan->gender == "Pria") checked @endif>
                        <label class="form-check-label">Pria</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Wanita" @if($penginapan->gender == "Wanita") checked @endif>
                        <label class="form-check-label">Wanita</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Campur" @if($penginapan->gender == "Campur") checked @endif>
                        <label class="form-check-label">Campur (Pria & Wanita)</label>
                    </div>

                    @if($errors->has('gender'))
                        <div class="text-danger">{{ $errors->first('gender')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nama Penginapan</label>
                    <input type="text" class="form-control" name="nama" value="{{ $penginapan->nama }}" required autofocus>

                    @if($errors->has('nama'))
                        <div class="text-danger">{{ $errors->first('nama')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Alamat Penginapan</label>
                    <textarea class="form-control" name="alamat" required>{{ $penginapan->alamat }}</textarea>

                    @if($errors->has('alamat'))
                        <div class="text-danger">{{ $errors->first('alamat')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Map</label>
                    <div id='map' style='width: 100%; height: 300px;'></div>
                    <small class="form-text text-muted">Perbarui lokasi terkini anda dengan mengklik button di pojok kanan atas, lalu klik lokasi penginapan pada map di atas sampai muncul marker</small>
                    <div class="row mt-2">
                        <div class="col-6">
                            <label>Latitude</label>
                            <input type="text" class="form-control form-control-sm" id="latitude" name="latitude" value="{{ $penginapan->latitude }}" readonly>
                        </div>
                        <div class="col-6">
                            <label>Longitude</label>
                            <input type="text" class="form-control form-control-sm" id="longitude" name="longitude" value="{{ $penginapan->longitude }}" readonly>
                        </div>

                        @if($errors->has('latitude'))
                            <div class="text-danger">{{ $errors->first('latitude') }}</div>
                        @endif
                        @if($errors->has('longitude'))
                            <div class="text-danger">{{ $errors->first('longitude') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" name="telepon" value="{{ $penginapan->telepon }}" required>
                    <small class="form-text text-muted">Format nomor telepon : 08xxxxxxxxxx</small>

                    @if($errors->has('telepon'))
                        <div class="text-danger">{{ $errors->first('telepon')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Fasilitas Penginapan</label>
                    @foreach($masterfasilitas as $data)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $data->id_fasilitas }}" @foreach ($fasilitas as $available) @if($data->id_fasilitas == $available->id_fasilitas) checked @endif @endforeach>
                            <label class="form-check-label">{{ $data->nama }}</label>
                        </div>
                    @endforeach
                    <small class="form-text text-muted">Fasilitas yang tersedia pada penginapan (diperbolehkan lebih dari satu)</small>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Ubah Foto Penginapan</p>
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <th style="width:5%">#</th>
                        <th style="width:75%">Nama File</th>
                        <th>View</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($foto as $fotopenginapan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $fotopenginapan->path }}</td>
                            <td><a class="btn btn-tool" href="{{ asset('foto_penginapan/'.$fotopenginapan->path.'') }}" target="__blank" data-toggle="tooltip" title="View"><i class="far fa-eye"></i></a></td>
                            <td>
                                <form onsubmit="return confirm('Foto penginapan akan dihapus')" class="d-inline" action="{{ route('fotopenginapan.destroy', [$fotopenginapan->id_foto]) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" value="Delete" class="btn btn-tool" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="card-footer">
                <form method="POST" action="{{ route('fotopenginapan.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_penginapan" value="{{ $penginapan->id_penginapan }}">
                    <div class="form-group">
                        <label>Tambah Foto Penginapan</label>
                        <input type="file" class="form-control-file" name="foto[]" accept="image/*" multiple required>
                        <small class="form-text text-muted">Diperbolehkan upload banyak foto</small>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js'></script>
    <script>
        var counter = 0;
        var penginapan = [@json($penginapan->longitude), @json($penginapan->latitude)];
        mapboxgl.accessToken = 'pk.eyJ1IjoicHJhZGl0eWFuYWZpaXMiLCJhIjoiY2szZHRqd2ZyMTkwZDNibjN3NGYwOWQ5aCJ9.zgu0saWV5-ZBgVA15jZfQw';
        
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: penginapan,
            zoom: 15,
        });

        map.addControl(new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            trackUserLocation: true,
            showUserLocation: true
        }));

        map.on('load', function() {
            addMarker(penginapan);
        });

        function addMarker(ltlng) {
            marker = new mapboxgl.Marker({draggable: false, color:"#d02922"}).setLngLat(ltlng).addTo(map).on('dragend', onDragEnd);
            counter++;
        }

        function onDragEnd() {
            var lngLat = marker.getLngLat();
            $('#latitude').val(lngLat.lat);
            $('#longitude').val(lngLat.lng);
        }

        map.on('click', function (e) {
            if (counter != 0) {
                marker.remove();   
            }
            addMarker(e.lngLat);
            $('#latitude').val(e.lngLat.lat);
            $('#longitude').val(e.lngLat.lng);
        });
    </script>
@endsection