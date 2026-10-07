@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Tambah User</h1>
</div>

<div class="card">
    <form action="{{ route('users.store') }}" method="POST" class="form-grid">
        @csrf
        <div class="form-row">
            <div class="form-field">
                <label>Nama</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-field">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-field">
                <label>Role</label>
                <select name="role" required>
                    <option value="kasir">Kasir</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        </div>

        <div class="table-actions-inline">
            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection