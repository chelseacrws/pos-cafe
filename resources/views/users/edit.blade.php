@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Edit User</h1>
</div>

<div class="card">
    <form action="{{ route('users.update', $user) }}" method="POST" class="form-grid">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-field">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-field">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <label>Password Baru</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti">
            </div>
            <div class="form-field">
                <label>Role</label>
                <select name="role">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kasir" {{ $user->role === 'kasir' ? 'selected' : '' }}>Kasir</option>
                </select>
            </div>
        </div>

        <div class="table-actions-inline">
            <button type="submit" class="btn">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection