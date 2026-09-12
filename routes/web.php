<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('customers', CustomerController::class)->except('show');
    Route::resource('products', ProductController::class);

    Route::get('/transactions/import', [InventoryTransactionController::class, 'importCreate'])->name('transactions.import.create');
    Route::post('/transactions/import', [InventoryTransactionController::class, 'importStore'])->name('transactions.import.store');
    Route::get('/transactions/export', [InventoryTransactionController::class, 'exportCreate'])->name('transactions.export.create');
    Route::post('/transactions/export', [InventoryTransactionController::class, 'exportStore'])->name('transactions.export.store');
    Route::resource('transactions', InventoryTransactionController::class)->parameters([
        'transactions' => 'inventory_transaction',
    ])->except(['create', 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
