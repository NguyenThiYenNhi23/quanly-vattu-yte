<nav x-data="{ open: false }" class="sticky top-0 z-30 border-b border-sky-100/80 bg-white/85 shadow-[0_10px_30px_rgba(14,116,144,0.08)] backdrop-blur-xl">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 justify-between">
            <div class="flex items-center gap-4">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-slate-800">
                        <span class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-lg shadow-cyan-200/80 ring-4 ring-white">
                            <svg viewBox="0 0 280 280" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" aria-hidden="true">
                                <defs>
                                    <linearGradient id="navBlue" x1="0" x2="1" y1="0" y2="1">
                                        <stop offset="0%" stop-color="#1cd8ff"/>
                                        <stop offset="100%" stop-color="#0a70d8"/>
                                    </linearGradient>
                                    <linearGradient id="navGreen" x1="0" x2="1" y1="0" y2="1">
                                        <stop offset="0%" stop-color="#12d775"/>
                                        <stop offset="100%" stop-color="#0f9d5e"/>
                                    </linearGradient>
                                </defs>
                                <path d="M140 26c-22 0-42 14-52 34-9-20-30-34-52-34C18 26 0 44 0 66c0 24 16 39 36 56l67 58 67-58c20-17 36-32 36-56 0-22-18-40-40-40-22 0-42 14-52 34-10-20-30-34-52-34Z" fill="url(#navBlue)"/>
                                <g transform="translate(140 140)">
                                    <rect x="-18" y="-54" width="36" height="108" rx="12" fill="#ef7d00"/>
                                    <rect x="-54" y="-18" width="108" height="36" rx="12" fill="#ef7d00"/>
                                </g>
                                <path d="M36 220c13-21 31-35 56-41 13-4 25-5 38-2 5 1 9 3 13 6l-16 44h-91Z" fill="url(#navGreen)"/>
                                <path d="M244 220c-13-21-31-35-56-41-13-4-25-5-38-2-5 1-9 3-13 6l16 44h91Z" fill="url(#navBlue)"/>
                            </svg>
                        </span>
                        <span class="hidden lg:block">
                            <span class="block text-[1.02rem] font-black leading-4 tracking-tight text-slate-900">Vật tư</span>
                            <span class="mt-1 block text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-cyan-700">Y tế thông minh</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden items-center gap-1 sm:-my-px sm:ms-2 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Tổng quan
                    </x-nav-link>
                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">Danh mục</x-nav-link>
                    <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">Nhà cung cấp</x-nav-link>
                    <x-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')">Khách hàng</x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">Sản phẩm</x-nav-link>
                    <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">Nhập xuất</x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 rounded-full border border-sky-200 bg-gradient-to-r from-sky-50 to-cyan-50 px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-sky-300 hover:text-sky-700 focus:outline-none">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-emerald-400 to-cyan-500 text-xs font-bold text-white">{{ Str::upper(Str::substr(Auth::user()->name, 0, 1)) }}</span>
                            <span>{{ Auth::user()->name }}</span>

                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Hồ sơ
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                Đăng xuất
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-xl border border-sky-200 bg-sky-50 p-2.5 text-sky-700 transition hover:bg-sky-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-sky-100 bg-white/95 sm:hidden">
        <div class="space-y-1 px-3 py-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Tổng quan
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">Danh mục</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">Nhà cung cấp</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')">Khách hàng</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">Sản phẩm</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">Nhập xuất</x-responsive-nav-link>
        </div>

        <div class="border-t border-slate-200 bg-slate-50 px-4 py-4">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-emerald-400 to-cyan-500 text-sm font-bold text-white">{{ Str::upper(Str::substr(Auth::user()->name, 0, 1)) }}</span>
                <div>
                    <div class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Hồ sơ
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Đăng xuất
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
