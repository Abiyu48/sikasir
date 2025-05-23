@extends('layouts.app')

@section('content')
    <h1>Tambah User</h1>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="form-group mb-2">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
                <option value="owner">Owner</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
