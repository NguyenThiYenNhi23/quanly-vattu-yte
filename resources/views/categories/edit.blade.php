<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Sửa danh mục</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Tên danh mục</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Mô tả</label>
                        <textarea name="description" rows="4" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $category->description) }}</textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700">Hủy</a>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
