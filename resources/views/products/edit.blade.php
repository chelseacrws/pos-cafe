@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Edit Produk</h1>
</div>

<div class="card">
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="form-grid">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-field">
                <label>Nama Produk</label>
                <input type="text" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="form-field">
                <label>Kategori</label>
                <select name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <label>Harga</label>
                <input type="number" name="price" value="{{ $product->price }}" required>
            </div>
            <div class="form-field">
                <label>Stok</label>
                <input type="number" name="stock" value="{{ $product->stock }}">
            </div>
        </div>

        <div class="form-field">
            <label>Gambar Baru</label>
            <input type="file" name="image">
        </div>

        <div class="table-actions-inline">
            <button type="submit" class="btn">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection