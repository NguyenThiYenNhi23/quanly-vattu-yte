<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-cyan-700">Danh bạ đối tác</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Khách hàng</h2>
            </div>
            <a href="{{ route('customers.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:ring-offset-2">
                <span class="text-lg leading-none">+</span> Thêm khách hàng
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-600 text-white">✓</span>{{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col gap-4 border-b border-slate-100 bg-slate-50/70 px-6 py-5 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h3 class="font-semibold text-slate-900">Danh sách khách hàng</h3>
                        <p class="mt-1 text-sm text-slate-500">{{ $customers->total() }} khách hàng trong hệ thống</p>
                    </div>
                    <form method="GET" action="{{ route('customers.index') }}" class="flex w-full gap-2 lg:w-auto">
                        <input type="search" name="search" value="{{ $search }}" placeholder="Tìm tên, SĐT hoặc email..." class="w-full rounded-xl border-slate-300 bg-white px-4 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-cyan-600 focus:ring-cyan-600 lg:w-80">
                        <button type="submit" class="rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Tìm</button>
                    </form>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse ($customers as $customer)
                        <div class="flex flex-col gap-4 px-6 py-5 transition hover:bg-cyan-50/30 md:flex-row md:items-center md:justify-between">
                            <div class="flex min-w-0 items-center gap-4">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-cyan-100 text-sm font-bold text-cyan-800">{{ mb_strtoupper(mb_substr($customer->name, 0, 1)) }}</div>
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-slate-900">{{ $customer->name }}</p>
                                    <p class="mt-1 truncate text-sm text-slate-500">{{ $customer->address ?: 'Chưa cập nhật địa chỉ' }}</p>
                                </div>
                            </div>
                            <div class="grid gap-2 text-sm sm:grid-cols-2 md:w-[23rem]">
                                <a href="tel:{{ $customer->phone }}" class="font-medium text-slate-700 transition hover:text-cyan-700">{{ $customer->phone }}</a>
                                @if ($customer->email)
                                    <a href="mailto:{{ $customer->email }}" class="truncate text-slate-500 transition hover:text-cyan-700">{{ $customer->email }}</a>
                                @else
                                    <span class="text-slate-400">Chưa có email</span>
                                @endif
                            </div>
                            <div class="flex shrink-0 items-center gap-2">
                                <a href="{{ route('customers.edit', $customer) }}" class="rounded-lg px-3 py-2 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">Chỉnh sửa</a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa khách hàng này?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-lg px-3 py-2 text-sm font-semibold text-rose-600 transition hover:bg-rose-50">Xóa</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-16 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-100 text-2xl text-cyan-700">♙</div>
                            <h3 class="mt-4 font-semibold text-slate-900">{{ $search ? 'Không tìm thấy khách hàng phù hợp' : 'Chưa có khách hàng nào' }}</h3>
                            <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-500">{{ $search ? 'Thử lại với tên, số điện thoại hoặc email khác.' : 'Bắt đầu xây dựng danh bạ khách hàng để chăm sóc và phục vụ tốt hơn.' }}</p>
                            @if (! $search)
                                <a href="{{ route('customers.create') }}" class="mt-5 inline-flex rounded-xl bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-cyan-800">Thêm khách hàng đầu tiên</a>
                            @endif
                        </div>
                    @endforelse
                </div>

                @if ($customers->hasPages())
                    <div class="border-t border-slate-100 px-6 py-4">{{ $customers->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
