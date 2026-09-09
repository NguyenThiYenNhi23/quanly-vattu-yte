<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'supplier'])
            ->orderBy('name')
            ->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku'],
            'category_id' => ['required', 'exists:categories,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'unit' => ['required', 'string', 'max:50'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'reorder_level' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $product = Product::create($validated);

        if ($product->quantity > 0) {
            InventoryTransaction::create([
                'product_id' => $product->id,
                'type' => 'initial',
                'quantity' => $product->quantity,
                'unit_price' => $product->purchase_price,
                'notes' => 'Khởi tạo số lượng ban đầu',
                'reference' => 'INITIAL',
                'performed_by' => auth()->user()?->name ?? 'System',
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku,'.$product->id],
            'category_id' => ['required', 'exists:categories,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'unit' => ['required', 'string', 'max:50'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'reorder_level' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $oldQuantity = $product->quantity;
        $product->update($validated);

        $quantityDifference = $product->quantity - $oldQuantity;
        if ($quantityDifference !== 0) {
            InventoryTransaction::create([
                'product_id' => $product->id,
                'type' => 'adjustment',
                'quantity' => $quantityDifference,
                'unit_price' => $product->purchase_price,
                'notes' => 'Điều chỉnh số lượng theo cập nhật',
                'reference' => 'UPDATE',
                'performed_by' => auth()->user()?->name ?? 'System',
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa.');
    }
}
