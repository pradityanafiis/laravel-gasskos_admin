@extends('layouts.app')
@section('title', 'GassKos - Dashboard')
@section('title_2', 'Dashboard')

@section('main_content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="alert alert-dark" role="alert">
            <h4 class="alert-heading"><strong>{{ Auth::user()->name }},</strong></h4>
            Selamat datang! Anda berhasil login.
        </div>
    </div>
</div>
@endsection
