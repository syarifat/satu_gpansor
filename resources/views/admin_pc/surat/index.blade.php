<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Arsip & Approval Surat</h2>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            {{-- Statistik Ringkas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-white shadow-xl rounded-[2rem] border-l-4 border-orange-500">
                    <p class="text-[10px] font-black text-slate-400 uppercase">Menunggu Persetujuan</p>
                    <p class="text-2xl font-black text-slate-800">{{ $surats->where('status', 'pending')->count() }} <span class="text-sm font-medium text-slate-400">Surat</span></p>
                </div>
                <div class="p-6 bg-white shadow-xl rounded-[2rem] border-l-4 border-emerald-500">
                    <p class="text-[10px] font-black text-slate-400 uppercase">Telah Disetujui</p>
                    <p class="text-2xl font-black text-slate-800">{{ $surats->where('status', 'diterima')->count() }}</p>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="bg-white shadow-xl rounded-[2.5rem] overflow-hidden border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                            <th class="px-8 py-5 border-b border-slate-100">Informasi Surat</th>
                            <th class="px-6 py-5 border-b border-slate-100">Pengirim</th>
                            <th class="px-6 py-5 border-b border-slate-100 text-center">Status</th>
                            <th class="px-8 py-5 border-b border-slate-100 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($surats as $s)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="font-black text-slate-800 text-sm group-hover:text-emerald-700">{{ $s->perihal }}</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase mt-1">No: {{ $s->nomor_surat ?? 'Belum Ada Nomor' }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-xs font-bold text-slate-600">{{ $s->organisasiUnit->nama }}</div>
                                <div class="text-[10px] text-indigo-500 font-black uppercase">{{ $s->indexSurat->kode }}</div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-tighter 
                                    {{ $s->status == 'pending' ? 'bg-orange-100 text-orange-600' : ($s->status == 'diterima' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600') }}">
                                    {{ $s->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <a href="{{ route('admin_pc.surat.show', $s->id) }}" class="inline-block px-4 py-2 bg-slate-800 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-700 transition-all">Detail & Approve</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-6 bg-slate-50 border-t">{{ $surats->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>