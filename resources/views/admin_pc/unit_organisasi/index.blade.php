<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pimpinan Organisasi (PAC & PR)') }}
        </h2>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            {{-- Action Header --}}
            <div class="p-6 bg-white shadow-xl rounded-[2.5rem] border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight">Struktur Wilayah</h3>
                    <p class="text-xs text-slate-400 font-bold">Total Terdaftar: {{ $units->total() }} Unit</p>
                </div>
                <a href="{{ route('admin_pc.unit-organisasi.create') }}" class="px-8 py-3 bg-emerald-700 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-100">
                    + Tambah Unit Baru
                </a>
            </div>

            {{-- Table Card --}}
            <div class="bg-white shadow-xl rounded-[2.5rem] overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-[0.2em]">
                                <th class="px-8 py-5 border-b border-slate-100">Nama Unit</th>
                                <th class="px-6 py-5 border-b border-slate-100">Tingkatan</th>
                                <th class="px-6 py-5 border-b border-slate-100">Induk Organisasi</th>
                                <th class="px-6 py-5 border-b border-slate-100">Wilayah</th>
                                <th class="px-8 py-5 border-b border-slate-100 text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($units as $unit)
                            <tr class="hover:bg-slate-50/60 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="font-black text-slate-800 text-sm group-hover:text-emerald-700 transition-colors">{{ $unit->nama }}</div>
                                    <div class="text-[10px] text-slate-400 font-bold mt-1 tracking-wider uppercase">ID: #{{ $unit->id }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-block px-3 py-1 {{ $unit->level == 'pac' ? 'bg-indigo-50 text-indigo-600 border-indigo-100' : 'bg-emerald-50 text-emerald-600 border-emerald-100' }} text-[10px] font-black rounded-lg uppercase tracking-widest border">
                                        {{ $unit->level }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-sm font-bold text-slate-500">
                                    {{ $unit->parent->nama ?? 'Pimpinan Cabang' }}
                                </td>
                                <td class="px-6 py-5">
                                    <div class="font-bold text-slate-600 text-xs flex items-center gap-1">
                                        <span class="text-emerald-400">📍</span> {{ $unit->kecamatan->nama ?? '-' }}
                                        @if($unit->desa) <span class="text-slate-300 mx-1">/</span> {{ $unit->desa->nama }} @endif
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <div class="flex justify-center gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin_pc.unit-organisasi.edit', $unit->id) }}" class="p-2 bg-orange-50 text-orange-500 rounded-xl hover:bg-orange-100 transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" /></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-slate-50 border-t border-slate-100">
                    {{ $units->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>