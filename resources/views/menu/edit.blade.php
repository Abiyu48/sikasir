@extends('layouts.app')

@section('content')
<h1>Edit Menu</h1>

<form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ $menu->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-2">
        <label>Nama Menu</label>
        <input type="text" name="nama" value="{{ old('nama', $menu->nama) }}" class="form-control" required>
    </div>

    <div class="form-group mt-2">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
    </div>

    <div class="form-group mt-2">
        <label>Harga</label>
        <input type="number" name="harga" value="{{ old('harga', $menu->harga) }}" class="form-control" required>
    </div>

    <div class="form-group mt-2">
        <label>Gambar (opsional)</label>
        @if($menu->gambar)
            <div>
                <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" width="120">
            </div>
        @endif
        <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary mt-3">Update</button>
    <a href="{{ route('menu.index') }}" class="btn btn-secondary mt-3">Batal</a>
</form>
@endsection
