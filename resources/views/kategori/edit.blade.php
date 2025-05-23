@extends('layouts.app')

@section('content')
    <h1>Edit Kategori</h1>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Update</button>
    <a href="{{ route('kategori.index') }}" class="btn btn-secondary mt-2">Batal</a>
</form>

@endsection
