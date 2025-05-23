@extends('layouts.app')

@section('content')
<h1>Daftar Pengguna</h1>
<a href="{{ route('user.create') }}" class="btn btn-success mb-2">Tambah User</a>

<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ ucfirst($user->role) }}</td>
        <td>
            <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('user.destroy', $user) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button onclick="return confirm('Hapus user ini?')" class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
