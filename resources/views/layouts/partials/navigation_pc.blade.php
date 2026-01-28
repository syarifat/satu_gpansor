<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 relative shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <div class="font-black text-emerald-700 text-2xl tracking-tighter uppercase">Satu <span class="text-slate-800">Ansor</span></div>
                    </a>
                </div>
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 lg:flex items-center">
                    <x-nav-link :href="route('admin_pc.dashboard')" :active="request()->routeIs('admin_pc.dashboard')">Dashboard</x-nav-link>
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition {{ request()->routeIs('admin_pc.unit-organisasi.*') || request()->routeIs('admin_pc.jabatan.*') || request()->routeIs('admin_pc.index-surat.*') ? 'border-emerald-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                                <div>Master Data</div>
                                <div class="ms-1"><svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg></div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin_pc.unit-organisasi.index')">🏢 Unit Organisasi</x-dropdown-link>
                            <x-dropdown-link :href="route('admin_pc.jabatan.index')">👔 Jabatan</x-dropdown-link>
                            <x-dropdown-link :href="route('admin_pc.index-surat.index')">📑 Index Surat</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    
                    <x-nav-link :href="route('admin_pc.anggota.index')" :active="request()->routeIs('admin_pc.anggota.*')">Database Anggota</x-nav-link>

                    <x-dropdown align="left" width="48">
                         <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition text-gray-500 hover:text-gray-700 border-transparent">
                                <div>Administrasi</div>
                                <div class="ms-1"><svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg></div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin_pc.surat.index')">{{ __('📩 Approval Surat') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('admin_pc.agenda.index')">{{ __('📅 Monitoring Agenda') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

             <div class="hidden lg:flex sm:items-center sm:ms-6">
                <div class="flex flex-col items-end mr-3">
                    <span class="text-xs font-black text-emerald-600 uppercase">{{ Auth::user()->nama }}</span>
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Admin PC</span>
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="w-10 h-10 rounded-full bg-emerald-700 flex items-center justify-center text-white font-black text-sm uppercase">
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
                <button @click="open = true" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" class="relative z-50 lg:hidden" aria-modal="true">
        <div x-show="open" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900/80" 
             @click="open = false"></div>

        <div class="fixed inset-0 flex">
            <div x-show="open" 
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                
                <div class="flex items-center justify-between px-4 pb-4 border-b border-gray-100">
                    <span class="text-lg font-black text-emerald-700 uppercase">Menu PC</span>
                    <button type="button" class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-50 hover:text-gray-500" @click="open = false">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <div class="mt-4 px-4 space-y-1">
                    <x-responsive-nav-link :href="route('admin_pc.dashboard')" :active="request()->routeIs('admin_pc.dashboard')">Dashboard</x-responsive-nav-link>
                    
                    <div class="pt-4 pb-1">
                        <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Master Data</p>
                        <x-responsive-nav-link :href="route('admin_pc.unit-organisasi.index')" :active="request()->routeIs('admin_pc.unit-organisasi.*')">🏢 Unit Organisasi</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin_pc.jabatan.index')" :active="request()->routeIs('admin_pc.jabatan.*')">👔 Jabatan</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin_pc.index-surat.index')" :active="request()->routeIs('admin_pc.index-surat.*')">📑 Index Surat</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin_pc.anggota.index')" :active="request()->routeIs('admin_pc.anggota.*')">👥 Database Anggota</x-responsive-nav-link>
                    </div>

                    <div class="pt-2 pb-1">
                        <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Administrasi</p>
                        <x-responsive-nav-link :href="route('admin_pc.surat.index')" :active="request()->routeIs('admin_pc.surat.*')">📩 Approval Surat</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin_pc.agenda.index')" :active="request()->routeIs('admin_pc.agenda.*')">📅 Monitoring Agenda</x-responsive-nav-link>
                    </div>

                    <div class="border-t border-gray-100 my-4"></div>
                    <x-responsive-nav-link :href="route('profile.edit')">⚙️ Profile Settings</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 font-bold">🚪 Log Out</x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>