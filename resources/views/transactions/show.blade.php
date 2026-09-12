<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-700">Kho hàng</p>
                <h2 class="text-2xl font-bold text-slate-900 leading-tight">
                    @if ($inventoryTransaction->type === 'import')
                        Chi tiết phiếu nhập
                    @elseif ($inventoryTransaction->type === 'export')
                        Chi tiết phiếu xuất
                    @else
                        Chi tiết điều chỉnh kho
                    @endif
                </h2>
            </div>
            <a href="{{ route('transactions.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                Quay lại
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Mã tham chiếu</p>
                            <h3 class="mt-1 text-xl font-bold text-slate-900">{{ $inventoryTransaction->reference ?? '—' }}</h3>
                        </div>
                        <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700">
                            {{ $inventoryTransaction->type === 'import' ? 'Nhập kho' : ($inventoryTransaction->type === 'export' ? 'Xuất kho' : 'Điều chỉnh') }}
                        </span>
                    </div>
                </div>

                <div class="grid gap-6 p-6 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Sản phẩm</p>
                        <p class="mt-3 text-lg font-bold text-slate-900">{{ $inventoryTransaction->product->name ?? '—' }}</p>
                        <p class="mt-1 text-sm text-slate-600">SKU: {{ $inventoryTransaction->product->sku ?? '—' }}</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Người thực hiện</p>
                        <p class="mt-3 text-lg font-bold text-slate-900">{{ $inventoryTransaction->performed_by ?? 'Hệ thống' }}</p>
                        <p class="mt-1 text-sm text-slate-600">{{ $inventoryTransaction->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Nhà cung cấp</p>
                        @if ($inventoryTransaction->supplier)
                            <p class="mt-3 text-lg font-bold text-slate-900">{{ $inventoryTransaction->supplier->name }}</p>
                            <p class="mt-1 text-sm text-slate-600">{{ $inventoryTransaction->supplier->phone ?? '—' }}</p>
                        @else
                            <p class="mt-3 text-base text-slate-500">—</p>
                        @endif
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Khách hàng</p>
                        @if ($inventoryTransaction->customer)
                            <p class="mt-3 text-lg font-bold text-slate-900">{{ $inventoryTransaction->customer->name }}</p>
                            <p class="mt-1 text-sm text-slate-600">{{ $inventoryTransaction->customer->phone ?? '—' }}</p>
                        @else
                            <p class="mt-3 text-base text-slate-500">—</p>
                        @endif
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Số lượng</p>
                        <p class="mt-3 text-2xl font-black {{ $inventoryTransaction->quantity > 0 ? 'text-emerald-600' : 'text-red-600' }}">
                            {{ $inventoryTransaction->quantity > 0 ? '+' : '' }}{{ $inventoryTransaction->quantity }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Đơn giá</p>
                        <p class="mt-3 text-2xl font-black text-slate-900">
                            {{ number_format($inventoryTransaction->unit_price ?? 0, 0, ',', '.') }} đ
                        </p>
                    </div>
                </div>

                <div class="border-t border-slate-200 bg-white px-6 py-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Ghi chú</p>
                    <p class="mt-3 whitespace-pre-line text-slate-700">{{ $inventoryTransaction->notes ?: 'Không có ghi chú.' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
