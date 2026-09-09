<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Tạo giao dịch kho</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <form method="POST" action="{{ route('transactions.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Sản phẩm</label>
                        <select name="product_id" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">-- Chọn sản phẩm --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Loại giao dịch</label>
                        <select name="type" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="import">Nhập kho</option>
                            <option value="export">Xuất kho</option>
                            <option value="adjustment">Điều chỉnh</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Số lượng</label>
                        <input type="number" name="quantity" min="1" value="{{ old('quantity', 1) }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Hướng điều chỉnh (nếu loại điều chỉnh)</label>
                        <select name="adjustment_direction" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="1">Tăng</option>
                            <option value="0">Giảm</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Đơn giá</label>
                        <input type="number" name="unit_price" min="0" value="{{ old('unit_price') }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Mã tham chiếu</label>
                        <input type="text" name="reference" value="{{ old('reference') }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Ghi chú</label>
                        <textarea name="notes" rows="4" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('transactions.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700">Hủy</a>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
