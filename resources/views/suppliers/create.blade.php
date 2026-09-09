<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Thêm nhà cung cấp</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <form method="POST" action="{{ route('suppliers.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Tên nhà cung cấp</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Người liên hệ</label>
                        <input type="text" name="contact_name" value="{{ old('contact_name') }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Điện thoại</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Địa chỉ</label>
                        <textarea name="address" rows="4" class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('address') }}</textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('suppliers.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700">Hủy</a>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
