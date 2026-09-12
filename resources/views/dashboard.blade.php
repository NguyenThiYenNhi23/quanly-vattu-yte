<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            Tổng quan
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-8">
                <div class="rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 p-6 text-white shadow">
                    <p class="text-sm opacity-80">Danh mục</p>
                    <h3 class="mt-3 text-3xl font-bold">{{ $totalCategories }}</h3>
                </div>
                <div class="rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 p-6 text-white shadow">
                    <p class="text-sm opacity-80">Nhà cung cấp</p>
                    <h3 class="mt-3 text-3xl font-bold">{{ $totalSuppliers }}</h3>
                </div>
                <a href="{{ route('customers.index') }}" class="rounded-2xl bg-gradient-to-br from-cyan-500 to-cyan-700 p-6 text-white shadow transition hover:-translate-y-0.5 hover:shadow-lg">
                    <p class="text-sm opacity-80">Khách hàng</p>
                    <h3 class="mt-3 text-3xl font-bold">{{ $totalCustomers }}</h3>
                    <p class="mt-3 text-xs font-medium opacity-80">Quản lý danh bạ →</p>
                </a>
                <div class="rounded-2xl bg-gradient-to-br from-violet-500 to-violet-700 p-6 text-white shadow">
                    <p class="text-sm opacity-80">Sản phẩm</p>
                    <h3 class="mt-3 text-3xl font-bold">{{ $totalProducts }}</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-slate-800">Sản phẩm sắp hết</h3>
                        <span class="text-sm text-slate-500">Ngưỡng cảnh báo</span>
                    </div>
                    <div class="space-y-4">
                        @forelse ($lowStockProducts as $product)
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 p-3">
                                <div>
                                    <p class="font-medium text-slate-800">{{ $product->name }}</p>
                                    <p class="text-sm text-slate-500">{{ $product->category->name ?? 'Chưa phân loại' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-amber-600">{{ $product->quantity }}</p>
                                    <p class="text-xs text-slate-500">Mức tối thiểu: {{ $product->reorder_level }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-500">Không có sản phẩm nào sắp hết.</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-slate-800">Giao dịch gần đây</h3>
                        <a href="{{ route('transactions.index') }}" class="text-sm text-indigo-600 hover:underline">Xem tất cả</a>
                    </div>
                    <div class="space-y-3">
                        @forelse ($recentTransactions as $transaction)
                            <div class="flex items-center justify-between border-b pb-2 last:border-0 last:pb-0">
                                <div>
                                    <p class="font-medium text-slate-800">{{ $transaction->product->name ?? 'Sản phẩm' }}</p>
                                    <p class="text-sm text-slate-500">{{ ucfirst($transaction->type) }} • {{ $transaction->reference ?? 'N/A' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold {{ $transaction->quantity > 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                        {{ $transaction->quantity > 0 ? '+' : '' }}{{ $transaction->quantity }}
                                    </p>
                                    <p class="text-xs text-slate-400">{{ $transaction->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-500">Chưa có giao dịch nào.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
