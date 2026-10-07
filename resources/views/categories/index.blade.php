@extends('layouts.app')

@section('title', 'Kategori - CheSe Cafe')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Kelola Kategori</h1>
    <a href="{{ route('categories.create') }}" class="btn">+ Tambah Kategori</a>
</div>

<div class="card">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="table-actions-inline">
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="empty-state">Belum ada kategori.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection