<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        $todayIncome = Transaction::whereDate(
            'transaction_date',
            today()
        )->sum('total');

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'todayIncome'
        ));
    }
}