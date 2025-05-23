@extends('layouts.app')

@section('content')
<h1>Daftar Customer</h1>

<a href="{{ route('customer.create') }}" class="btn btn-primary mb-3">Tambah Customer</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->nama }}</td>
                <td>{{ $customer->telepon ?? '-' }}</td>
                <td>{{ $customer->alamat ?? '-' }}</td>
                <td>
                    <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
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
