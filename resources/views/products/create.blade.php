@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Tambah Produk</h1>
</div>

<div class="card">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="form-grid">
        @csrf
        <div class="form-row">
            <div class="form-field">
                <label>Nama Produk</label>
                <input type="text" name="name" placeholder="Contoh: Kopi Latte" required>
            </div>
            <div class="form-field">
                <label>Kategori</label>
                <select name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <label>Harga</label>
                <input type="number" name="price" min="0" required>
            </div>
            <div class="form-field">
                <label>Stok</label>
                <input type="number" name="stock" min="0">
            </div>
        </div>

        <div class="form-field">
            <label>Gambar</label>
            <input type="file" name="image">
        </div>

        <div class="table-actions-inline">
            <button type="submit" class="btn">Simpan</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection