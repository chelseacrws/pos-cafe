<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/chesecafe-favicon.png') }}">

    <title>@yield('title', 'CheSe Cafe')</title>

    <style>
        :root {
            --bg: #f6eee6;
            --bg-deep: #e9d9ca;
            --panel: rgba(255, 250, 245, 0.94);
            --panel-strong: #fffaf5;
            --sidebar: rgba(145, 110, 86, 0.98);
            --sidebar-soft: #a88369;
            --line: rgba(112, 79, 58, 0.2);
            --text: #35271f;
            --muted: #796252;
            --brown-900: #493326;
            --brown-800: #654a38;
            --brown-700: #80614b;
            --brown-500: #ab876c;
            --gold: #c9a77c;
            --gold-soft: #ead9bf;
            --success: #58715c;
            --danger: #a8564b;
            --shadow: rgba(52, 32, 24, 0.15);
            --shadow-strong: rgba(40, 24, 19, 0.2);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                radial-gradient(circle at top, rgba(255,255,255,0.7), transparent 22%),
                linear-gradient(180deg, var(--bg) 0%, var(--bg-deep) 100%);
            color: var(--text);
        }

        a {
            color: inherit;
        }

        .navbar {
            height: 82px;
            background: linear-gradient(135deg, var(--brown-900) 0%, var(--brown-800) 55%, var(--brown-700) 100%);
            color: #fff8f3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 12px 30px rgba(31, 19, 15, 0.12);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 1rem;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            display: block;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-badge {
            background: rgba(255,255,255,0.09);
            border: 1px solid rgba(255,255,255,0.14);
            padding: 9px 12px;
            border-radius: 999px;
            font-size: 0.82rem;
            color: #f7efe8;
        }

        .logout {
            background: linear-gradient(135deg, #f1e4d3, #e5c99b);
            color: var(--brown-900);
            border: none;
            padding: 10px 16px;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 700;
            box-shadow: 0 8px 18px rgba(100, 64, 42, 0.18);
        }

        .container {
            display: flex;
            min-height: calc(100vh - 82px);
        }

        .sidebar {
            width: 245px;
            background: linear-gradient(180deg, var(--sidebar) 0%, #795a45 100%);
            border-right: 1px solid rgba(255,255,255,0.08);
            padding: 28px 18px 18px;
            box-shadow: inset -10px 0 25px rgba(0,0,0,0.06);
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            color: rgba(255,248,243,0.82);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.12);
            color: #fffaf5;
            transform: translateX(2px);
        }

        .content {
            flex: 1;
            padding: 28px;
        }

        .page-title {
            margin: 0 0 18px;
            font-size: clamp(2rem, 2.6vw, 2.5rem);
            font-weight: 800;
            color: var(--brown-900);
            letter-spacing: -0.03em;
        }

        .page-toolbar {
            margin-bottom: 18px;
        }

        .card,
        .panel-card,
        .stat,
        .form-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 20px;
            box-shadow: 0 12px 28px var(--shadow);
        }

        .card {
            padding: 22px;
            margin-bottom: 20px;
        }

        .section-title {
            margin: 0 0 16px;
            font-size: 1.28rem;
            color: var(--brown-900);
            font-weight: 800;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(180px, 1fr));
            gap: 18px;
        }

        .stat {
            padding: 20px;
            background: linear-gradient(180deg, rgba(255,250,245,0.94), rgba(232,216,199,0.72));
        }

        .stat h3 {
            margin: 0 0 12px;
            font-size: 0.82rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--brown-900);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255,255,255,0.2);
            border-radius: 18px;
            overflow: hidden;
        }

        th,
        td {
            padding: 13px 12px;
            border-bottom: 1px solid rgba(114, 91, 77, 0.14);
            text-align: left;
        }

        th {
            background: rgba(148, 114, 94, 0.1);
            color: var(--brown-700);
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border: none;
            border-radius: 12px;
            text-decoration: none;
            cursor: pointer;
            background: linear-gradient(135deg, var(--brown-800), var(--brown-700));
            color: #fffaf5;
            font-weight: 700;
            box-shadow: 0 12px 20px rgba(68, 41, 31, 0.15);
        }

        .btn:hover {
            filter: brightness(1.03);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #be7367);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #7a645b, #a58a78);
        }

        .empty-state {
            padding: 22px;
            border: 1px dashed rgba(110, 80, 60, 0.25);
            border-radius: 16px;
            background: rgba(255,255,255,0.28);
            color: var(--muted);
            text-align: center;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid rgba(123, 89, 62, 0.22);
            border-radius: 12px;
            background: rgba(255,255,255,0.7);
            color: var(--text);
            margin-top: 6px;
            margin-bottom: 14px;
            outline: none;
            font: inherit;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: rgba(103, 74, 58, 0.4);
            box-shadow: 0 0 0 4px rgba(96, 68, 50, 0.08);
        }

        label {
            font-weight: 700;
            color: var(--brown-700);
        }

        .alert {
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 16px;
            border: 1px solid rgba(112, 79, 61, 0.16);
            background: rgba(255,255,255,0.46);
            color: var(--brown-800);
            box-shadow: 0 8px 20px rgba(87, 58, 43, 0.06);
        }

        .form-grid {
            display: grid;
            gap: 12px;
        }

        .form-field {
            width: 100%;
        }

        .dashboard-page {
            max-width: 1280px;
            margin: 0 auto;
        }

        .dashboard-welcome {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
            padding: 24px 28px;
            border: 1px solid rgba(128, 97, 75, 0.18);
            border-radius: 20px;
            background: linear-gradient(120deg, rgba(255,250,245,0.96), rgba(238,220,199,0.9));
            box-shadow: 0 12px 26px rgba(82, 57, 39, 0.09);
        }

        .welcome-kicker {
            margin: 0 0 6px;
            color: var(--brown-700);
            font-size: 0.78rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        .dashboard-welcome .page-title {
            margin: 0 0 6px;
            font-size: 2rem;
        }

        .welcome-note {
            margin: 0;
            color: var(--muted);
        }

        .welcome-logo {
            width: 76px;
            height: 76px;
            flex: 0 0 76px;
            border: 4px solid rgba(255,250,245,0.9);
            border-radius: 50%;
            box-shadow: 0 6px 14px rgba(82, 57, 39, 0.16);
        }

        .dashboard-cards {
            gap: 16px;
            margin-bottom: 24px;
        }

        .dashboard-stat {
            display: grid;
            grid-template-columns: 48px minmax(0, 1fr);
            align-items: center;
            gap: 14px;
            min-height: 112px;
            padding: 18px;
            border-radius: 16px;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .dashboard-stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 28px rgba(82, 57, 39, 0.14);
        }

        .stat-icon {
            display: grid;
            place-items: center;
            width: 48px;
            height: 48px;
            border-radius: 15px;
            background: #ead8c4;
            font-size: 1.35rem;
        }

        .dashboard-stat:nth-child(2) .stat-icon {
            background: #f1e3ce;
        }

        .dashboard-stat:nth-child(3) .stat-icon {
            background: #e4dfc9;
        }

        .dashboard-stat h3 {
            margin: 0 0 5px;
            font-size: 0.76rem;
        }

        .dashboard-stat .stat-number {
            font-size: 1.8rem;
            line-height: 1.1;
        }

        .income-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            min-height: 150px;
            padding: 24px 28px;
            border: 1px solid rgba(128, 97, 75, 0.18);
            border-radius: 18px;
            background: linear-gradient(120deg, #dfc5a8, #f2e4d2 72%);
            box-shadow: 0 12px 26px rgba(82, 57, 39, 0.1);
        }

        .income-card h2 {
            margin: 0 0 6px;
            color: var(--brown-900);
            font-size: 1.2rem;
        }

        .income-note {
            margin: 0;
            color: var(--muted);
        }

        .income-total {
            margin: 0;
            color: var(--brown-900);
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-weight: 800;
            text-align: right;
            overflow-wrap: anywhere;
        }

        @media(max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 16px 14px;
            }

            .sidebar-nav {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .content {
                padding: 18px 16px 24px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .dashboard-welcome {
                padding: 20px;
            }

            .welcome-logo {
                width: 60px;
                height: 60px;
                flex-basis: 60px;
            }

            .income-card {
                align-items: flex-start;
                flex-direction: column;
                padding: 20px;
            }

            .income-total {
                text-align: left;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">

    <div class="brand">
        <img class="brand-mark" src="{{ asset('images/chesecafe-favicon.png') }}" alt="" aria-hidden="true">
        <span>CheSe Cafe</span>
    </div>

    <div class="user-info">

        @auth
            <span class="user-badge">
                {{ auth()->user()->name }} · {{ auth()->user()->role }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button class="logout" type="submit">
                    Logout
                </button>
            </form>
        @endauth

    </div>

</nav>

<div class="container">

    <aside class="sidebar">
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            @if(auth()->user()->role === 'admin')

                <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    Kategori
                </a>

                <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                    Produk
                </a>

                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    Pengguna
                </a>

                <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    Laporan
                </a>

            @endif

            <a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions.index') ? 'active' : '' }}">
                Riwayat Transaksi
            </a>

            <a href="{{ route('transactions.create') }}" class="{{ request()->routeIs('transactions.create') ? 'active' : '' }}">
                POS Kasir
            </a>
        </nav>
    </aside>

    <main class="content">

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

</div>

</body>
</html>