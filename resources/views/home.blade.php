@extends('layouts.app')
@section('title', 'GassKos - Dashboard')
@section('title_2', 'Dashboard')

@section('main_content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Selamat datang {{ Auth::user()->name }}!</strong> Anda berhasil login.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endsection
