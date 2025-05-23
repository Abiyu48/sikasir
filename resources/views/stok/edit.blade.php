@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Stok - {{ $menu->nama }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('stok.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="stok" class="form-label">Stok Baru</label>
            <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $menu->stok) }}" min="0" required>
            @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Stok</button>
        <a href="{{ route('stok.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
