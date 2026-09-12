<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-700">Quản lý kho</p>
                <h2 class="text-2xl font-bold leading-tight text-slate-900">Nhập xuất vật tư</h2>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('transactions.import.create') }}" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    + Phiếu nhập kho
                </a>
                <a href="{{ route('transactions.export.create') }}" class="inline-flex items-center justify-center rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700">
                    + Phiếu xuất kho
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-4 flex flex-wrap gap-2">
                    <a href="{{ route('transactions.index', ['type' => '']) }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ $type === '' ? 'bg-slate-900 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Tất cả
                    </a>
                    <a href="{{ route('transactions.index', ['type' => 'import']) }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ $type === 'import' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                        Nhập kho
                    </a>
                    <a href="{{ route('transactions.index', ['type' => 'export']) }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ $type === 'export' ? 'bg-rose-600 text-white shadow-sm' : 'bg-rose-50 text-rose-700 hover:bg-rose-100' }}">
                        Xuất kho
                    </a>
                </div>

                <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-col gap-3 md:flex-row md:items-center">
                    <div class="flex-1">
                        <input type="search" name="search" value="{{ $search }}" placeholder="Tìm sản phẩm, mã phiếu, nhà cung cấp, khách hàng..." class="w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 shadow-sm focus:border-cyan-600 focus:ring-cyan-600">
                    </div>
                    <input type="hidden" name="type" value="{{ $type }}">
                    <button type="submit" class="rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                        Lọc
                    </button>
                </form>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Loại</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Đối tác</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Số lượng</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Tham chiếu</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Ngày</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td class="px-6 py-4 font-semibold text-slate-800">{{ $transaction->product->name ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold
                                        @if ($transaction->type === 'import') bg-emerald-100 text-emerald-700
                                        @elseif ($transaction->type === 'export') bg-rose-100 text-rose-700
                                        @else bg-amber-100 text-amber-700 @endif">
                                        {{ $transaction->type === 'import' ? 'Nhập kho' : ($transaction->type === 'export' ? 'Xuất kho' : 'Điều chỉnh') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $transaction->supplier?->name ?? $transaction->customer?->name ?? '—' }}
                                </td>
                                <td class="px-6 py-4 font-bold {{ $transaction->quantity > 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                    {{ $transaction->quantity > 0 ? '+' : '' }}{{ $transaction->quantity }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $transaction->reference ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('transactions.show', $transaction) }}" class="inline-flex items-center rounded-lg bg-cyan-50 px-3 py-2 text-xs font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                        Xem chi tiết
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-500">Chưa có giao dịch kho nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($transactions->hasPages())
                <div class="mt-6">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
