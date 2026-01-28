<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 relative shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('anggota.dashboard') }}">
                        <div class="font-black text-emerald-700 text-2xl tracking-tighter uppercase">
                            Satu <span class="text-slate-800">Ansor</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-6 sm:-my-px sm:ms-10 lg:flex items-center">
                    <x-nav-link :href="route('anggota.dashboard')" :active="request()->routeIs('anggota.dashboard')">
                        {{ __('KTA Digital') }}
                    </x-nav-link>

                    {{-- jika perlu dropdown / item lain, tambahkan di sini agar konsisten dengan style PC --}}
                </div>
            </div>

            <div class="hidden lg:flex sm:items-center sm:ms-6">
                <div class="flex flex-col items-end mr-3">
                    <span class="text-xs font-black text-emerald-600 uppercase">{{ Auth::user()->nama }}</span>
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Kader Ansor</span>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="w-10 h-10 rounded-full bg-emerald-700 flex items-center justify-center text-white font-black text-sm uppercase hover:bg-emerald-800 transition-colors shadow-md shadow-emerald-200">
                            {{ substr(Auth::user()->nama, 0, 1) }}
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">⚙️ Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 font-bold">🚪 Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-white border-t border-gray-100 shadow-inner">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('anggota.dashboard')" :active="request()->routeIs('anggota.dashboard')">Dashboard Anggota</x-responsive-nav-link>
            {{-- Tambahkan link mobile lain jika diperlukan --}}
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profile Settings</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 font-bold">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>