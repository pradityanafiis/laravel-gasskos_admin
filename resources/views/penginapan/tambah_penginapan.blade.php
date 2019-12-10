@extends('layouts.app')
@section('title', 'GassKos - Tambah Penginapan')
@section('title_2', 'Tambah Penginapan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Penginapan</a></li>
    <li class="breadcrumb-item active">Tambah Penginapan</li>
@endsection

@section('main_content')
<div class="card card-primary">
    <form method="POST" action="/penginapan/store">
    {{ csrf_field() }}
    <div class="card-body">
        <div class="form-group">
            <label>Nama Penginapan</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required autofocus>

            @if($errors->has('nama'))
                <div class="text-danger">{{ $errors->first('nama')}}</div>
            @endif
        </div>
        
        <div class="form-group">
            <label>Alamat Penginapan</label>
            <textarea class="form-control" name="alamat" required>{{ old('alamat') }}</textarea>

            @if($errors->has('alamat'))
                <div class="text-danger">{{ $errors->first('alamat')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label>Map</label>
            <div id='map' style='width: 100%; height: 300px;'></div>
            <div class="row mt-2">
                <div class="col-6">
                    <label>Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" readonly>
                </div>
                <div class="col-6">
                    <label>Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" readonly>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="text" class="form-control" name="telepon" value="{{ old('telepon') }}" required>

            @if($errors->has('telepon'))
                <div class="text-danger">{{ $errors->first('telepon')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label>Fasilitas Penginapan</label>
            @foreach($fasilitas as $data)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $data->id_fasilitas }}">
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
@endsection

@section('javascript')
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js'></script>
    <script>
        var counter = 0;
        mapboxgl.accessToken = 'pk.eyJ1IjoicHJhZGl0eWFuYWZpaXMiLCJhIjoiY2szZHRqd2ZyMTkwZDNibjN3NGYwOWQ5aCJ9.zgu0saWV5-ZBgVA15jZfQw';
        
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            zoom: 0,
        });

        map.addControl(new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            trackUserLocation: true,
            showUserLocation: true
        }));

        function addMarker(ltlng, event) {
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
            addMarker(e.lngLat, 'click');
            $('#latitude').val(e.lngLat.lat);
            $('#longitude').val(e.lngLat.lng);
        });
    </script>
@endsection