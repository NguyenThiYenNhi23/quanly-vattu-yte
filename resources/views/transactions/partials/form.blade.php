<div class="space-y-5">
    <div>
        <label class="block text-sm font-semibold text-slate-700">Sản phẩm <span class="text-rose-600">*</span></label>
        <select name="product_id" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-cyan-600 focus:ring-cyan-600" required>
            <option value="">-- Chọn sản phẩm --</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                    {{ $product->name }} ({{ $product->sku }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700">Loại giao dịch <span class="text-rose-600">*</span></label>
        <select name="type" id="transaction_type" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-cyan-600 focus:ring-cyan-600" required>
            <option value="import" {{ old('type') === 'import' ? 'selected' : '' }}>Nhập kho</option>
            <option value="export" {{ old('type') === 'export' ? 'selected' : '' }}>Xuất kho</option>
            <option value="adjustment" {{ old('type') === 'adjustment' ? 'selected' : '' }}>Điều chỉnh</option>
        </select>
    </div>

    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label for="supplier_id" class="block text-sm font-semibold text-slate-700">Nhà cung cấp</label>
            <select name="supplier_id" id="supplier_id" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-cyan-600 focus:ring-cyan-600">
                <option value="">-- Chọn nhà cung cấp --</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="customer_id" class="block text-sm font-semibold text-slate-700">Khách hàng</label>
            <select name="customer_id" id="customer_id" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-cyan-600 focus:ring-cyan-600">
                <option value="">-- Chọn khách hàng --</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700">Số lượng <span class="text-rose-600">*</span></label>
        <input type="number" name="quantity" min="1" value="{{ old('quantity', 1) }}" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-cyan-600 focus:ring-cyan-600" required>
    </div>

    <div id="adjustment_wrapper" class="hidden">
        <label class="block text-sm font-semibold text-slate-700">Hướng điều chỉnh</label>
        <select name="adjustment_direction" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-cyan-600 focus:ring-cyan-600">
            <option value="1">Tăng</option>
            <option value="0">Giảm</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700">Đơn giá</label>
        <input type="number" name="unit_price" min="0" value="{{ old('unit_price') }}" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-cyan-600 focus:ring-cyan-600">
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700">Mã tham chiếu</label>
        <input type="text" name="reference" value="{{ old('reference') }}" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-cyan-600 focus:ring-cyan-600">
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700">Ghi chú</label>
        <textarea name="notes" rows="4" class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-slate-900 shadow-sm focus:border-cyan-600 focus:ring-cyan-600">{{ old('notes') }}</textarea>
    </div>
</div>

<script>
    const typeSelect = document.getElementById('transaction_type');
    const supplierSelect = document.getElementById('supplier_id');
    const customerSelect = document.getElementById('customer_id');
    const adjustmentWrapper = document.getElementById('adjustment_wrapper');

    function syncTransactionForm() {
        const currentType = typeSelect.value;

        if (currentType === 'import') {
            supplierSelect.required = true;
            customerSelect.required = false;
            supplierSelect.closest('div')?.classList.remove('opacity-50');
            customerSelect.closest('div')?.classList.add('opacity-50');
            customerSelect.value = '';
        } else if (currentType === 'export') {
            customerSelect.required = true;
            supplierSelect.required = false;
            customerSelect.closest('div')?.classList.remove('opacity-50');
            supplierSelect.closest('div')?.classList.add('opacity-50');
            supplierSelect.value = '';
        } else {
            supplierSelect.required = false;
            customerSelect.required = false;
            supplierSelect.closest('div')?.classList.remove('opacity-50');
            customerSelect.closest('div')?.classList.remove('opacity-50');
        }

        adjustmentWrapper.classList.toggle('hidden', currentType !== 'adjustment');
    }

    typeSelect?.addEventListener('change', syncTransactionForm);
    syncTransactionForm();
</script>
