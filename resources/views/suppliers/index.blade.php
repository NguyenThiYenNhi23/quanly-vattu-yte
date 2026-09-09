<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Nhà cung cấp</h2>
            <a href="{{ route('suppliers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Thêm nhà cung cấp</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Tên</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Liên hệ</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Điện thoại</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Email</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase text-slate-500">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td class="px-6 py-4 font-medium text-slate-800">{{ $supplier->name }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $supplier->contact_name }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $supplier->phone }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $supplier->email }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('suppliers.edit', $supplier) }}" class="text-indigo-600 hover:underline">Sửa</a>
                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline-block" onsubmit="return confirm('Xác nhận xóa nhà cung cấp?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">Chưa có nhà cung cấp nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
