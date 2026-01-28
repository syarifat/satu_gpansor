<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-xl text-slate-800 uppercase tracking-tight">Arsip Surat PAC</h2>
            <a href="{{ route('admin_pac.surat.create') }}" class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-indigo-100">+ Ajukan Surat</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-xl rounded-[2.5rem] overflow-hidden border border-gray-100">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                            <th class="px-8 py-5 border-b border-slate-100">Perihal & Tujuan</th>
                            <th class="px-6 py-5 border-b border-slate-100">Nomor Surat</th>
                            <th class="px-6 py-5 border-b border-slate-100 text-center">Status</th>
                            <th class="px-8 py-5 border-b border-slate-100 text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($surats as $s)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="font-black text-slate-800 text-sm group-hover:text-indigo-700">{{ $s->perihal }}</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase">Kepada: {{ $s->penerima }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-xs font-bold {{ $s->nomor_surat ? 'text-slate-700' : 'text-slate-300 italic' }}">
                                    {{ $s->nomor_surat ?? 'Menunggu Cabang...' }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-tighter 
                                    {{ $s->status == 'pending' ? 'bg-orange-100 text-orange-600' : ($s->status == 'diterima' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600') }}">
                                    {{ $s->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <a href="{{ route('admin_pac.surat.show', $s->id) }}" class="text-[10px] font-black text-indigo-600 hover:underline uppercase">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-slate-400 italic font-bold">Belum ada riwayat pengajuan surat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-6 bg-slate-50 border-t border-slate-100">{{ $surats->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>