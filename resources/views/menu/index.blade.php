@extends('layouts.app')

@section('content')
<h1>Daftar Menu</h1>

<a href="{{ route('menu.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Menu</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->nama }}</td>
                <td>{{ $menu->kategori->nama }}</td>
                <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                <td>
                    @if($menu->gambar)
                        <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" width="80">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
