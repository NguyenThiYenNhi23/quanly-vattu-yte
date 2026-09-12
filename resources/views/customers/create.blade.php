<x-app-layout>
    <x-slot name="header"><div><p class="text-sm font-medium text-cyan-700">Danh bạ đối tác</p><h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Thêm khách hàng</h2></div></x-slot>
    <div class="py-8"><div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8"><div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 bg-gradient-to-r from-cyan-50 to-white px-6 py-5"><h3 class="font-semibold text-slate-900">Thông tin liên hệ</h3><p class="mt-1 text-sm text-slate-500">Các trường có dấu * là bắt buộc.</p></div>
        <form method="POST" action="{{ route('customers.store') }}" class="space-y-6 p-6">@csrf @include('customers.partials.form') @include('customers.partials.actions', ['label' => 'Lưu khách hàng'])</form>
    </div></div></div>
</x-app-layout>
