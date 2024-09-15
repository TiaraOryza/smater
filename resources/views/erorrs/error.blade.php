@extends('layouts.header_admin')

@section('content')
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Terjadi Kesalahan!</h4>
            <p>{{ $message }}</p>
            <hr>
            <p class="mb-0">Silakan periksa data Anda atau hubungi administrator jika masalah berlanjut.</p>
        </div>
    </div>
@endsection

@include('layouts.footer_admin')
