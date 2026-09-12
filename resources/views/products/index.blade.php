<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Sản phẩm</h2>
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Thêm sản phẩm</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-600 text-white">✓</span>{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 flex items-center gap-3 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-rose-600 text-white">!</span>{{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Tên</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">SKU</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Danh mục</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Tồn kho</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase text-slate-500">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-6 py-4 font-medium text-slate-800">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $product->sku }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $product->category->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $product->quantity }} {{ $product->unit }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:underline">Sửa</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Xác nhận xóa sản phẩm?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">Chưa có sản phẩm nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
