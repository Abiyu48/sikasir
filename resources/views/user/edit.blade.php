@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    <form action="{{ route('user.update', $user) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group mb-2">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="form-group mb-2">
            <label>Password <small>(Kosongkan jika tidak diubah)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
