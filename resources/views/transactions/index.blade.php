@extends('layouts.app')

@section('title', 'Riwayat Transaksi - CheSe Cafe')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Riwayat Transaksi</h1>
</div>

<div class="card">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Kasir</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>#{{ $transaction->id }}</td>
                    <td>{{ optional($transaction->user)->name ?? 'Unknown' }}</td>
                    <td>{{ optional($transaction->transaction_date)->format('d/m/Y H:i') ?? '-' }}</td>
                    <td>Rp {{ number_format((float) $transaction->total, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-secondary">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">Belum ada transaksi.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection