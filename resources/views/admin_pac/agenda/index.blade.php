<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-xl text-slate-800 uppercase tracking-tight">Agenda Kegiatan Wilayah</h2>
            <a href="{{ route('admin_pac.agenda.create') }}" class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-indigo-100">+ Tambah Agenda</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($agendas as $a)
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-gray-100 hover:border-indigo-500 transition-all group relative overflow-hidden">
                    <div class="flex justify-between items-start mb-6">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[9px] font-black rounded-lg uppercase tracking-widest border border-indigo-100">
                            {{ $a->status }}
                        </span>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            {{ \Carbon\Carbon::parse($a->tanggal_mulai)->translatedFormat('d M Y') }}
                        </p>
                    </div>
                    
                    <h4 class="font-black text-slate-800 text-lg mb-2 group-hover:text-indigo-700 transition-colors leading-tight">
                        {{ $a->nama }}
                    </h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6">📍 {{ $a->lokasi }}</p>
                    
                    <div class="pt-5 border-t border-slate-50 flex justify-between items-center">
                        <span class="text-[10px] font-black text-slate-500 uppercase">{{ $a->organisasiUnit->nama }}</span>
                        <a href="{{ route('admin_pac.agenda.show', $a->id) }}" class="text-[10px] font-black text-indigo-600 hover:underline uppercase tracking-widest">Detail &rarr;</a>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white p-20 rounded-[3rem] text-center border-2 border-dashed border-slate-100">
                    <p class="text-slate-400 font-bold italic">Belum ada agenda kegiatan terdaftar di wilayah ini.</p>
                </div>
                @endforelse
            </div>
            <div class="mt-10">{{ $agendas->links() }}</div>
        </div>
    </div>
</x-app-layout>