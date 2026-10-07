@extends('layouts.app')

@section('title', 'Dashboard - CheSe Cafe')

@section('content')

<div class="dashboard-page">
    <header class="dashboard-welcome">
        <div>
            <p class="welcome-kicker">Selamat datang di CheSe Cafe</p>
            <h1 class="page-title">Dashboard</h1>
            <p class="welcome-note">Semoga harimu hangat dan penuh pesanan lezat!</p>
        </div>
        <img class="welcome-logo" src="{{ asset('images/chesecafe-favicon.png') }}" alt="Logo CheSe Cafe">
    </header>

    <div class="cards dashboard-cards">

        <div class="stat dashboard-stat">
            <span class="stat-icon" aria-hidden="true">☕</span>
            <div>
                <h3>Total Produk</h3>
                <div class="stat-number">{{ $totalProducts }}</div>
            </div>
        </div>

        <div class="stat dashboard-stat">
            <span class="stat-icon" aria-hidden="true">♡</span>
            <div>
                <h3>Total Kategori</h3>
                <div class="stat-number">{{ $totalCategories }}</div>
            </div>
        </div>

        <div class="stat dashboard-stat">
            <span class="stat-icon" aria-hidden="true">🐾</span>
            <div>
                <h3>Total Pengguna</h3>
                <div class="stat-number">{{ $totalUsers }}</div>
            </div>
        </div>

    </div>

    <section class="income-card">
        <div>
            <h2>Pendapatan Hari Ini</h2>
            <p class="income-note">Rekap penjualan hari ini</p>
        </div>
        <p class="income-total">Rp {{ number_format($todayIncome, 0, ',', '.') }}</p>
    </section>

</div>

@endsection