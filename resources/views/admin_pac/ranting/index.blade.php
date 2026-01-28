<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-xl text-slate-800 leading-tight uppercase tracking-tight">
                {{ __('Daftar Pimpinan Ranting') }}
            </h2>
            <div class="px-4 py-1.5 bg-indigo-50 text-indigo-700 rounded-full text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                Total: {{ $rantings->count() }} Ranting
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-xl rounded-[2.5rem] overflow-hidden border border-gray-100">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-[0.2em]">
                            <th class="px-8 py-5 border-b border-slate-100">Nama Ranting (PR)</th>
                            <th class="px-6 py-5 border-b border-slate-100 text-center">Desa / Kelurahan</th>
                            <th class="px-6 py-5 border-b border-slate-100 text-center">Total Anggota</th>
                            <th class="px-8 py-5 border-b border-slate-100 text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($rantings as $r)
                        <tr class="hover:bg-indigo-50/40 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="font-black text-slate-800 text-sm group-hover:text-indigo-700 transition-colors">{{ $r->nama }}</div>
                                <div class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">ID Unit: #{{ $r->id }}</div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-xs font-bold text-slate-600 uppercase">{{ $r->desa->nama ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-lg font-black text-[10px]">
                                    {{ $r->anggotas->count() }} Orang
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin_pac.ranting.show', $r->id) }}" class="p-2 bg-slate-100 text-slate-500 rounded-xl hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                    <a href="{{ route('admin_pac.ranting.edit', $r->id) }}" class="p-2 bg-slate-100 text-slate-500 rounded-xl hover:bg-orange-500 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>