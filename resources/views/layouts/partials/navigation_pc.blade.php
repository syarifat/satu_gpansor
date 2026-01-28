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
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Admin Pimpinan Cabang</span>
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
        </div>
    </div>
</nav>