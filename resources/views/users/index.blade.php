@extends('layouts.app')

@section('title', 'Pengguna - CheSe Cafe')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Kelola Pengguna</h1>
    <a href="{{ route('users.create') }}" class="btn">+ Tambah User</a>
</div>

<div class="card">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="status-badge {{ $user->role === 'admin' ? 'status-pending' : 'status-success' }}">{{ $user->role }}</span></td>
                    <td>
                        <div class="table-actions-inline">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus user?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">Belum ada pengguna.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection