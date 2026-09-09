<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryTransactionController extends Controller
{
    public function index()
    {
        $transactions = InventoryTransaction::with('product')->latest()->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:import,export,adjustment'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_price' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'reference' => ['nullable', 'string', 'max:100'],
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $delta = $validated['quantity'];

        if ($validated['type'] === 'export') {
            $delta = -$delta;
        }

        if ($validated['type'] === 'adjustment') {
            $delta = (int) $request->input('adjustment_direction') === 1 ? $validated['quantity'] : -$validated['quantity'];
        }

        $product->quantity = max(0, $product->quantity + $delta);
        $product->save();

        InventoryTransaction::create([
            'product_id' => $product->id,
            'type' => $validated['type'],
            'quantity' => $delta,
            'unit_price' => $validated['unit_price'] ?? $product->purchase_price,
            'notes' => $validated['notes'] ?? 'Giao dịch kho',
            'reference' => $validated['reference'] ?? strtoupper($validated['type']),
            'performed_by' => auth()->user()?->name ?? 'System',
        ]);

        return redirect()->route('transactions.index')->with('success', 'Giao dịch kho đã được lưu.');
    }
}
