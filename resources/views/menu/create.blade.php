@extends('layouts.app')

@section('content')
<h1>Tambah Menu</h1>

<form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-2">
        <label>Nama Menu</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="form-group mt-2">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
    </div>

    <div class="form-group mt-2">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" required>
    </div>

    <div class="form-group mt-2">
        <label>Gambar (opsional)</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    <a href="{{ route('menu.index') }}" class="btn btn-secondary mt-3">Batal</a>
</form>
@endsection
