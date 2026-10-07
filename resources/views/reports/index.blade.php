@extends('layouts.app')

@section('title', 'Laporan - CheSe Cafe')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">Laporan Penjualan</h1>
</div>

<div class="card">
    <h3 class="section-title">Pilih Tanggal</h3>
    <form action="{{ route('reports.index') }}" method="GET" class="form-grid" style="margin-top: 16px;">
        <div class="form-field">
            <label>Tanggal</label>
            <input type="date" name="date" value="{{ $date }}">
        </div>
        <div>
            <button type="submit" class="btn">Tampilkan</button>
        </div>
    </form>
</div>

<div class="report-grid">
    <div class="report-stat">
        <h3>Pendapatan Hari Ini</h3>
        <strong>Rp {{ number_format($todayIncome, 0, ',', '.') }}</strong>
    </div>

    <div class="report-stat">
        <h3>Total Transaksi</h3>
        <strong>{{ $totalTransactions }}</strong>
    </div>

    <div class="report-stat">
        <h3>Pendapatan Bulan Ini</h3>
        <strong>Rp {{ number_format($monthIncome, 0, ',', '.') }}</strong>
    </div>
</div>

@endsection