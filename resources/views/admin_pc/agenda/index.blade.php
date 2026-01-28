<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Monitoring Agenda Kegiatan</h2>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($agendas as $a)
                <div class="bg-white shadow-xl rounded-[2.5rem] border border-gray-100 overflow-hidden group hover:border-emerald-500 transition-all">
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[9px] font-black rounded-lg uppercase border border-emerald-100">{{ $a->status }}</span>
                            <p class="text-[10px] font-bold text-slate-400">{{ $a->tanggal_mulai }}</p>
                        </div>
                        <h3 class="text-lg font-black text-slate-800 mb-2 group-hover:text-emerald-700 transition-colors">{{ $a->nama }}</h3>
                        <p class="text-xs text-slate-500 font-bold mb-4 uppercase tracking-tighter">📍 {{ $a->lokasi }}</p>
                        <div class="pt-4 border-t border-slate-50 flex justify-between items-center">
                            <p class="text-[10px] font-black text-indigo-600 uppercase">{{ $a->organisasiUnit->nama }}</p>
                            
                            <a href="{{ route('admin_pc.agenda.show', $a->id) }}" class="inline-block px-4 py-2 bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-700 hover:text-white transition-all">
                                Detail & Approve &rarr;
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $agendas->links() }}</div>
        </div>
    </div>
</x-app-layout>