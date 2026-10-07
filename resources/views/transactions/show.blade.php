@extends('layouts.app')

@section('title', 'Struk Transaksi - CheSe Cafe')

@section('content')

<div class="card">

    <h2>
        CheSe Cafe
    </h2>

    <p>
        No. Transaksi:
        #{{ $transaction->id }}
    </p>

    <p>
        Kasir:
        {{ optional($transaction->user)->name ?? 'Unknown' }}
    </p>

    <p>
        Tanggal:
        {{ optional($transaction->transaction_date)->format('d/m/Y H:i') ?? '-' }}
    </p>

    <hr>

    <table>

        <tr>
            <th>Produk</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>

        @forelse($transaction->details ?? [] as $detail)

        <tr>

            <td>
                {{ optional($detail->product)->name ?? '-' }}
            </td>

            <td>
                {{ $detail->quantity ?? 0 }}
            </td>

            <td>
                Rp {{ number_format(
                    (float) ($detail->subtotal ?? 0),
                    0,
                    ',',
                    '.'
                ) }}
            </td>

        </tr>

        @empty
            <tr>
                <td colspan="3">Belum ada item transaksi.</td>
            </tr>
        @endforelse

    </table>

    <hr>

    <h3>
        Total:
        Rp {{ number_format(
            $transaction->total,
            0,
            ',',
            '.'
        ) }}
    </h3>

    <p>
        Dibayar:
        Rp {{ number_format(
            (float) optional($transaction->payment)->amount_paid ?? 0,
            0,
            ',',
            '.'
        ) }}
    </p>

    <p>
        Kembalian:
        Rp {{ number_format(
            (float) optional($transaction->payment)->change_amount ?? 0,
            0,
            ',',
            '.'
        ) }}
    </p>

    <p>
        Pembayaran:
        {{ strtoupper(optional($transaction->payment)->payment_method ?? '-') }}
    </p>

    <br>

    <button
        onclick="window.print()"
        class="btn"
    >
        Cetak Struk
    </button>

    <a
        href="{{ route('transactions.create') }}"
        class="btn"
    >
        Transaksi Baru
    </a>

</div>

@endsection