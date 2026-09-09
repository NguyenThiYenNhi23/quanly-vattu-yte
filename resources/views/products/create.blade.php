<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Thêm sản phẩm</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <form method="POST" action="{{ route('products.store') }}" class="space-y-5">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Tên sản phẩm</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Mã SKU</label>
                            <input type="text" name="sku" value="{{ old('sku') }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Danh mục</label>
                            <select name="category_id" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Nhà cung cấp</label>
                            <select name="supplier_id" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">-- Chọn nhà cung cấp --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Đơn vị tính</label>
                            <input type="text" name="unit" value="{{ old('unit') }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Trạng thái</label>
                            <select name="status" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Ngừng</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Giá nhập</label>
                            <input type="number" name="purchase_price" value="{{ old('purchase_price') }}" min="0" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Giá bán</label>
                            <input type="number" name="selling_price" value="{{ old('selling_price') }}" min="0" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Số lượng hiện có</label>
                            <input type="number" name="quantity" value="{{ old('quantity', 0) }}" min="0" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Mức cảnh báo</label>
                            <input type="number" name="reorder_level" value="{{ old('reorder_level', 0) }}" min="0" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700">Hủy</a>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
