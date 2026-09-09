<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Danh mục</h2>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Thêm danh mục</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Tên</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Mô tả</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase text-slate-500">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($categories as $category)
                            <tr>
                                <td class="px-6 py-4 font-medium text-slate-800">{{ $category->name }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $category->description ?? '—' }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:underline">Sửa</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Xác nhận xóa danh mục?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-slate-500">Chưa có danh mục nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
