<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peta Profesi & Pekerjaan Kader') }}
        </h2>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            {{-- 1. STATISTIK CARD (Top 5 Pekerjaan) --}}
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                @foreach($topJobs as $job)
                <div class="bg-white p-4 rounded-3xl shadow-md border border-gray-50 flex flex-col items-center text-center hover:scale-105 transition-transform">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-black mb-2">
                        {{ $loop->iteration }}
                    </div>
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Profesi</h3>
                    <p class="font-bold text-slate-800 text-sm line-clamp-1" title="{{ $job->job_title }}">{{ $job->job_title }}</p>
                    <span class="mt-2 px-3 py-1 bg-emerald-50 text-emerald-600 text-xs font-black rounded-lg">
                        {{ $job->total }} Orang
                    </span>
                </div>
                @endforeach
            </div>

            {{-- 2. FILTER & SEARCH --}}
            <div class="p-6 bg-white shadow-xl rounded-[2.5rem] border border-gray-100">
                <form action="{{ route('admin_pc.pekerjaan.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <x-input-label value="Cari Nama Anggota / Pekerjaan" class="text-[10px] font-black uppercase text-slate-400 mb-1 ml-2" />
                        <x-text-input name="search" value="{{ request('search') }}" class="w-full rounded-2xl border-gray-100 bg-slate-50" placeholder="Contoh: Guru, Petani..." />
                    </div>
                    <div>
                        <x-input-label value="Filter Spesifik" class="text-[10px] font-black uppercase text-slate-400 mb-1 ml-2" />
                        <select name="job_title" class="w-full rounded-2xl border-gray-100 bg-slate-50 text-sm font-bold focus:ring-emerald-500 text-slate-700">
                            <option value="">Semua Profesi</option>
                            @foreach($allJobs as $j)
                                <option value="{{ $j }}" {{ request('job_title') == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <x-primary-button class="w-full justify-center py-3 bg-indigo-700 hover:bg-indigo-800 rounded-2xl">
                            🔍 Filter Data
                        </x-primary-button>
                    </div>
                </form>
            </div>

            {{-- 3. TABEL DATA --}}
            <div class="bg-white shadow-xl rounded-[2.5rem] overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-[0.2em]">
                                <th class="px-8 py-5 border-b border-slate-100">Anggota</th>
                                <th class="px-6 py-5 border-b border-slate-100">Profesi / Pekerjaan</th>
                                <th class="px-6 py-5 border-b border-slate-100">Lokasi Kerja</th>
                                <th class="px-6 py-5 border-b border-slate-100">Asal Unit</th>
                                <th class="px-8 py-5 border-b border-slate-100 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($anggotas as $agt)
                            <tr class="hover:bg-slate-50/60 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="font-black text-slate-800 text-sm group-hover:text-indigo-700">{{ $agt->nama }}</div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase">NIK: {{ $agt->nik }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <span class="font-bold text-slate-700">{{ $agt->job_title }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-xs font-medium text-slate-500">{{ $agt->job_address ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-lg uppercase">
                                        {{ $agt->organisasiUnit->nama }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <a href="{{ route('admin_pc.anggota.show', $agt->id) }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-black uppercase tracking-wider">
                                        Lihat Profil &rarr;
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-10 text-center text-slate-400 font-bold">
                                    Belum ada data pekerjaan yang tercatat.
                                </td>
                            </tr>
                            @endforelse
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