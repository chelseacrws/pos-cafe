<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Tanggal laporan
        $date = $request->date ?? date('Y-m-d');

        // Pendapatan hari ini
        $todayIncome = Transaction::whereDate(
            'transaction_date',
            $date
        )->sum('total');

        // Jumlah transaksi
        $totalTransactions = Transaction::whereDate(
            'transaction_date',
            $date
        )->count();

        // Pendapatan bulan ini
        $monthIncome = Transaction::whereMonth(
            'transaction_date',
            date('m')
        )->whereYear(
            'transaction_date',
            date('Y')
        )->sum('total');

        return view('reports.index', compact(
            'date',
            'todayIncome',
            'totalTransactions',
            'monthIncome'
        ));
    }
}