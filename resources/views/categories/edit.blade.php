@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Edit Kategori</h1>
</div>

<div class="card">
    <form action="{{ route('categories.update', $category) }}" method="POST" class="form-grid">
        @csrf
        @method('PUT')
        <div class="form-field">
            <label>Nama Kategori</label>
            <input type="text" name="name" value="{{ $category->name }}" required>
        </div>
        <div class="table-actions-inline">
            <button type="submit" class="btn">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection