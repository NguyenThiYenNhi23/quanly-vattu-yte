<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Giao dịch kho</h2>
            <a href="{{ route('transactions.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Tạo giao dịch</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Loại</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Số lượng</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Tham chiếu</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Ngày</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td class="px-6 py-4 font-medium text-slate-800">{{ $transaction->product->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ ucfirst($transaction->type) }}</td>
                                <td class="px-6 py-4 {{ $transaction->quantity > 0 ? 'text-emerald-600' : 'text-red-600' }} font-semibold">
                                    {{ $transaction->quantity > 0 ? '+' : '' }}{{ $transaction->quantity }}
                                </td>
                                <td class="px-6 py-4 text-slate-600">{{ $transaction->reference ?? '—' }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">Chưa có giao dịch kho nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
