<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 relative shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin_pac.dashboard') }}">
                        <div class="font-black text-indigo-700 text-2xl tracking-tighter uppercase">
                            Satu <span class="text-slate-800">Ansor</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-6 sm:-my-px sm:ms-10 lg:flex items-center">
                    
                    <x-nav-link :href="route('admin_pac.dashboard')" :active="request()->routeIs('admin_pac.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition {{ request()->routeIs('admin_pac.ranting.*') || request()->routeIs('admin_pac.anggota.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                                <div>{{ __('Master Data') }}</div>
                                <div class="ms-1"><svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg></div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin_pac.ranting.index')">🏢 Pimpinan Ranting</x-dropdown-link>
                            <x-dropdown-link :href="route('admin_pac.anggota.index')">👥 Data Anggota</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition {{ request()->routeIs('admin_pac.surat.*') || request()->routeIs('admin_pac.agenda.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                                <div>{{ __('Administrasi') }}</div>
                                <div class="ms-1"><svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg></div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin_pac.surat.index')">📩 Pengajuan Surat</x-dropdown-link>
                            <x-dropdown-link :href="route('admin_pac.agenda.index')">📅 Agenda Kegiatan</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                </div>
            </div>

            <div class="hidden lg:flex sm:items-center sm:ms-6">
                <div class="flex flex-col items-end mr-3">
                    <span class="text-xs font-black text-indigo-600 uppercase">{{ Auth::user()->nama }}</span>
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Admin PAC (Kecamatan)</span>
                </div>
                
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="w-10 h-10 rounded-full bg-indigo-700 flex items-center justify-center text-white font-black text-sm uppercase hover:bg-indigo-800 transition-colors shadow-md shadow-indigo-200">
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
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" d="M4 6h16M4 12h16M4 18h16" /><path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-white border-t border-gray-100 shadow-inner">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin_pac.dashboard')" :active="request()->routeIs('admin_pac.dashboard')">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin_pac.anggota.index')" :active="request()->routeIs('admin_pac.anggota.*')">Data Anggota</x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 font-bold">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>