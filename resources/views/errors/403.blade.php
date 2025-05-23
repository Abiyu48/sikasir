@extends('layouts.app')

@section('title', '403 - Akses Ditolak')

@section('content')
<div class="container text-center mt-5">
    <div class="error mx-auto" data-text="403" style="font-size: 10rem; color: #e74a3b;">403</div>
    <p class="lead text-gray-800 mb-4">Akses Ditolak</p>
    <p class="text-gray-600 mb-5">Maaf, Anda tidak memiliki hak untuk mengakses halaman ini.</p>
    <a href="{{ url()->previous() }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
@endsection
