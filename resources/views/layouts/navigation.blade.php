<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin_pc.dashboard') }}">
                        <div class="font-black text-emerald-700 text-xl tracking-tighter">SATU <span class="text-slate-800">ANSOR</span></div>
                    </a>
                </div>

                <div class="hidden space-x-6 sm:-my-px sm:ms-10 lg:flex items-center">
                    <x-nav-link :href="route('admin_pc.dashboard')" :active="request()->routeIs('admin_pc.dashboard')">Dashboard</x-nav-link>

                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold transition {{ request()->routeIs('admin_pc.unit-organisasi.*') ? 'border-emerald-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                                <div>Master Organisasi</div>
                                <div class="ms-1"><svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg></div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin_pc.unit-organisasi.index')">🏢 PAC & Ranting</x-dropdown-link>
                            <x-dropdown-link :href="route('admin_pc.dashboard')">👔 Master Jabatan</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <x-nav-link :href="route('admin_pc.dashboard')" :active="request()->routeIs('admin_pc.anggota.*')">Database Anggota</x-nav-link>
                </div>
            </div>

            <div class="hidden lg:flex sm:items-center sm:ms-6">
                <span class="text-xs font-bold text-gray-400 mr-3 uppercase">{{ Auth::user()->role }}</span>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-bold rounded-md text-gray-500 bg-white hover:text-gray-700 transition">
                            <div>{{ Auth::user()->nama }}</div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>