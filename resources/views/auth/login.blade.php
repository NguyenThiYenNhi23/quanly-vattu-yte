<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-7 text-center">
            <p class="text-sm font-medium text-cyan-700">Chào mừng trở lại</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Đăng nhập tài khoản</h1>
            <p class="mt-2 text-sm text-slate-500">Truy cập hệ thống quản lý kho của bạn.</p>
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Mật khẩu" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ghi nhớ đăng nhập</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    Quên mật khẩu?
                </a>
            @endif

            <a class="text-sm font-medium text-cyan-700 hover:text-cyan-900" href="{{ route('register') }}">
                Đăng ký tài khoản
            </a>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3 bg-cyan-700 hover:bg-cyan-800 focus:bg-cyan-800 active:bg-cyan-900">
                Đăng nhập
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
