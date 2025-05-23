@extends('layouts.app')

@section('content')
<h1>Tambah Customer</h1>

<form action="{{ route('customer.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="form-group mt-2">
        <label>Telepon</label>
        <input type="text" name="telepon" class="form-control">
    </div>

    <div class="form-group mt-2">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    <a href="{{ route('customer.index') }}" class="btn btn-secondary mt-3">Batal</a>
</form>
@endsection
