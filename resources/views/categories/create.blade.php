@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Tambah Kategori</h1>
</div>

<div class="card">
    <form action="{{ route('categories.store') }}" method="POST" class="form-grid">
        @csrf
        <div class="form-field">
            <label>Nama Kategori</label>
            <input type="text" name="name" placeholder="Contoh: Kopi" required>
        </div>
        <div class="table-actions-inline">
            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection