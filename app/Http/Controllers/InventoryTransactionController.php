<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InventoryTransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();
        $type = $request->string('type')->trim()->toString();

        $transactions = InventoryTransaction::with(['product', 'supplier', 'customer'])
            ->when($type !== '', function ($query) use ($type): void {
                $query->where('type', $type);
            })
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('type', 'like', "%{$search}%")
                        ->orWhere('reference', 'like', "%{$search}%")
                        ->orWhere('performed_by', 'like', "%{$search}%")
                        ->orWhereHas('product', function ($query) use ($search): void {
                            $query->where('name', 'like', "%{$search}%")
                                ->orWhere('sku', 'like', "%{$search}%");
                        })
                        ->orWhereHas('supplier', function ($query) use ($search): void {
                            $query->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('customer', function ($query) use ($search): void {
                            $query->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('transactions.index', compact('transactions', 'search', 'type'));
    }

    public function create()
    {
        return redirect()->route('transactions.import.create');
    }

    public function importCreate()
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();

        return view('transactions.import-create', compact('products', 'suppliers', 'customers'));
    }

    public function exportCreate()
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();

        return view('transactions.export-create', compact('products', 'suppliers', 'customers'));
    }

    public function show(InventoryTransaction $inventoryTransaction)
    {
        $inventoryTransaction->load(['product', 'supplier', 'customer']);

        return view('transactions.show', compact('inventoryTransaction'));
    }

    public function importStore(Request $request)
    {
        return $this->storeTransaction($request, 'import');
    }

    public function exportStore(Request $request)
    {
        return $this->storeTransaction($request, 'export');
    }

    public function store(Request $request)
    {
        return $this->storeTransaction($request, 'import');
    }

    protected function storeTransaction(Request $request, string $type)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_price' => ['nullable', 'numeric', 'min:0'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($type === 'import' && empty($validated['supplier_id'])) {
            $request->validate(['supplier_id' => ['required', 'exists:suppliers,id']]);
        }

        if ($type === 'export' && empty($validated['customer_id'])) {
            $request->validate(['customer_id' => ['required', 'exists:customers,id']]);
        }

        $product = Product::findOrFail($validated['product_id']);
        $delta = $validated['quantity'];

        if ($type === 'export') {
            $delta = -$delta;
        }

        $product->quantity = max(0, $product->quantity + $delta);
        $product->save();

        $reference = $this->generateReference($type);

        InventoryTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => $type === 'import' ? ($validated['supplier_id'] ?? null) : null,
            'customer_id' => $type === 'export' ? ($validated['customer_id'] ?? null) : null,
            'type' => $type,
            'quantity' => $delta,
            'unit_price' => $validated['unit_price'] ?? 0,
            'notes' => $validated['notes'] ?? 'Giao dịch kho',
            'reference' => $reference,
            'performed_by' => auth()->user()?->name ?? 'System',
        ]);

        return redirect()->route('transactions.index')->with('success', 'Phiếu ' . ($type === 'import' ? 'nhập' : 'xuất') . ' kho đã được lưu.');
    }

    protected function generateReference(string $type): string
    {
        $prefix = $type === 'import' ? 'NK' : 'XK';

        $lastTransaction = InventoryTransaction::where('type', $type)
            ->orderByDesc('id')
            ->first();

        $sequence = $lastTransaction ? (int) str_replace($prefix . '-', '', $lastTransaction->reference ?? '0') + 1 : 1;

        return $prefix . '-' . str_pad((string) $sequence, 6, '0', STR_PAD_LEFT);
    }
}
