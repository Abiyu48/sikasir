@extends('layouts.app')

@section('content')
<h1>Edit Customer</h1>

<form action="{{ route('customer.update', $customer->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $customer->nama) }}" class="form-control" required>
    </div>

    <div class="form-group mt-2">
        <label>Telepon</label>
        <input type="text" name="telepon" value="{{ old('telepon', $customer->telepon) }}" class="form-control">
    </div>

    <div class="form-group mt-2">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control">{{ old('alamat', $customer->alamat) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Update</button>
    <a href="{{ route('customer.index') }}" class="btn btn-secondary mt-3">Batal</a>
</form>
@endsection
