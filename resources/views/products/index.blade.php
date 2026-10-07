@extends('layouts.app')

@section('title', 'Produk - CheSe Cafe')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Kelola Produk</h1>
    <a href="{{ route('products.create') }}" class="btn">+ Tambah Produk</a>
</div>

<div class="card">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock ?? '-' }}</td>
                    <td>
                        <div class="table-actions-inline">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus produk?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">Belum ada produk.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection