@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Pengguna</h4>
    <div class="mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $i => $user)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    {{-- <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
