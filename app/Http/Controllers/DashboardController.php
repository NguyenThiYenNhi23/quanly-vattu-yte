<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalProducts = Product::count();
        $lowStockProducts = Product::whereColumn('quantity', '<=', 'reorder_level')
            ->with('category')
            ->orderBy('quantity', 'asc')
            ->take(5)
            ->get();
        $inventoryValue = Product::sum(DB::raw('quantity * purchase_price'));
        $recentTransactions = InventoryTransaction::with('product')->latest()->take(6)->get();

        return view('dashboard', compact(
            'totalCategories',
            'totalSuppliers',
            'totalProducts',
            'lowStockProducts',
            'inventoryValue',
            'recentTransactions',
        ));
    }
}
