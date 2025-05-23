@extends('layouts.app')

@section('content')
    <h1>Tambah Kategori</h1>

    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label>Gambar Kategori (opsional)</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
@endsection
