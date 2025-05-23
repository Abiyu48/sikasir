@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Pembelian</h4>

    <a href="{{ route('pembelian.create') }}" class="btn btn-success mb-3">+ Tambah Pembelian</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Supplier</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pembelian as $item)
                <tr>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->supplier }}</td>
                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('pembelian.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data pembelian</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
