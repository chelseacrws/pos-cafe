@extends('layouts.app')

@section('title', 'POS Kasir - CheSe Cafe')

@section('content')

<div class="page-toolbar">
    <h1 class="page-title">POS Kasir</h1>
</div>

<div style="display:grid; grid-template-columns: 1.2fr 0.8fr; gap: 18px;">
    <div class="card">
        <h3 class="section-title">Daftar Menu</h3>

        @php
            $groupedProducts = $products->groupBy(fn($product) => optional($product->category)->name ?? 'Lainnya');
            $categoryOrder = ['Coffee', 'Tea', 'Dessert', 'Snack', 'Food', 'Lainnya'];
            $orderedGroups = [];

            foreach ($categoryOrder as $categoryName) {
                if ($groupedProducts->has($categoryName)) {
                    $orderedGroups[] = [$categoryName, $groupedProducts->get($categoryName)];
                }
            }

            foreach ($groupedProducts as $categoryName => $items) {
                if (!in_array($categoryName, $categoryOrder, true)) {
                    $orderedGroups[] = [$categoryName, $items];
                }
            }
        @endphp

        <div id="products" style="display:block; margin-top: 16px;">
            @forelse($orderedGroups as [$categoryName, $items])
                <div style="margin-bottom: 20px;">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 12px;">
                        <h4 style="margin:0; color:#3b2a22; font-size: 18px; font-weight: 800;">{{ $categoryName }}</h4>
                        <span style="padding:6px 10px; border-radius:999px; background:#f3e4d7; color:#7b5242; font-size:12px; font-weight:700;">{{ $items->count() }} item</span>
                    </div>

                    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap: 14px;">
                        @foreach($items as $product)
                            <div class="panel-card" style="padding: 16px;">
                                <strong style="display:block; font-size: 16px; margin-bottom: 8px;">{{ $product->name }}</strong>
                                <div style="color: #6f564b; margin-bottom: 6px;">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                <small style="display:block; color: #8d6d58; margin-bottom: 12px;">{{ $product->category->name ?? 'Kategori umum' }}</small>
                                <button type="button" class="btn" onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', Number('{{ $product->price }}'))">+ Tambah</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="empty-state" style="padding: 24px;">Belum ada produk yang tersedia.</div>
            @endforelse
        </div>
    </div>

    <div class="card">
        <h3 class="section-title">Keranjang Pesanan</h3>
        <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm" class="form-grid" style="margin-top: 16px;">
            @csrf

            <div id="cartContainer" class="empty-state" style="padding: 18px; background: #fffaf5; border-color: rgba(128, 87, 60, 0.22); color: #6f564b;">Keranjang masih kosong.</div>

            <div class="form-field">
                <label>Total</label>
                <div style="font-size: 24px; font-weight: 800; color: #2d201b;">Rp <span id="total">0</span></div>
            </div>

            <div class="form-field">
                <label>Uang Dibayar</label>
                <input type="number" name="amount_paid" id="amount_paid" min="0" required oninput="calculateChange()">
            </div>

            <div class="form-field">
                <label>Metode Pembayaran</label>
                <select name="payment_method" required>
                    <option value="cash">Cash</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>

            <div class="form-field">
                <label>Kembalian</label>
                <div style="font-size: 24px; font-weight: 800; color: #2d201b;">Rp <span id="change">0</span></div>
            </div>

            <button type="submit" class="btn">Bayar & Simpan Transaksi</button>
        </form>
    </div>
</div>

<script>

let cart = [];

function addToCart(id, name, price) {
    const existing = cart.find(item => Number(item.product_id) === Number(id));

    if (existing) {
        existing.quantity += 1;
    } else {
        cart.push({
            product_id: Number(id),
            name: String(name),
            price: Number(price),
            quantity: 1
        });
    }

    renderCart();
}

function removeFromCart(id) {
    cart = cart.filter(item => Number(item.product_id) !== Number(id));
    renderCart();
}

function changeQuantity(id, quantity) {
    const item = cart.find(entry => Number(entry.product_id) === Number(id));

    if (!item) return;

    const nextQty = Number(quantity);

    if (!Number.isFinite(nextQty) || nextQty < 1) {
        removeFromCart(id);
        return;
    }

    item.quantity = nextQty;
    renderCart();
}

function renderCart() {
    const container = document.getElementById('cartContainer');

    if (cart.length === 0) {
        container.innerHTML = '<p>Keranjang masih kosong.</p>';
        document.getElementById('total').innerText = '0';
        document.getElementById('change').innerText = '0';
        return;
    }

    let total = 0;
    let html = '';

    cart.forEach((item) => {
        const subtotal = Number(item.price) * Number(item.quantity);
        total += subtotal;

        html += `
            <div style="border-bottom: 1px solid #ead9c9; padding: 10px 0; color: #3c2b26;">
                <strong>${item.name}</strong><br>
                Rp ${formatNumber(Number(item.price))}<br><br>
                <input type="number" min="1" value="${Number(item.quantity)}" onchange="changeQuantity(${Number(item.product_id)}, this.value)" style="width: 80px; display: inline-block; border: 1px solid #e7d7c8; border-radius: 8px; padding: 8px 10px; background: #fffaf5; color: #2d201b;">
                <button type="button" class="btn btn-danger" onclick="removeFromCart(${Number(item.product_id)})">Hapus</button><br>
                Subtotal: Rp ${formatNumber(subtotal)}
                <input type="hidden" name="cart[${Number(item.product_id)}][product_id]" value="${Number(item.product_id)}">
                <input type="hidden" name="cart[${Number(item.product_id)}][quantity]" value="${Number(item.quantity)}">
            </div>
        `;
    });

    container.innerHTML = html;
    document.getElementById('total').innerText = formatNumber(total);
    calculateChange();
}

function calculateChange() {
    const total = Number((document.getElementById('total').innerText || '0').replace(/[^\d]/g, '')) || 0;
    const paid = Number(document.getElementById('amount_paid').value || 0);
    const change = Math.max(0, paid - total);

    document.getElementById('change').innerText = formatNumber(change);
}

function formatNumber(number) {
    return new Intl.NumberFormat('id-ID').format(Number(number || 0));
}

</script>

@endsection