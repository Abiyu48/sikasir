@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Manajemen Stok Barang</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menus as $menu)
            <tr>
                <td>{{ $menu->nama }}</td>
                <td>{{ $menu->kategori->nama }}</td>
                <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                <td>{{ $menu->stok }}</td>
                <td>
                    <a href="{{ route('stok.edit', $menu->id) }}" class="btn btn-sm btn-primary">Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data menu.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
