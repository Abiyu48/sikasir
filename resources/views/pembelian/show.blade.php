@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Detail Pembelian</h4>
    
    <p><strong>Tanggal:</strong> {{ $pembelian->tanggal }}</p>
    <p><strong>Supplier:</strong> {{ $pembelian->supplier }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($pembelian->total, 0, ',', '.') }}</p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Beli</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembelian->details as $item)
                <tr>
                    <td>{{ $item->menu->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->jumlah * $item->harga_beli, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
