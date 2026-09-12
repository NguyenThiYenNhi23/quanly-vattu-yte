<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"><div><p class="text-sm font-medium text-violet-700">Thiết lập kho</p><h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Danh mục</h2></div><a href="{{ route('categories.create') }}" class="rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 px-4 py-2.5 text-center text-sm font-semibold text-white shadow-md shadow-violet-200 transition hover:from-violet-700 hover:to-indigo-700">+ Thêm danh mục</a></div>
    </x-slot>
    <div class="py-8"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
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

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-4 border-b border-slate-100 bg-violet-50/60 px-6 py-5 lg:flex-row lg:items-center lg:justify-between"><div><h3 class="font-semibold text-slate-900">Danh sách danh mục</h3><p class="mt-1 text-sm text-slate-500">{{ $categories->total() }} danh mục đang sử dụng</p></div><form method="GET" class="flex w-full gap-2 lg:w-auto"><input type="search" name="search" value="{{ $search }}" placeholder="Tìm tên hoặc mô tả..." class="w-full rounded-xl border-slate-300 bg-white px-4 py-2 text-sm shadow-sm focus:border-violet-600 focus:ring-violet-600 lg:w-80"><button class="rounded-xl bg-white px-4 py-2 text-sm font-semibold text-violet-700 shadow-sm ring-1 ring-violet-200 transition hover:bg-violet-100">Tìm</button></form></div>
        <div class="overflow-x-auto"><table class="min-w-full divide-y divide-slate-100"><thead class="bg-slate-50/80"><tr><th class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Tên danh mục</th><th class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Mô tả</th><th class="px-6 py-3.5 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Thao tác</th></tr></thead><tbody class="divide-y divide-slate-100">@forelse ($categories as $category)<tr class="transition hover:bg-violet-50/40"><td class="px-6 py-4 font-semibold text-slate-800">{{ $category->name }}</td><td class="max-w-xl px-6 py-4 text-sm text-slate-600">{{ $category->description ?? '—' }}</td><td class="px-6 py-4 text-right"><a href="{{ route('categories.edit', $category) }}" class="rounded-lg px-3 py-2 text-sm font-semibold text-violet-700 hover:bg-violet-100">Sửa</a><form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Xác nhận xóa danh mục?')">@csrf @method('DELETE')<button class="rounded-lg px-3 py-2 text-sm font-semibold text-rose-600 hover:bg-rose-50">Xóa</button></form></td></tr>@empty<tr><td colspan="3" class="px-6 py-14 text-center text-sm text-slate-500">{{ $search ? 'Không tìm thấy danh mục phù hợp.' : 'Chưa có danh mục nào.' }}</td></tr>@endforelse</tbody></table></div>
        @if ($categories->hasPages())<div class="border-t border-slate-100 px-6 py-4">{{ $categories->links() }}</div>@endif
    </div></div></div>
</x-app-layout>
