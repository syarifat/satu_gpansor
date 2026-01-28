<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Index Surat Organisasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-6 bg-white shadow-xl rounded-[2.5rem] border border-gray-100 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight">Kode Index Surat</h3>
                    <p class="text-xs text-slate-400 font-bold">Total: {{ $indexes->count() }} Kategori</p>
                </div>
                <a href="{{ route('admin_pc.index-surat.create') }}" class="px-6 py-3 bg-emerald-700 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-100">
                    + Tambah Index
                </a>
            </div>

            <div class="bg-white shadow-xl rounded-[2.5rem] overflow-hidden border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-[0.2em]">
                            <th class="px-8 py-5 border-b border-slate-100 w-32">Kode</th>
                            <th class="px-6 py-5 border-b border-slate-100">Deskripsi / Perihal</th>
                            <th class="px-8 py-5 border-b border-slate-100 text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($indexes as $idx)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            <td class="px-8 py-5">
                                <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg font-black text-sm border border-emerald-100">
                                    {{ $idx->kode }}
                                </span>
                            </td>
                            <td class="px-6 py-5 font-bold text-slate-700 text-sm">
                                {{ $idx->deskripsi }}
                            </td>
                            <td class="px-8 py-5 text-center flex justify-center gap-2 opacity-60 group-hover:opacity-100">
                                <a href="{{ route('admin_pc.index-surat.edit', $idx->id) }}" class="p-2 bg-orange-50 text-orange-500 rounded-xl hover:bg-orange-100 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" /></svg>
                                </a>
                                <form action="{{ route('admin_pc.index-surat.destroy', $idx->id) }}" method="POST" onsubmit="return confirm('Hapus index surat ini?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 bg-rose-50 text-rose-500 rounded-xl hover:bg-rose-100 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>