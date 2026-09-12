<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Phiếu kho</p>
            <h2 class="text-2xl font-bold leading-tight text-slate-900">Tạo phiếu nhập kho</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <form method="POST" action="{{ route('transactions.import.store') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Sản phẩm <span class="text-rose-600">*</span></label>
                            <select name="product_id" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                                <option value="">-- Chọn sản phẩm --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} ({{ $product->sku }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Nhà cung cấp <span class="text-rose-600">*</span></label>
                            <select name="supplier_id" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                                <option value="">-- Chọn nhà cung cấp --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Số lượng <span class="text-rose-600">*</span></label>
                            <input type="number" name="quantity" min="1" value="{{ old('quantity', 1) }}" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Đơn giá</label>
                            <input type="number" name="unit_price" min="0" value="{{ old('unit_price') }}" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Ghi chú</label>
                            <textarea name="notes" rows="4" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('transactions.index') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Hủy</a>
                        <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">Lưu phiếu nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
