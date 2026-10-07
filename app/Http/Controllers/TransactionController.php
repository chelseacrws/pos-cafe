<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')
            ->latest()
            ->get();

        return view(
            'transactions.index',
            compact('transactions')
        );
    }


    public function create()
    {
        $products = Product::with('category')
            ->where(function ($query) {
                $query->whereNull('stock')
                    ->orWhere('stock', '>', 0);
            })
            ->orderBy('name')
            ->get();

        return view(
            'transactions.create',
            compact('products')
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|array|min:1',
            'cart.*.product_id' => 'required|exists:products,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);


        DB::beginTransaction();

        try {

            $total = 0;
            $cartData = [];


            // Cek produk dan hitung total
            foreach ($request->cart as $item) {

                $product = Product::findOrFail(
                    $item['product_id']
                );

                $quantity = (int) $item['quantity'];


                // Cek stok jika stok digunakan
                if (
                    $product->stock !== null &&
                    $quantity > $product->stock
                ) {

                    return back()
                        ->with('error',
                            'Stok ' .
                            $product->name .
                            ' tidak mencukupi.'
                        );
                }


                $subtotal =
                    $product->price * $quantity;

                $total += $subtotal;


                $cartData[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ];
            }


            // Cek uang pembayaran
            if ($request->amount_paid < $total) {

                return back()
                    ->with('error',
                        'Uang pembayaran kurang.'
                    );
            }


            $change =
                $request->amount_paid - $total;


            // Simpan transaksi
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'transaction_date' => now(),
                'total' => $total,
            ]);


            // Simpan detail transaksi
            foreach ($cartData as $item) {

                TransactionDetail::create([

                    'transaction_id' =>
                        $transaction->id,

                    'product_id' =>
                        $item['product']->id,

                    'quantity' =>
                        $item['quantity'],

                    'price' =>
                        $item['price'],

                    'subtotal' =>
                        $item['subtotal'],
                ]);


                // Kurangi stok
                if ($item['product']->stock !== null) {

                    $item['product']->decrement(
                        'stock',
                        $item['quantity']
                    );
                }
            }


            // Simpan pembayaran
            Payment::create([

                'transaction_id' =>
                    $transaction->id,

                'amount_paid' =>
                    $request->amount_paid,

                'change_amount' =>
                    $change,

                'payment_method' =>
                    $request->payment_method,
            ]);


            DB::commit();


            return redirect()
                ->route(
                    'transactions.show',
                    $transaction
                )
                ->with(
                    'success',
                    'Transaksi berhasil disimpan.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with(
                    'error',
                    'Transaksi gagal: ' .
                    $e->getMessage()
                );
        }
    }


    public function show(Transaction $transaction)
    {
        $transaction->load([
            'user',
            'details.product',
            'payment'
        ]);

        return view(
            'transactions.show',
            compact('transaction')
        );
    }
}