<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-7 text-center">
            <p class="text-sm font-medium text-cyan-700">Bắt đầu ngay</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Tạo tài khoản</h1>
            <p class="mt-2 text-sm text-slate-500">Đăng ký để quản lý vật tư y tế tập trung.</p>
        </div>

        <div>
            <x-input-label for="name" value="Tên" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Mật khẩu" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Xác nhận mật khẩu" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm font-medium text-cyan-700 hover:text-cyan-900" href="{{ route('login') }}">
                Đã có tài khoản?
            </a>

            <x-primary-button class="ms-4 bg-cyan-700 hover:bg-cyan-800 focus:bg-cyan-800 active:bg-cyan-900">
                Đăng ký
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
