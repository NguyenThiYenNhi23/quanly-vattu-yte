<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-700">Phiếu kho</p>
            <h2 class="text-2xl font-bold leading-tight text-slate-900">Tạo phiếu nhập/xuất</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <form method="POST" action="{{ route('transactions.store') }}" class="space-y-6">
                    @csrf

                    @include('transactions.partials.form')

                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('transactions.index') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Hủy</a>
                        <button type="submit" class="rounded-xl bg-cyan-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700">Lưu phiếu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
