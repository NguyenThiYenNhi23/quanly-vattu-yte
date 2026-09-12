<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalCustomers = Customer::count();
        $totalProducts = Product::count();
        $lowStockProducts = Product::whereColumn('quantity', '<=', 'reorder_level')
            ->with('category')
            ->orderBy('quantity', 'asc')
            ->take(5)
            ->get();
        $recentTransactions = InventoryTransaction::with('product')->latest()->take(6)->get();

        return view('dashboard', compact(
            'totalCategories',
            'totalSuppliers',
            'totalCustomers',
            'totalProducts',
            'lowStockProducts',
            'recentTransactions',
        ));
    }
}
