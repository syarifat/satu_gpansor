<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-xl text-slate-800 uppercase tracking-tight">Database Kader Wilayah</h2>
            <a href="{{ route('admin_pac.anggota.create') }}" class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-indigo-100">+ Tambah Anggota</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            {{-- Search Bar --}}
            <div class="bg-white p-6 rounded-[2.5rem] shadow-xl border border-gray-100">
                <form action="{{ route('admin_pac.anggota.index') }}" method="GET" class="flex gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau NIK..." class="w-full rounded-2xl border-gray-100 bg-slate-50 focus:ring-indigo-500 font-bold text-sm">
                    <button type="submit" class="px-8 py-2 bg-slate-800 text-white rounded-2xl font-black text-xs uppercase">Cari</button>
                </form>
            </div>

            <div class="bg-white shadow-xl rounded-[2.5rem] overflow-hidden border border-gray-100">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                            <th class="px-8 py-5">Nama Kader</th>
                            <th class="px-6 py-5">Unit Penempatan</th>
                            <th class="px-6 py-5">Jabatan</th>
                            <th class="px-8 py-5 text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($anggotas as $agt)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="font-black text-slate-800 text-sm group-hover:text-indigo-700">{{ $agt->nama }}</div>
                                <div class="text-[9px] text-slate-400 font-bold">NIK: {{ $agt->nik }}</div>
                            </td>
                            <td class="px-6 py-5 text-xs font-bold text-slate-500 uppercase">{{ $agt->organisasiUnit->nama }}</td>
                            <td class="px-6 py-5">
                                <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-lg font-black text-[9px] uppercase">{{ $agt->jabatan->nama }}</span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <a href="{{ route('admin_pac.anggota.edit', $agt->id) }}" class="text-[10px] font-black text-indigo-600 hover:underline uppercase">Edit Data</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-6 bg-slate-50 border-t border-slate-100">
                    {{ $anggotas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>