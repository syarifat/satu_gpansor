<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Database Anggota Se-Tulungagung') }}
        </h2>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- 1. Filter & Search Card --}}
            <div class="p-6 bg-white shadow-xl rounded-[2.5rem] border border-gray-100">
                <form action="{{ route('admin_pc.anggota.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <x-input-label value="Cari Nama atau NIK" class="text-[10px] font-black uppercase text-slate-400 mb-1 ml-2" />
                        <x-text-input name="search" value="{{ request('search') }}" class="w-full rounded-2xl border-gray-100 bg-slate-50" placeholder="Ketik nama anggota..." />
                    </div>
                    <div>
                        <x-input-label value="Filter PAC" class="text-[10px] font-black uppercase text-slate-400 mb-1 ml-2" />
                        <select name="unit_id" class="w-full rounded-2xl border-gray-100 bg-slate-50 text-sm font-bold focus:ring-emerald-500">
                            <option value="">Semua PAC</option>
                            @foreach($pacs as $pac)
                            <option value="{{ $pac->id }}" {{ request('unit_id') == $pac->id ? 'selected' : '' }}>{{ $pac->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <x-primary-button class="w-full justify-center py-3 bg-slate-800 rounded-2xl">
                            🔍 Cari Data
                        </x-primary-button>
                    </div>
                </form>
            </div>

            {{-- 2. Table Card --}}
            <div class="bg-white shadow-xl rounded-[2.5rem] overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-[0.2em]">
                                <th class="px-8 py-5 border-b border-slate-100">Anggota</th>
                                <th class="px-6 py-5 border-b border-slate-100 text-center">Jabatan</th>
                                <th class="px-6 py-5 border-b border-slate-100">Unit Organisasi</th>
                                <th class="px-8 py-5 border-b border-slate-100 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($anggotas as $agt)
                            <tr class="hover:bg-slate-50/60 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-700 font-black">
                                            {{ substr($agt->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-black text-slate-800 text-sm group-hover:text-emerald-700">{{ $agt->nama }}</div>
                                            <div class="text-[10px] text-slate-400 font-bold uppercase">NIK: {{ $agt->nik }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black rounded-lg uppercase tracking-widest border border-indigo-100">
                                        {{ $agt->jabatan->nama ?? 'Anggota' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-xs font-bold text-slate-600">{{ $agt->organisasiUnit->nama }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium italic capitalize">{{ $agt->organisasiUnit->level }}</div>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <div class="flex flex-col gap-2">
                                        <a href="{{ route('admin_pc.anggota.show', $agt->id) }}" class="inline-block p-2 bg-slate-100 text-slate-600 rounded-xl hover:bg-emerald-700 hover:text-white transition-all shadow-sm">
                                            👁️ Lihat Detail
                                        </a>

                                        @if($agt->user->role === 'admin_pac' || $agt->user->role === 'admin_pr')
                                        <form action="{{ route('admin_pc.anggota.demote', $agt->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mencabut akses admin dari anggota ini?');">
                                            @csrf
                                            <button type="submit" class="w-full px-3 py-2 bg-rose-100 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all text-[10px] font-bold uppercase tracking-wide">
                                                🚫 Copot Admin
                                            </button>
                                        </form>
                                        @elseif($agt->organisasiUnit->level !== 'pc')
                                        <form action="{{ route('admin_pc.anggota.promote', $agt->id) }}" method="POST" onsubmit="return confirm('Jadikan anggota ini sebagai Admin Unit {{ $agt->organisasiUnit->nama }}?');">
                                            @csrf
                                            <button type="submit" class="w-full px-3 py-2 bg-sky-100 text-sky-600 rounded-xl hover:bg-sky-600 hover:text-white transition-all text-[10px] font-bold uppercase tracking-wide">
                                                ⭐ Jadikan Admin
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-slate-50 border-t border-slate-100">
                    {{ $anggotas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>